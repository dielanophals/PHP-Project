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
    <title>InstaPet - Profile</title>
</head>
<body>
  <header>
      <?php require_once("nav.inc.php"); ?>
  </header>
    <div class="imageUpload">
      <form action="#" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="text" name="description">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <?php
      if(isset($feedback)){
        echo $feedback;
      }
    ?>
    </div>
  <main>
    <div class="container">
      <?php
        $sup = new ShowUserPosts();
        foreach($sup->getUserPosts($_SESSION["userID"]) as $p){
          echo '<a href="?image='. $p['id'] .'">';
          echo '<div class="userPosts">';
          echo '<img src="' . $p['image'] . '">';
          echo '</div>';
          echo '</a>';
        }
      ?>
    </div>
  </main>

  <?php
    if(!empty($_GET['image'])){
      $openPost = new OpenPost();
      $openPost->showImage($_GET['image']);

      foreach($openPost->showImage($_GET['image']) as $p){
        echo '<div class="popup">';
        echo '<img src="' . $p['image'] . '">';
        echo '<a href="profile.php" class="close">X</a>';
        echo '</div>';
      }
    }
  ?>
  </div>
</body>
</html>
