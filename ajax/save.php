<?php
  require_once("../bootstrap.php");
  Session::check();
  if(!empty($_POST)){
    $save = $_POST['save'];
    Post::savePost($save);
  }
