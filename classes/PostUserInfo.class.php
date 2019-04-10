<?php 

    Class PostUserInfo {
        public function updateInfo($username, $bio, $userID) {
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET username=:name, description=:desc WHERE id='$userID'");
                $statement->bindParam(":name", $username);
                $statement->bindParam(":desc", $bio);
                $statement->execute();
            }
            catch(Throwable $t){
                return false;
            }
        }
    }