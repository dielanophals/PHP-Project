<?php
  Class ShowTags{
    public function getTags(){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM tags ORDER BY tag ASC");
      $statement->execute();
      $posts = $statement->fetchAll();
      return $posts;
    }
  }
