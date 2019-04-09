<?php
class Post{

  public function checkType(){
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }else{
      return true;
    }
  }

  public function createDirectory(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $charactersLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    mkdir("uploads/posts/" . $randomString, 0777);

    return $randomString;
  }

}
