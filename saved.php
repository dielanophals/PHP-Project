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
	<main>
	  	<form>
	  		<input type="hidden" class="btn__change__view--value" value="<?php echo htmlspecialchars($search); ?>">
			<input type="button" class="btn__change__view" value="View on map">
		</form>
	</main>
	<section class="search">
		<div class="container searched">
	  			<?php $searchPosts = new Post();?>
				<?php
					foreach($searchPosts->getIdSaved() as $s):
					foreach($searchPosts->getSavedPosts($s['id']) as $post):
						$information = User::getUserInfo($post['user_id']);
						$name = $information['username'];
				?>
				<div class="container_post">
					<?php $time = User::timeAgo($post['timestamp']); ?>
						<?php $saved = Post::checkSaved($post['id']); ?>
						<a class="post__full" href="search.php?search=<?php echo htmlspecialchars($search); ?>&image=<?php echo $post["id"]; ?>" class="post-image">
							<div class="searchPost">
								<img class="post__img <?php echo htmlspecialchars($post['filter']); ?>" src="<?php echo $post['image']; ?>">
								<p class="post__name"><?php echo htmlspecialchars($name); ?></p>
								<p class="timeAgo"><?php echo htmlspecialchars($time); ?></p>
							</div>
						</a>

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
									<textarea name="descriptionEdit"><?php echo htmlspecialchars($post['description']); ?></textarea><br>
									<input type="submit" name="update" value="Update">
								</form>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</section>
	<!--Image map-->
	<section class="search__map" style="display:<?php echo $isMapSearch; ?>;">
		<div id='map' style="width: 100vw; height: 100vh;"></div>
	</section>
	<!--If there is a search for color X, show posts with the same color. -->
	<?php if(!empty($_GET['color'])): ?>
		<?php $posts = Color::searchPostsByColor($_GET['color']); ?>
		<?php foreach($posts as $post): ?>
			<?php $result = Post::getPostById($post["posts_id"]);?>
			<?php foreach($result as $r):?>
				<a href="?image=<?php echo $r["id"]; ?>">
					<div id="<?php echo $r["id"]; ?>" class="post">
						<img class="post__img <?php echo htmlspecialchars($r['filter']); ?>" src="<?php echo $r["image"]; ?>">
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
		  <a class="popup_name" href="friend.php?id=<?php echo $p['user_id'] ?>"><?php echo htmlspecialchars($name); ?></a>
		  			<img class="post__img <?php echo $p['filter']; ?>" src="<?php echo $p['image']; ?>">	
					<!--Show the colors of the image. -->
					<div class="color">
						<?php $c = Color::getColors($p['id']); ?>
						<!--Loop through all colors to display them from highest value to lowest.-->
						<?php foreach($c as $key => $value): ?>
							<!--Only show found colors.-->
							<?php if($value != 0): ?>
								<a href="search.php?search=0&color=<?php echo htmlspecialchars($key)?>">
									<div class="color__item color__item--<?php echo htmlspecialchars($key); ?>"></div>
								</a>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<p><?php echo htmlspecialchars($p['description']); ?></p>
				</div>
				<a href="<?php echo $previous; ?>" class="close">X</a>';
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/like.js"></script>
	<script src="js/edit.js"></script>
	<script src="js/map.js"></script>
	<script src="js/save.js"></script>
</body>
</html>
