<?php
    require('../bootstrap.php');

    Session::check();

    if(!empty($_POST)){
        $id = $_SESSION['userID'];
        $lastId = $_POST['lastId'];
        $allPosts = array();

        try{
            $list = Friend::getListOfFriendsIds($id);
            foreach($list as $key => $value){
                $posts = Show::getNextFriendsPosts($value, $lastId);
                foreach($posts as $k => $v){
                    $allPosts[] = [$v['id'], $v['image']];
                }
            }

            $result = [
                "status" => "success",
                "message" => $allPosts
            ];
        }
        catch(Throwable $t){
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }
        
        echo json_encode($result);
    }