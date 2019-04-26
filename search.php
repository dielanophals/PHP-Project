<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

    $search = $_GET['search'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>InstaPet - Search</title>
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
      }

      span.like-btn i {
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

    <main class="search">
      <div class="container searched">
        <?php
        if(!empty($search)){
          $searchPosts = new Post();
          foreach($searchPosts->getSearchPosts($search) as $s):
            ?>

            <a href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>" class="post-image">
              <div class="searchPost" style="background:url('<?php echo $s['image']; ?>'); background-size: cover; background-position: center;"></div>
            </a>

            <div class="likes">
                <?php $like = Post::like($_SESSION['userID'], $s['id']); ?>
                
                <?php if ($like['active'] == 1): ?>
                  <span class="unlike like-btn" data-id="<?php echo $s['id']; ?>"><i class="fas fa-heart"></i></span>
                  <span class="like like-btn hide" data-id="<?php echo $s['id']; ?>"><i class="far fa-heart"></i></span>
                <?php endif; ?>

                <?php if ($like['active'] == 0): ?>
                  <span class="unlike like-btn hide" data-id="<?php echo $s['id']; ?>"><i class="fas fa-heart"></i></span>
                  <span class="like like-btn" data-id="<?php echo $s['id']; ?>"><i class="far fa-heart"></i></span>
                <?php endif; ?>
                
                <?php $likeCount = Post::likeCount($s['id']); ?>

                <?php if ( $likeCount == 1 ): ?>
                  <span class="likes-count"><?php echo $likeCount; ?> like</span>
                <?php endif; ?>

                <?php if ( $likeCount == 0 || $likeCount > 1) : ?>
                  <span class="likes-count"><?php echo $likeCount; ?> likes</span>
                <?php endif; ?>

              </div>

            <?php
          endforeach;
        }
        ?>
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
        echo '<a href="search.php?search=' . $search . '" class="close">X</a>';
        echo '</div>';
      }
    }
     ?>

<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script src="js/like.js"></script>
</body>
</html>
