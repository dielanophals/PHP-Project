<?php
Abstract class Friend{
    static function getListOfFriendsIds($p_iUserid){
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT user1_id, user2_id FROM `friends` INNER JOIN users ON friends.user1_id = users.id WHERE friends.user1_id = :user1_id OR friends.user2_id = :user2_id");
            $statement->bindParam(":user1_id", $p_iUserid);
            $statement->bindParam(":user2_id", $p_iUserid);
            $statement->execute();
            $list = $statement->fetch(PDO::FETCH_ASSOC);

            $listOfIds = array();

            //is_array() checks if $list is an array
            if(is_array($list)){
                foreach($list as $key => $value){
                    if($value !== $p_iUserid){
                        array_push($listOfIds, $value);
                    }
                }
            }

            return $listOfIds;
        }
        catch(Throwable $t){
            return false;
        }
    }

    public static function getFriends($id) {
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT users.id, users.username FROM users INNER JOIN friends ON user1_id = users.id WHERE friends.user2_id = :user_id AND friends.active = 1");
            $statement->bindParam(":user_id", $id);
            $statement->execute();
            $list = $statement->fetchAll();

            return $list;
        }
        catch(Throwable $t){
            return false;
        }
    }

    public static function addFriend($userID, $friendId){
        //user adds new friend
        $timestamp = date('Y-m-d H:i:s');
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO friends (user1_id, user2_id, timestamp, active) VALUES ('$userID', '$friendId', '$timestamp', 1)");
        $statement->execute();
    }

    //user Removes new friend
    public static function removeFriend($userID, $friendId){
        try{
            $timestamp = date('Y-m-d H:i:s');
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM friends WHERE user1_id = '$userID' AND user2_id = '$friendId'");
            $statement->execute();
        }
        catch(Throwable $t){
            return false;
        }
    }

    public static function checkFriend($userID, $friendId){
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM friends WHERE user1_id = '$userID' && user2_id='$friendId'");
            $statement->execute();
            $statement->fetch(PDO::FETCH_ASSOC);
            return $statement->rowCount();
        }
        catch(Throwable $t){
            return false;
        }
    }

    public static function getFriendsPosts($id, $limit){
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$id' ORDER BY 'timestamp' DESC LIMIT $limit");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }
        catch(Throwable $t){
            return false;
        }
    }


    public static function getNextFriendsPosts($id, $lastId){
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT posts.*, users.username FROM posts, users WHERE user_id = '$id' AND users.id = '$id' ORDER BY 'timestamp' DESC LIMIT $lastId, 20 ");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }
        catch(Throwable $t){
            return false;
        }
    }
}
