<?php
Abstract class Friend{
    static function getListOfFriendsIds(){
        $p_iUserid = 1;
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT user1_id, user2_id FROM `friends` INNER JOIN users ON friends.user1_id = users.id WHERE friends.user1_id = :user1_id OR friends.user2_id = :user2_id");
            $statement->bindParam(":user1_id", $p_iUserid);
            $statement->bindParam(":user2_id", $p_iUserid);
            $statement->execute();
            $list = $statement->fetch(PDO::FETCH_ASSOC);

            $listOfIds = array();

            foreach($list as $key => $value){
                if($value !== $p_iUserid){
                    array_push($listOfIds, "{$value}");
                }
            }

            return $listOfIds;
        }
        catch(Throwable $t){
            return false;
        }
    }

    static function addFriend(){
        //user adds new friend
    }
}