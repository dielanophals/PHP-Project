<?php
class Post{

  public function checkType($imagePost){
    $target_file = basename($imagePost);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }else{
      return true;
    }
  }

  public function createDirectory($dir){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $charactersLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    mkdir("uploads/" . $dir . "/" . $randomString, 0777);

    return $randomString;
  }

}
