<?php
class Post{

  protected $newDirectory;
  protected $targetFile;
  protected $randomString;

  public function checkType($imagePost){
    $this->targetFile = basename($imagePost["name"]);
    $imageFileType = strtolower(pathinfo($this->targetFile,PATHINFO_EXTENSION));

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
    for ($i = 0; $i < $charactersLength; $i++) {
        $this->randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $this->newDirectory = "uploads/" . $dir . "/" . $this->randomString;
    mkdir($this->newDirectory, 0777);
  }

  public function fileExists(){
    if (file_exists($this->newDirectory)) {
      return true;
    }else{
      return false;
    }
  }

  public function uploadImage(){
    $target_dir = $this->newDirectory;
    $target_file = $target_dir . "/" . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    return true;
  }

}
