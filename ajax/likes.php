<?php  

    if (isset($_POST['liked'])) {
        $postid = $_POST['postid'];
        $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
        $row = mysqli_fetch_array($result);
        $n = $row['likes'];
    
        mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
        mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");
    
        echo $n+1;
    }

    if (isset($_POST['unliked'])) {
        $postid = $_POST['postid'];
        $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
        $row = mysqli_fetch_array($result);
        $n = $row['likes'];
    
        mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=1");
        mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");
        
        echo $n-1;
    }