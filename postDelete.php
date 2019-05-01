<?php	

    include_once('bootstrap.php');
    session_start();

    if ( !empty($_POST) ) {
        $filename = $_POST['delete_file'];
        $id = $_SESSION['userID'];

        $del = new Post();
        $del->delete($id, $filename);
        header('Location: profile.php');

    } else {
        header('Location: profile.php');
    }