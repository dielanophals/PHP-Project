<?php
  require_once("../bootstrap.php");
  Session::check();
  if(!empty($_POST)){
  $friendId = $_POST['friend'];
  $user = $_SESSION['userID'];

  echo $friendId;

  try{
    Friend::removeFriend($user, $friendId);
  }
  catch(Throwable $t){
      return false;
  }
  }
