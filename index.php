<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

    $id = $_SESSION['userID'];
    $list = Friend::getListOfFriendsIds($id);

    $limit = 20;

    if(empty($list)){
        $err_posts = false;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>InstaPet - Feed</title>
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
    <main class="grid">
        <?php if(isset($err_posts)): ?>
            <p>No posts to display of your friends.</p>
        <?php endif; ?>
        <!--in id the id of the post is displayed, in case of detail page that needs to be shown.-->
        <?php foreach($list as $key => $value): ?>
            <?php
                $posts = Show::getFriendsPosts($value, $limit);
                foreach($posts as $k => $v):
            ?>
                <div id="<?php echo $v["id"]; ?>" class="post">
                    <img src="<?php echo $v["image"]; ?>">
                    
                    <div class="likes">
                        <?php $like = Post::like($_SESSION['userID'], $v['id']); ?>
                        
                        <?php if ($like['active'] == 1): ?>
                        <span data-id="<?php echo $v['id']; ?>" class="unlike like-btn fas fa-heart"></span>
                        <span data-id="<?php echo $v['id']; ?>" class="like like-btn hide far fa-heart"></span>
                        <?php endif; ?>

                        <?php if ($like['active'] == 0): ?>
                        <span data-id="<?php echo $v['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
                        <span data-id="<?php echo $v['id']; ?>" class="like like-btn far fa-heart"></span>
                        <?php endif; ?>
                        
                        <?php $likeCount = Post::likeCount($v['id']); ?>

                        <?php if ( $likeCount == 1 ): ?>
                        <span class="likes-count"><?php echo $likeCount; ?> like</span>
                        <?php endif; ?>

                        <?php if ( $likeCount == 0 || $likeCount > 1) : ?>
                        <span class="likes-count"><?php echo $likeCount; ?> likes</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </main>
    <footer>
        <div class="btnLoadmore">
            <form action="" method="POST">
                <input class="loadmore" type="submit" formmethod="POST" value="Load more" name="load" max="<?php echo $limit; ?>">
            </form>
        </div>
    </footer>

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
</html>
