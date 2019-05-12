<?php
    require_once 'bootstrap.php';

    $s = Session::check();
    if ($s === false) {
        header('Location: login.php');
    }

    if (!empty($_POST)) {
        $imagePost = $_FILES['fileToUpload'];
		$description = htmlspecialchars($_POST['description']);
		$filter = $_POST['filter'];
        if (empty($description)) {
            $feedback = 'Please add a description.';
        } else {
            $post = new Post();
            if ($post->checkType($imagePost) === false) {
                $feedback = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            } else {
                if ($post->fileSize($imagePost) === false) {
                    $feedback = 'Sorry, your file is too big.';
                } else {
                    $post->createDirectory('posts');
                    if ($post->fileExists() === false) {
                        $feedback = 'Sorry, this file already exists. Please try again.';
                    } else {
                        $post->getLocation();
						$post->insertIntoDB($post->uploadImage(), $description, $_SESSION['userID'], $filter);
                        $feedback = 'File has been uploaded.';
                        header('Location: profile.php');
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
	  
	  .previewImg {
		margin-top: 20px;
		width: 200px;
		height: auto;
		background: white;
		padding: 20px;  
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
    	<?php require_once 'nav.inc.php'; ?>
	</header>
    <div class="profile__container">
    	<div class="profile__information">
        	<?php $profile = User::getUserInfo($_SESSION['userID']); ?>
        		<div class="profile" style="background-image: url('<?php echo $profile['picture']; ?>');"></div>
          	<div class="information">
            <h2 class="name"><?php echo $profile['username']; ?></h2>
            <p class="bio"><?php echo $profile['description']; ?></p>
				<a href="settings.php">Edit profile</a>
				<a href="?upload=yes">Upload image</a>
        	</div>
    	</div>
		<div class="profile__posts">
		</div>
	</div>
	<main class="profilePosts">
		<div class="container">
			<?php foreach (User::getUserPosts($_SESSION['userID']) as $p): ?>
				<div class="container_post">
					<?php $time = User::timeAgo($p['timestamp']); ?>
				<a class="post__full" href="?image=<?php echo $p['id']; ?>">
					<div class="userPosts">
						<div class="post__img" class="<?php echo $p['filter']; ?>" style="background-image: url('<?php echo $p['image']; ?>')"></div>
            			<p class="timeAgo"><?php echo $time; ?></p>
					</div>
				</a>
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

				<?php if ($likeCount == 1): ?>
					<span class="likes-count"><?php echo $likeCount; ?> like</span>
				<?php endif; ?>

				<?php if ($likeCount == 0 || $likeCount > 1) : ?>
					<span class="likes-count"><?php echo $likeCount; ?> likes</span>
				<?php endif; ?>
			</div>
			<?php if ($_SESSION['userID'] == $p['user_id']): ?>
				<div class="edit">
					<a href="#" class="edit_button"><i class="fas fa-ellipsis-h"></i></a>
					<div class="edit__options">
						<a href="#" class="option--delete">Delete</a>
						<form action="postDelete.php" method="POST" class="form--delete">
							<input type="hidden" value="<?php echo $p['image']; ?>" name="delete_file"/>
							<input type="submit" name="delete" value="Delete">
						</form>
						<a href="#" class="option--edit">Edit</a>
						<form action="postEdit.php" method="POST" class="form--edit">
							<input type="hidden" value="<?php echo $p['id']; ?>" name="file_id">
							<textarea name="descriptionEdit"><?php echo $p['description']; ?></textarea><br>
							<input type="submit" name="update" value="Update">
						</form>
					</div>
				</div>
			<?php endif; ?>
				</div>
			<?php endforeach; ?>
    </div>
	</main>
    <!--Pop up sceen-->
    <?php if (!empty($_GET['image'])): ?>
		<?php $post = new Post(); $post->showImage($_GET['image']); ?>
		<?php foreach ($post->showImage($_GET['image']) as $p): ?>
			<div class="popup">
				<div class="post">
					<img src="<?php echo $p['image']; ?>" class="<?php echo $p['filter']; ?>">
					<!--Show the colors of the image. -->
					<div class="color">
						<?php $c = Color::getColors($p['id']); ?>
						<!--Loop through all colors to display them from highest value to lowest.-->
						<?php foreach ($c as $key => $value): ?>
							<!--Only show found colors.-->
							<?php if ($value != 0): ?>
								<a href="search.php?color=<?php echo $key; ?>">
									<div class="color__item color__item--<?php echo $key; ?>"></div>
								</a>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<p><?php echo $p['description']; ?></p>
				</div>
				<a href="profile.php" class="close">X</a>';
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
<?php
    if (!empty($_GET['upload'])) {
        ?>
	<div class="popup">
        <div class="imageUpload">
        	<form action="#" method="post" enctype="multipart/form-data" id="uploadForm">
            	<label for="fileToUpload">Select image to upload:</label>
				<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
				<label for="description">Description:</label>
				<input type="text" name="description" id="description" required><br><br>
				<input type="submit" value="Upload Image" name="submit">
				<label for="filter">Filter</label>
				<select name="filter" id="filter">
					<option value="" selected>Select filter...</option>
					<option value="1977">1977</option>
					<option value="aden">aden</option>
					<option value="brannan">brannan</option>
					<option value="brooklyn">brooklyn</option>
					<option value="clarendon">clarendon</option>
					<option value="earlybird">earlybird</option>
					<option value="gingham">gingham</option>
					<option value="hudson">hudson</option>
					<option value="inkwell">inkwell</option>
					<option value="kelvin">kelvin</option>
					<option value="lark">lark</option>
					<option value="lofi">lofi</option>
					<option value="maven">maven</option>
					<option value="mayfair">mayfair</option>
					<option value="moon">moon</option>
					<option value="nashville">nashville</option>
					<option value="perpetua">perpetua</option>
					<option value="reyes">reyes</option>
					<option value="rise">rise</option>
					<option value="slumber">slumber</option>
					<option value="stinson">stinson</option>
					<option value="toaster">toaster</option>
					<option value="valencia">valencia</option>
					<option value="walden">walden</option>
					<option value="willow">willow</option>
					<option value="xpro2">xpro2</option>
				</select>
				<div id="filter1977" style="width: 450px; height: 450px; background:red;display:none"><div>
          	</form>
        	<?php
                if (isset($feedback)) {
                    echo $feedback;
                } ?>
        </div>
        <a href="profile.php" class="close">X</a>
    </div>
	<?php
    } ?>

	<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
	<script src="js/like.js"></script>
	<script src="js/edit.js"></script>
	<script src="js/preview.js"></script>
</body>
</html>
