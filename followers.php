<?php
    require_once("bootstrap.php");

    $s = Session::check();
    if ($s === false) {
        header('Location: login.php');
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
    <link rel = "stylesheet" type = "text/css" href = "css/followers.css"/>
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
                    <a href="saved.php">Saved images</a>
                    <a href="followers.php">Followers</a>
            </div>
		    <div class="profile__posts"></div>
        </div>
    </div>

    <?php $friends = Friend::getFriends($_SESSION['userID']); ?>
    <div class="container">
        <h2 class="title">Followers</h2>
        <?php foreach ( $friends as $friend ): ?>
            <a href="friend.php?id=<?php echo $friend['id']; ?>" class="friend">
                <div>
                    <p><?php echo $friend['username']; ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>
