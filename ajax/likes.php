<?php  

    require_once("../bootstrap.php");
    Session::check();

    if (isset($_POST['liked'])) {
        $postid = $_POST['postid'];
        $userid = $_SESSION['userID'];

        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes_post WHERE post_id = '$postid' AND active = '1'");
        $statement->execute();
        $result = $statement->fetchAll();

        date_default_timezone_set("Europe/Brussels"); 
        $timestamp = date('Y-m-d H:i:s');

        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO likes_post (user_id, post_id, active) VALUES ($userid, $postid, 1)");
        $statement->execute();

        $likes = count($result)+1;
        echo $likes;
    }

    if (isset($_POST['unliked'])) {
        $postid = $_POST['postid'];
        $userid = $_SESSION['userID'];

        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes_post WHERE post_id = '$postid' AND active = '1'");
        $statement->execute();
        $result = $statement->fetchAll();
    
        $conn = Db::getInstance();
        $update = $conn->prepare("DELETE FROM likes_post WHERE user_id = '$userid' AND post_id = '$postid'");
        $update->execute();

        $likes = count($result)-1;
        echo $likes;
    }