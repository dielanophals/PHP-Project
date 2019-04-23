<?php
    Abstract class Show{
        // get username & description
        public function getUserInfo($userID) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $information = $statement->fetchAll();
            return $information;
        }

        public function getUserPosts($userID){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$userID'");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }
    }