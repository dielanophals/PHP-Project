<?php
  Class ShowUserPosts{
    public function getUserPosts($userID){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$userID'");
      $statement->execute();
      $posts = $statement->fetchAll();
      return $posts;
    }
  }
