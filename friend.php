<?php
	require_once("bootstrap.php");

	$s = Session::check();
	if($s === false){
    	header("Location: login.php");
	}

	if(!empty($_GET['id'])){
		$id = $_GET['id'];
	}else{
		header("Location: index.php");
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
    <link rel="stylesheet" href="css/vendor/cssgram.min.css">
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
        	<?php $profile = User::getUserInfo($id); ?>
        		<div class="profile" style="background-image: url('<?php echo $profile['picture']; ?>');"></div>
          	<div class="information">
            <h2 class="name"><?php echo $profile['username']; ?></h2>
            <p class="bio"><?php echo $profile['description']; ?></p>
						<?php $friend = Friend::checkFriend($_SESSION['userID'], $id); ?>
								<a href="#" class="btn_friend addfriend <?php if($friend == 1){ echo "hide"; } ?>" data-friend="<?php echo $id; ?>">Follow</a>
								<a href="#" class="btn_friend removefriend <?php if($friend == 0){ echo "hide"; } ?>" data-friend="<?php echo $id; ?>">Unfollow</a>
        	</div>
    	</div>
		<div class="profile__posts">
		</div>
	</div>
	<main class="profilePosts">
		<div class="container">
			<?php foreach(User::getUserPosts($id) as $post): ?>
				<div class="container_post">
					<?php $time = User::timeAgo($post['timestamp']); ?>
					<a href="?id=<?php echo $id ?>&image=<?php echo $post['id']; ?>">
						<img src="<?php echo $post['image']; ?>" class="post__img <?php echo $post['filter']; ?>">
						<p class="timeAgo"><?php echo $time; ?></p>
					</a>
					<?php require("likes.inc.php"); ?>
				</div>
			<?php endforeach; ?>
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
							<textarea name="descriptionEdit"><?php echo htmlspecialchars($post['description']); ?></textarea>
							<input type="submit" name="update" value="Update">
						</form>
					</div>
				</div>
			<?php endif; ?>
    </div>
	</main>
    <!--Pop up sceen-->
    <?php if(!empty($_GET['image'])): ?>
		<?php $post = new Post(); $post->getPostById($_GET['image']);?>
		<?php foreach($post->getPostById($_GET['image']) as $p): ?>
			<div class="popup">
				<div class="post">
					<a class="popup_name" href="friend.php?id=<?php echo $profile['id'] ?>"><?php echo htmlspecialchars($profile['firstname']) . ' ' . htmlspecialchars($profile['lastname']); ?></a>
      		<p class="city"><?php echo $p['city']; ?></p>
					<img src="<?php echo $p['image']; ?>" class="<?php echo $p['filter']; ?>">
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
					<p><?php echo htmlspecialchars($p['description']); ?></p>
				</div>
				<a href="?id=<?php echo $id; ?>" class="close">X</a>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
<?php
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
	<?php } ?>

	<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
	<script src="js/like.js"></script>
	<script src="js/edit.js"></script>
	<script src="js/friends.js"></script>
</body>
</html>
