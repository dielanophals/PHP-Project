<?php
  require_once("../bootstrap.php");
  Session::check();
  if(!empty($_POST)){
  $friendId = $_POST['friend'];
  $user = $_SESSION['userID'];

  echo $friendId;

  try{
    Friend::addFriend($user, $friendId);
  }
  catch(Throwable $t){
      return false;
  }



 echo "jup";
  }
