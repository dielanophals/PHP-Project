<?php
Class Post{

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
    if ($imagePost["size"] > 5000000) {
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
    $this->newDirectory = "uploads/" . $dir . DIRECTORY_SEPARATOR . $this->randomString;
    mkdir($this->newDirectory, 0777, true);
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
    $target_file = $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    return $target_file;
  }

  public function uploadProfileImage(){
    $target_dir = $this->newDirectory;
    $target_file = $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["profileImage"]["name"]);
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
    }
    catch(Throwable $t){
        return false;
    }
  }

  public function insertProfilePictureIntoDB($filePath, $userID){
    try{
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET picture=:path WHERE id = '$userID'");
        $statement->bindParam(":path", $filePath);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(Throwable $t){
        return false;
    }
  }

  public function showImage($imageID){
    $conn = Db::getInstance();
    $statement = $conn->prepare("SELECT * FROM posts WHERE id = '$imageID'");
    $statement->execute();
    $image = $statement->fetchAll();
    return $image;
  }

  public function getSearchPosts($search){
    try{
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM posts WHERE description LIKE '%$search%' AND active = '1' ORDER BY id DESC");
      $statement->execute();
      $posts = $statement->fetchAll();
      return $posts;
    }
    catch(Throwable $t){
      return false;
    }
  }

  public static function getLastInsertedId(){
    try{
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 0, 1");
      $statement->execute();
      $post = $statement->fetchAll();
      return $post;
    }
    catch(Throwable $t){
      return false;
    }
  }

  public static function getPostById($id){
    try{
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM `posts` WHERE `id` = $id");
      $statement->execute();
      $result = $statement->fetchAll();
      return $result;
    }
    catch(Trowable $t){
      return false;
    }
  }

  public static function like($userID, $postID) {
    $conn = Db::getInstance();
    $statement = $conn->prepare("SELECT * FROM likes_post WHERE user_id = '$userID' AND post_id = '$postID'");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  public static function likeCount($postID) {
    $conn = Db::getInstance();
    $statement = $conn->prepare("SELECT * FROM likes_post WHERE post_id = '$postID' AND active = '1'");
    $statement->execute();
    $result = $statement->fetchAll();
    
    return count($result);
  }

  public function delete($id, $filename) {
    try {
      $conn = Db::getInstance();
      $statement = $conn->prepare("UPDATE posts SET active = '0' WHERE user_id = '$id' AND image = '$filename'");
      $result = $statement->execute();
    } catch(Throwable $t){
      return false;
    }
  }

  public function edit($id, $desc) {
    try {
      $conn = Db::getInstance();
      $statement = $conn->prepare("UPDATE posts SET description = '$desc' WHERE id = '$id'");
      $result = $statement->execute();
    } catch(Throwable $t){
      return false;
    }
  }
}
