<?php

    // get username & description
    Class showUserInfo {
        public function getUserInfo($userID) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $information = $statement->fetchAll();
            return $information;
        }
    }