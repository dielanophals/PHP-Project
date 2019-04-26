<?php
  require_once("bootstrap.php");
  $s = Session::check();
  if($s === false){
      header("Location: login.php");
  }

  if(!empty($_POST)) {
    $imagePost = $_FILES["fileToUpload"];
    $description = htmlspecialchars($_POST["description"]);
    if(empty($description)){
      $feedback = "Please add a description.";
    }else{
      $post = new Post();
      if($post->checkType($imagePost) === false){
        $feedback = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }else{
        if($post->fileSize($imagePost) === false){
          $feedback = "Sorry, your file is too big.";
        }else{
          $post->createDirectory("posts");
          if($post->fileExists() === false){
            $feedback = "Sorry, this file already exists. Please try again.";
          }else{
            $post->insertIntoDB($post->uploadImage(), $description, $_SESSION["userID"]);
            $feedback = "File has been uploaded.";
            header("Location: profile.php");
          }
        }
      }
    }
  }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/profile.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>InstaPet - Profile</title>
    <style>

      a.post-image {
        text-decoration: none;
      }

      .hide {
        display: none;
      }
    
      .searchPost {
        margin-bottom: 20px;
      }

      .likes {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
      }

      span.like-btn {
        cursor: pointer;
        padding: 10px;
        font-size: 2em;
        color: red;
      }

      span.likes-count {
        text-decoration: none;
        color: #333;
      }
    
    </style>
</head>
<body>
  <header>
      <?php require_once("nav.inc.php"); ?>
  </header>
    <div class="profile__container">
      <div class="profile__information">
        <?php foreach (Show::getUserInfo($_SESSION['userID']) as $profilePicture): ?>
          <div class="profile" style="background-image: url('<?php echo $profilePicture['picture']; ?>');"></div>
        <?php endforeach; ?>
          <div class="information">
            <?php foreach(Show::getUserInfo($_SESSION["userID"]) as $info): ?>
              <h2 class="name"><?php echo $info['username'] ?></h2>
              <p class="bio"><?php echo $info['description'] ?></p>
            <?php endforeach; ?>
            <a href="settings.php">Edit profile</a>
            <a href="?upload=yes">Upload image</a>
          </div>
        </div>
        <div class="profile__posts">
      </div>
    </div>
  <main class="profilePosts">
    <div class="container">
      <?php
        foreach(Show::getUserPosts($_SESSION["userID"]) as $p){
          echo '<a href="?image='. $p['id'] .'">';
          echo '<div class="userPosts" style="background:url(' . $p['image'] . '); background-size: cover; background-position: center;">';
          echo '<img src="' . $p['image'] . '">';
          echo '</div>';
          echo '</a>'; ?>

          <div class="likes">
            <?php $like = Post::like($_SESSION['userID'], $p['id']); ?>
            
            <?php if ($like['active'] == 1): ?>
              <span data-id="<?php echo $p['id']; ?>" class="unlike like-btn fas fa-heart"></span>
              <span data-id="<?php echo $p['id']; ?>" class="like like-btn hide far fa-heart"></span>
            <?php endif; ?>

            <?php if ($like['active'] == 0): ?>
              <span data-id="<?php echo $p['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
              <span data-id="<?php echo $p['id']; ?>" class="like like-btn far fa-heart"></span>
            <?php endif; ?>
            
            <?php $likeCount = Post::likeCount($p['id']); ?>

            <?php if ( $likeCount == 1 ): ?>
              <span class="likes-count"><?php echo $likeCount; ?> like</span>
            <?php endif; ?>

            <?php if ( $likeCount == 0 || $likeCount > 1) : ?>
              <span class="likes-count"><?php echo $likeCount; ?> likes</span>
            <?php endif; ?>
          </div>

        <?php } ?>
    </div>
  </main>

  <?php
    if(!empty($_GET['image'])){
      $post = new Post();
      $post->showImage($_GET['image']);

      foreach($post->showImage($_GET['image']) as $p){
        echo '<div class="popup">';
        echo '<div class="post">';
        echo '<img src="' . $p['image'] . '">';
        echo '<p>' . $p['description'] . '</p>';
        echo '</div>';
        echo '<a href="profile.php" class="close">X</a>';
        echo '</div>';
      }
    }

    if(!empty($_GET['upload'])){
      ?>

      <div class="popup">
        <div class="imageUpload">
          <form action="#" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Select image to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required><br><br>
            <input type="submit" value="Upload Image" name="submit">
          </form>
          <?php
            if(isset($feedback)){
              echo $feedback;
            }
          ?>
        </div>
        <a href="profile.php" class="close">X</a>
      </div>
  <?php
    }
  ?>
  
  <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  <script src="js/like.js"></script>
</body>
</html>
