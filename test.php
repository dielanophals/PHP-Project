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

    <?php
    Post::getLikesOfPost(2);
    Post::getUsersOfLikesOfPost(2);
    ?>

<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script src="js/like.js"></script>
<script src="js/edit.js"></script>
</body>
</html>
