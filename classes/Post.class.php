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

    return $target_file;
  }

  public function uploadProfileImage(){
    $target_dir = $this->newDirectory;
    $target_file = $target_dir . "/" . basename($_FILES["profileImage"]["name"]);
    move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);

    return $target_file;
  }

  public function insertIntoDB($filePath, $des, $userID){
    try{
        $timestamp = date('Y-m-d H:i:s');
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO posts (user_id, image, description, timestamp, active) VALUES ('$userID', :path, :des, '$timestamp', 1)");
        $statement->bindParam(":path", $filePath);
        $statement->bindParam(":des", $des);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(Throwable $t){
        return false;
    }
  }

  public function insertProfilePictureIntoDB($filePath, $userID){
    try{
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users (picture) VALUES (:path) WHERE id = '$userID'");
        $statement->bindParam(":path", $filePath);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(Throwable $t){
        return false;
    }
  }

}