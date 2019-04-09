<?php
  require_once("bootstrap.php");
  $s = Session::check();
  if($s === false){
      header("Location: login.php");
  }


  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $imagePost = $_FILES["fileToUpload"];
    $post = new Post();
    if($post->checkType($imagePost) === false){
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }else{
      if($post->fileSize($imagePost) === false){
        echo "Sorry, your file is too big.";
      }else{
        $post->createDirectory("posts");
        if($post->fileExists() === false){
          echo "Sorry, this file already exists. Please try again.";
        }else{
          if($post->uploadImage()){
            echo "File has been uploaded.";
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
    <title>InstaPet - Profile</title>
</head>
<body>
  <header>
      <?php require_once("nav.inc.php"); ?>
  </header>
  <div class="image_upload">
    <form action="#" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
  </form>
  </div>
</body>
</html>
