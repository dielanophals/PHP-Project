<?php
  class OpenPost{

    public function showImage($imageID){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM posts WHERE id = '$imageID'");
      $statement->execute();
      $image = $statement->fetchAll();
      return $image;
    }

}
