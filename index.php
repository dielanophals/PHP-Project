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
    <link rel="stylesheet" href="css/vendor/cssgram.min.css">
    <title>InstaPet - Feed</title>
    <style>

      body {
        background: #ddd;
      }

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
                $allPosts = Friend::getFriendsPosts($value, $limit);
				foreach($allPosts as $posts => $post):
                  $information = User::getUserInfo($post['user_id']);
                  $name = $information['username'];
            ?>
            <?php $time = User::timeAgo($post['timestamp']); ?>
                <a class="post__full" href="?image=<?php echo $post["id"]; ?>">
                    <div id="<?php echo $post["id"]; ?>" class="post">
                        <div class="post__img" class="<?php echo $r['filter']; ?>  post__img" style="background-image: url('<?php echo $post['image']; ?>')"></div>
                        <p class="post__name"><?php echo $name; ?></p>
                        <p class="timeAgo"><?php echo $time; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <!--Pop up sceen-->
        <?php if(!empty($_GET['image'])): ?>
		<?php $newPost = new Post(); $newPost->getPostById($_GET['image']);?>
		<?php foreach($newPost->getPostById($_GET['image']) as $post): ?>
			<div class="popup">
				<div class="post">
          <?php
            $information = User::getUserInfo($post['user_id']);
            $name = $information['username'];
          ?>
          <a class="popup_name" href="friend.php?id=<?php echo $post['user_id'] ?>"><?php echo $name; ?></a>
					<div class="popup_img" class="<?php echo $post['filter']; ?>" style="background-image: url('<?php echo $post['image']; ?>')"></div>
					<!--Show the colors of the image. -->
					<div class="color">
				  	<?php $c = Color::getColors($post['id']); ?>
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
					<p><?php echo $post['description']; ?></p>
					<?php require("likes.inc.php"); ?>
                    <?php if ($_SESSION['userID'] == $post['user_id']): ?>
                <div class="edit">
                  <a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
                  <div class="edit__options">
                    <a href="#" class="option--delete">Delete</a>
                    <form action="postDelete.php" method="POST" class="form--delete">
                      <input type="hidden" value="<?php echo $post['image']; ?>" name="delete_file"/>
                      <input type="submit" name="delete" value="Delete">
                    </form>
                    <a href="#" class="option--edit">Edit</a>
                    <form action="postEdit.php" method="POST" class="form--edit">
                      <input type="hidden" value="<?php echo $post['id']; ?>" name="file_id">
                      <textarea name="descriptionEdit"><?php echo $post['description']; ?></textarea><br>
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
      
      <br />
  <h2 align="center"><a href="#">Comment System Instapet</a></h2>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <!--<div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>-->
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
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
    <script src="js/comment.js"></script>
</html>
