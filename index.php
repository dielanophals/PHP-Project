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
        <?php foreach($list as $key => $value): ?>
            <?php
                $posts = Friend::getFriendsPosts($value, $limit);
                foreach($posts as $k => $v):
                  $information = User::getUserInfo($v['user_id']);
                  $name = $information['username'];
            ?>
            <?php $time = User::timeAgo($v['timestamp']); ?>
                <a class="post__full" href="?image=<?php echo $v["id"]; ?>">
                    <div id="<?php echo $v["id"]; ?>" class="post">
                        <img class="post__img" src="<?php echo $v["image"]; ?>">
                        <p class="post__name"><?php echo $name; ?></p>
                        <p class="timeAgo"><?php echo $time; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <!--Pop up sceen-->
        <?php if(!empty($_GET['image'])): ?>
		<?php $post = new Post(); $post->showImage($_GET['image']);?>
		<?php foreach($post->showImage($_GET['image']) as $p): ?>
			<div class="popup">
				<div class="post">
          <?php
            $information = User::getUserInfo($p['user_id']);
            $name = $information['username'];
          ?>
          <a class="popup_name" href="friend.php?id=<?php echo $p['user_id'] ?>"><?php echo $name; ?></a>
					<img src="<?php echo $p['image']; ?>">
					<!--Show the colors of the image. -->
					<div class="color">
						<?php $c = Color::getColors($p['id']); ?>
                        <!--Loop through all colors to display them from highest value to lowest.-->
                        <?php foreach($c as $key => $value): ?>
                            <!--Only show found colors.-->
                            <?php if($value != 0): ?>
                                <a href="search.php?color=<?php echo $key?>">
                                    <div class="color__item color__item--<?php echo $key; ?>"></div>
                                </a>
                            <?php endif; ?>
						<?php endforeach; ?>
					</div>
					<p><?php echo $p['description']; ?></p>
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
                    <?php if ($_SESSION['userID'] == $v['user_id']): ?>
                <div class="edit">
                  <a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
                  <div class="edit__options">
                    <a href="#" class="option--delete">Delete</a>
                    <form action="postDelete.php" method="POST" class="form--delete">
                      <input type="hidden" value="<?php echo $v['image']; ?>" name="delete_file"/>
                      <input type="submit" name="delete" value="Delete">
                    </form>
                    <a href="#" class="option--edit">Edit</a>
                    <form action="postEdit.php" method="POST" class="form--edit">
                      <input type="hidden" value="<?php echo $v['id']; ?>" name="file_id">
                      <textarea name="descriptionEdit"><?php echo $v['description']; ?></textarea>
                      <input type="submit" name="update" value="Update">
                    </form>
                  </div>
                </div>
              <?php endif; ?>
				</div>
				<a href="index.php" class="close">X</a>
			</div>
		<?php endforeach; ?>
	    <?php endif; ?>
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
    <script src="js/like.js"></script>
</html>
