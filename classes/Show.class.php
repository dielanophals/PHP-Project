<?php
    Abstract class Show{
        // get username & description
        public static function getUserInfo($userID) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $information = $statement->fetchAll();
            return $information;
        }

        public static function getUserPosts($userID){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$userID'");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }

        public static function getFriendsPosts($id, $limit){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$id' LIMIT $limit");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }

    }