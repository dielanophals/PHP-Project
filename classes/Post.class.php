<?php
class Post{

  protected $newDirectory;

  public function checkType($imagePost){
    $target_file = basename($imagePost["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      return false;
    }else{
      return true;
    }
  }

  public function fileSize($imagePost){
    if ($imagePost["size"] > 500000) {
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
    $this->newDirectory = "uploads/" . $dir . "/" . $randomString;
    mkdir($this->newDirectory, 0777);
  }

  public function fileExists(){
    if (file_exists($this->newDirectory)) {
      return true;
    }else{
      return false;
    }
  }

}
