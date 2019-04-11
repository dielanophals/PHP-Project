<?php

    require_once("bootstrap.php");
    $s = Session::check();

    if($s === false){
        header("Location: login.php");
    }

    if ( !empty($_POST) ) {
        if ( !empty($_POST['currentPassword']) ) {
            $check = new User();
            $check->setPassword($_POST['currentPassword']);

            if ( $check->passwordCheck($_SESSION['userID']) == true ) {
                $update = new Post();

                if ( !empty($_POST['email']) ) {
                    $check->setEmail($_POST['email']);
                } else {
                    $feedback = "email cannot be empty.";
                }

                if ( !empty($_POST['name']) ) {
                    $check->setUsername($_POST['name']);
                } else {
                    $feedback = "username cannot be empty.";
                }

                if ( !empty($_POST['bio']) ) {
                    $check->setDescription($_POST['bio']);
                } else {
                    $feedback = "description cannot be empty.";
                }

                $check->updateInfo($_SESSION['userID']);

                if ( !empty($_POST['newPassword']) ) {
                    if ( !empty($_POST['confirmPassword']) ) {
                        if ( $_POST['newPassword'] == $_POST['confirmPassword'] ) {
                            $check->setPassword($_POST['newPassword']);
                            $check->updatePassword($_SESSION['userID']);
                        } else {
                            $feedback = "Your new password is not confirmed correctly.";
                        }
                    } else {
                        $feedback = "You need to confirm your password.";
                    }
                }

                if ( !empty($_FILES['profileImage']) ) {
                    $imagePost = $_FILES["profileImage"];

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

            } else {
                $feedback = "Password is incorrect.";
            }

        } else {
            $feedback = "Password cannot be empty.";
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
        <?php $information = new ShowUserInfo(); ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="profile__information">
                <?php foreach ($information->getUserInfo($_SESSION['userID']) as $profilePicture): ?>
                    <div class="profile" style="background-image: url('<?php echo $profilePicture['picture']; ?>');"></div>
                <?php endforeach; ?>
                <div class="information">
                    <?php foreach($information->getUserInfo($_SESSION["userID"]) as $info): ?>
                    <label for="name">Name</label><br>
                    <textarea name="name" id="name"><?php echo $info['username'] ?></textarea><br>
                    <label for="bio">Biography</label>
                    <textarea name="bio" id="bio"><?php echo $info['description'] ?></textarea>
                    <?php endforeach; ?>

                    <?php foreach($information->getUserInfo($_SESSION["userID"]) as $info): ?>
                    <label for="email">Email</label><br>
                    <textarea name="email" id="email"><?php echo $info['email'] ?></textarea>
                    <?php endforeach; ?>

                    <label for="newPassword">New password</label><br>
                    <input type="password" name="newPassword" id="newPassword" class="passwords" placeholder="New password"><br>
                    <label for="confirmPassword">Confirm password</label><br>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="passwords" placeholder="Confirm password"><br>
                    <label for="currentassword">Current password <span style="color:red">*</span><label><br>
                    <input type="password" name="currentPassword" id="currentPassword" class="passwords" placeholder="Current password"><br>

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
