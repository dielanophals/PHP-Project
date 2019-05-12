<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

	if(!empty($_GET['search'])){
		$search = $_GET['search'];
	}

	//Properly redirect to previous page.
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
    	$previous = $_SERVER['HTTP_REFERER'];
    }

    //Get the user choses a map or the default search
    if(!empty($_GET["map"])){
        $isMapActivated = $_GET["map"];
        if($isMapActivated === "false"){
            $valBtnMap = "View on map";
            $isMapActivated = "true";

            //Display the current choice of the user
            $isDefaultSearch = "flex";
            $isMapSearch = "none";
        }
        else if($isMapActivated === "true"){
            $valBtnMap = "View default search";
            $isMapActivated = "false";

            //Display the current choice of the user
            $isDefaultSearch = "none";
            $isMapSearch = "block";
        }
    }
    //Default
    else{
        $isMapActivated = "false";
        $valBtnMap = "View on map";
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
	<link rel = "stylesheet" type = "text/css" href = "css/search.css"/>
    <script src='https://static-assets.mapbox.com/gl-pricing/dist/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/vendor/cssgram.min.css">
    <title>InstaPet - Search</title>
    <style>

      body {
        background: #ddd;
      }

      .container {
        flex-flow: column wrap;
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

      .edit__options {
        visibility: hidden;
      }

      .edit__options,
      .fa-ellipsis-h,
      .option--delete,
      .option--edit {
        color: black;
        font-size: 1em;
        text-decoration: none;
      }

      .edit__options form {
        margin: 5px 0 10px;
      }

      .form--delete,
      .form--edit {
        display: none;
      }
    </style>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
<<<<<<< HEAD
    <main>
        <form method="GET">
            <input type="hidden" name="map" value="<?php echo $isMapActivated; ?>">
            <input type="submit" class="btn__change__view" value="<?php echo $valBtnMap; ?>">
        </form>
    </main>
    <section class="search" style="display:<?php echo $isDefaultSearch; ?>;">
        <div class="container searched">
            <?php
            if(!empty($search)){
            $searchPosts = new Post();
            foreach($searchPosts->getSearchPosts($search) as $s):
                $information = User::getUserInfo($s['user_id']);
                $name = $information['username'];
                ?>
                <?php $time = User::timeAgo($s['timestamp']); ?>
                    <a class="post__full" href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>" class="post-image">
                        <div class="searchPost">
                            <img class="post__img" src="<?php echo $s["image"]; ?>">
                            <p class="post__name"><?php echo $name; ?></p>
                            <p class="timeAgo"><?php echo $time; ?></p>
                        </div>
                    </a>

                <div class="likes">
                    <?php $like = Post::like($_SESSION['userID'], $s['id']); ?>

                    <?php if ($like['active'] == 1): ?>
                    <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn fas fa-heart"></span>
                    <span data-id="<?php echo $s['id']; ?>" class="like like-btn hide far fa-heart"></span>
                    <?php endif; ?>

                    <?php if ($like['active'] == 0): ?>
                    <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
                    <span data-id="<?php echo $s['id']; ?>" class="like like-btn far fa-heart"></span>
                    <?php endif; ?>

                    <?php $likeCount = Post::likeCount($s['id']); ?>

                    <?php if ( $likeCount == 1 ): ?>
                    <span class="likes-count"><?php echo $likeCount; ?> like</span>
                    <?php endif; ?>

                    <?php if ( $likeCount == 0 || $likeCount > 1) : ?>
                    <span class="likes-count"><?php echo $likeCount; ?> likes</span>
                    <?php endif; ?>
||||||| merged common ancestors
    <main class="search">
      <div class="container searched">
        <?php
        if(!empty($search)){
          $searchPosts = new Post();
          foreach($searchPosts->getSearchPosts($search) as $s):
            $information = User::getUserInfo($s['user_id']);
            $name = $information['username'];
            ?>
            <?php $time = User::timeAgo($s['timestamp']); ?>
				<a class="post__full" href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>" class="post-image">
                    <div class="searchPost">
                        <img class="post__img" src="<?php echo $s["image"]; ?>">
                        <p class="post__name"><?php echo $name; ?></p>
                        <p class="timeAgo"><?php echo $time; ?></p>
                    </div>
                </a>

            <div class="likes">
                <?php $like = Post::like($_SESSION['userID'], $s['id']); ?>

                <?php if ($like['active'] == 1): ?>
                  <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn fas fa-heart"></span>
                  <span data-id="<?php echo $s['id']; ?>" class="like like-btn hide far fa-heart"></span>
                <?php endif; ?>

                <?php if ($like['active'] == 0): ?>
                  <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
                  <span data-id="<?php echo $s['id']; ?>" class="like like-btn far fa-heart"></span>
                <?php endif; ?>

                <?php $likeCount = Post::likeCount($s['id']); ?>
=======
    <main class="search">
      <div class="container searched">
        <?php
        if(!empty($search)){
          $searchPosts = new Post();
          foreach($searchPosts->getSearchPosts($search) as $s):
            $information = User::getUserInfo($s['user_id']);
            $name = $information['username'];
            ?>
            <div class="container_post">
            <?php $time = User::timeAgo($s['timestamp']); ?>
				<a class="post__full" href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>" class="post-image">
                    <div class="searchPost">
                        <div class="post__img" class="<?php echo $s['filter']; ?>  post__img" style="background-image: url('<?php echo $s['image']; ?>')"></div>
                        <p class="post__name"><?php echo $name; ?></p>
                        <p class="timeAgo"><?php echo $time; ?></p>
                    </div>
                </a>

            <div class="likes">
                <?php $like = Post::like($_SESSION['userID'], $s['id']); ?>

                <?php if ($like['active'] == 1): ?>
                  <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn fas fa-heart"></span>
                  <span data-id="<?php echo $s['id']; ?>" class="like like-btn hide far fa-heart"></span>
                <?php endif; ?>

                <?php if ($like['active'] == 0): ?>
                  <span data-id="<?php echo $s['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
                  <span data-id="<?php echo $s['id']; ?>" class="like like-btn far fa-heart"></span>
                <?php endif; ?>

                <?php $likeCount = Post::likeCount($s['id']); ?>
>>>>>>> 100c9ab2ff0d44f86f27bfe4b167956942dbbccf

                </div>

                <?php if ($_SESSION['userID'] == $s['user_id']): ?>
                    <div class="edit">
                    <a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
                    <div class="edit__options">
                        <a href="#" class="option--delete">Delete</a>
                        <form action="postDelete.php" method="POST" class="form--delete">
                        <input type="hidden" value="<?php echo $s['image']; ?>" name="delete_file"/>
                        <input type="submit" name="delete" value="Delete">
                        </form>
                        <a href="#" class="option--edit">Edit</a>
                        <form action="postEdit.php" method="POST" class="form--edit">
                        <input type="hidden" value="<?php echo $s['id']; ?>" name="file_id">
                        <textarea name="descriptionEdit"><?php echo $s['description']; ?></textarea>
                        <input type="submit" name="update" value="Update">
                        </form>
                    </div>
                    </div>
                <?php endif; ?>

<<<<<<< HEAD
                <?php
            endforeach;
            }
            ?>
        </div>
    </section>
    <!--Image map-->
    <section class="search__map" style="display:<?php echo $isMapSearch; ?>;">
        <div id='map' style="width: 100vw; height: 100vh;"></div>
    </section>
||||||| merged common ancestors
              </div>

              <?php if ($_SESSION['userID'] == $s['user_id']): ?>
                <div class="edit">
                  <a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
                  <div class="edit__options">
                    <a href="#" class="option--delete">Delete</a>
                    <form action="postDelete.php" method="POST" class="form--delete">
                      <input type="hidden" value="<?php echo $s['image']; ?>" name="delete_file"/>
                      <input type="submit" name="delete" value="Delete">
                    </form>
                    <a href="#" class="option--edit">Edit</a>
                    <form action="postEdit.php" method="POST" class="form--edit">
                      <input type="hidden" value="<?php echo $s['id']; ?>" name="file_id">
                      <textarea name="descriptionEdit"><?php echo $s['description']; ?></textarea>
                      <input type="submit" name="update" value="Update">
                    </form>
                  </div>
                </div>
              <?php endif; ?>

            <?php
          endforeach;
        }
        ?>
      </div>
    </main>
=======
              </div>

              <?php if ($_SESSION['userID'] == $s['user_id']): ?>
                <div class="edit">
                  <a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
                  <div class="edit__options">
                    <a href="#" class="option--delete">Delete</a>
                    <form action="postDelete.php" method="POST" class="form--delete">
                      <input type="hidden" value="<?php echo $s['image']; ?>" name="delete_file"/>
                      <input type="submit" name="delete" value="Delete">
                    </form>
                    <a href="#" class="option--edit">Edit</a>
                    <form action="postEdit.php" method="POST" class="form--edit">
                      <input type="hidden" value="<?php echo $s['id']; ?>" name="file_id">
                      <textarea name="descriptionEdit"><?php echo $s['description']; ?></textarea><br>
                      <input type="submit" name="update" value="Update">
                    </form>
                  </div>
                </div>
              <?php endif; ?>

            </div>
          <?php endforeach; } ?>
      </div>
    </main>
>>>>>>> 100c9ab2ff0d44f86f27bfe4b167956942dbbccf
	<!--If there is a search for color X, show posts with the same color. -->
    <?php if(!empty($_GET['color'])): ?>
		<?php $posts = Color::searchPostsByColor($_GET['color']); ?>
		<?php foreach($posts as $post): ?>
			<?php $result = Post::getPostById($post["posts_id"]);?>
			<?php foreach($result as $r):?>
				<a href="?image=<?php echo $r["id"]; ?>">
                    <div id="<?php echo $r["id"]; ?>" class="post">
                		<img class="post__img <?php echo $r['filter']; ?>" src="<?php echo $r["image"]; ?>">
					</div>
                </a>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<!--Pop up sceen-->
	<?php if(!empty($_GET['image'])): ?>
		<?php $post = new Post(); $post->getPostById($_GET['image']);?>
		<?php foreach($post->getPostById($_GET['image']) as $p): ?>
			<div class="popup">
				<div class="post">
          <?php
            $information = User::getUserInfo($p['user_id']);
            $name = $information['username'];
          ?>
          <a class="popup_name" href="friend.php?id=<?php echo $p['user_id'] ?>"><?php echo $name; ?></a>
					<div class="popup_img" class="<?php echo $p['filter']; ?>" style="background-image: url('<?php echo $p['image']; ?>')"></div>
					<!--Show the colors of the image. -->
					<div class="color">
						<?php $c = Color::getColors($p['id']); ?>
                        <!--Loop through all colors to display them from highest value to lowest.-->
                        <?php foreach($c as $key => $value): ?>
                            <!--Only show found colors.-->
                            <?php if($value != 0): ?>
                                <a href="search.php?search=0&color=<?php echo $key?>">
                                    <div class="color__item color__item--<?php echo $key; ?>"></div>
                                </a>
                            <?php endif; ?>
						<?php endforeach; ?>
					</div>
					<p><?php echo $p['description']; ?></p>
				</div>
				<a href="<?php echo $previous; ?>" class="close">X</a>';
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="js/like.js"></script>
    <script src="js/edit.js"></script>
    <script src="js/map.js"></script>
</body>
</html>
