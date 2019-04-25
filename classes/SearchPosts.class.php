<?php
  Class SearchPosts{
    public function getTag($search){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT id FROM tags WHERE tag LIKE '$search'");
      $statement->execute();
      $tag = $statement->fetch(PDO::FETCH_ASSOC);

      return $tag['id'];
    }
    public function getUserPosts($tag_id){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM posts WHERE tag = $tag_id ORDER BY id DESC");
      $statement->execute();
      $posts = $statement->fetchAll();
      return $posts;
    }
  }
