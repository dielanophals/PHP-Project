<?php
  require_once("../bootstrap.php");
  Session::check();
  if(!empty($_POST)){
    $_SESSION['lat'] = $_POST['lat'];
    $_SESSION['long'] = $_POST['long'];

    echo $_SESSION['long'];
  }
