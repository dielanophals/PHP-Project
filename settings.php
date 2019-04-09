<?php

    require_once("bootstrap.php");
    $s = Session::check();
    
    if($s === false){
        header("Location: login.php");
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
        <form action="settingsSave.php" method="post">
            <div class="profile__information">
                <div class="profile" style="background-image: url('https://www.elastic.co/assets/bltada7771f270d08f6/enhanced-buzz-1492-1379411828-15.jpg');">
                    <div class="overlay">
                        <input type="file" name="image">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                </div>
                <div class="information">
                    <label for="name">Name</label><br>
                    <textarea name="name" id="name"><?php echo "User name" ?></textarea><br>
                    <label for="bio">Biography</label>
                    <textarea name="bio" id="bio"><?php echo "User bio" ?></textarea>
                    <input type="submit" value="Save"><br>
                </div>
            </div>
        </form>
    </div>
</body>
</html>