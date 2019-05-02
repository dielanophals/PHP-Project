<?php	

    include_once('bootstrap.php');

    if ( !empty($_POST) ) {
        $desc = $_POST['descriptionEdit'];
        $id = $_POST['file_id'];

        echo $desc;
        echo $id;

        $del = new Post();
        $del->edit($id, $desc);
        header('Location: profile.php');

    } else {
        header('Location: profile.php');
    }