<?php

    require_once("bootstrap.php");
    $s = Session::check();

    if($s === false){
        header("Location: login.php");
    }

    if ( !empty($_POST) ) {
        $imagePost = $_FILES["profileImage"];
        $update = new Post();

        if ( $update->checkType($imagePost) === false ) {
            $feedback = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if ( $update->fileSize($imagePost) === false ) {
                $feedback = "Sorry, your file is too big.";
            } else {
                $update->createDirectory("profile");
                if ( $update->fileExists() === false ) {
                    $feedback = "Sorry, this file already exists. Please try again.";
                } else {
                    $update->insertProfilePictureIntoDB($update->uploadProfileImage(), $_SESSION["userID"]);
                    $feedback = "File has been uploaded.";
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
    <link rel = "stylesheet" type = "text/css" href = "css/edit.css"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>InstaPet - Profile</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="container">
        <?php
            $information = new showUserInfo();
            $openProfilePicture = new ShowUserPosts();
        ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="profile__information">
                <?php foreach ($openProfilePicture->getUserPosts($_SESSION['userID']) as $profilePicture): ?>
                    <div class="profile" style="background-image: <?php echo $profilePicture['image']; ?>;"></div>
                <?php endforeach; ?>
                <div class="information">
                    <label for="name">Name</label><br>
                    <?php foreach($information->getUserInfo($_SESSION["userID"]) as $info): ?>
                    <textarea name="name" id="name"><?php echo $info['username'] ?></textarea><br>
                    <label for="bio">Biography</label>
                    <textarea name="bio" id="bio"><?php echo $info['description'] ?></textarea>
                    <?php endforeach; ?>
                    <label for="image">Upload profile image</label><br>
                    <input type="file" name="profileImage" id="profileImage"><br>
                    <input type="submit" value="Save"><br>
                </div>
            </div>
        </form>
        <?php
            if ( isset($feedback) ) {
                echo $feedback;
            }
        ?>
    </div>
</body>
</html>
