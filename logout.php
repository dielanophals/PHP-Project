<?php
    require_once("bootstrap.php");
    Session::destroy();
    header("location: login.php");