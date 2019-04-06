<?php
    require_once("bootstrap.php");

    $s = Session::check();
    if($s === false){
        header("location: login.php");
    }
    else{
        Session::destroy();
        header("location: login.php");
    }