<?php

class Post
{
    protected $newDirectory;
    protected $targetFile;
    protected $randomString;
    private $lat;
    private $long;
    private $city;

    public function checkType($imagePost)
    {
        $this->targetFile = basename($imagePost['name']);
        $imageFileType = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            return false;
        } else {
            return true;
        }
    }

    public function fileSize($imagePost)
    {
        if ($imagePost['size'] > 5000000) {
            return false;
        } else {
            return true;
        }
    }

    public function createDirectory($dir)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $charactersLength; ++$i) {
            $this->randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->newDirectory = 'uploads/'.$dir.DIRECTORY_SEPARATOR.$this->randomString;
        mkdir($this->newDirectory, 0777, true);
    }

    public function fileExists()
    {
        if (file_exists($this->newDirectory)) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadImage()
    {
        $target_dir = $this->newDirectory;
        $target_file = $target_dir.DIRECTORY_SEPARATOR.basename($_FILES['fileToUpload']['name']);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        return $target_file;
    }

    public function uploadProfileImage()
    {
        $target_dir = $this->newDirectory;
        $target_file = $target_dir.DIRECTORY_SEPARATOR.basename($_FILES['profileImage']['name']);
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $target_file);

        return $target_file;
    }

    public function getLocation(){
        $api_key = "e2d2e2e24294fe4b91a4ed0d521d2539";
        $freegeoipjson = file_get_contents("http://api.ipstack.com/193.191.150.3?access_key=e2d2e2e24294fe4b91a4ed0d521d2539");
        $jsondata = json_decode($freegeoipjson);

        $this->city = $jsondata->city;
        $this->lat = $jsondata->latitude;
        $this->long = $jsondata->longitude;
    }

    public function insertIntoDB($filePath, $des, $userId, $filter)
    {
        try {
            date_default_timezone_set('Europe/Brussels');
            $timestamp = date('Y-m-d H:i:s');
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO posts (user_id, image, description, latitude, longitude, city, timestamp, filter, active) VALUES ('$userId', :path, :des, '$this->lat', '$this->long', '$this->city','$timestamp', :filter, 1)");
            $statement->bindParam(':path', $filePath);
            $statement->bindParam(':des', $des);
            $statement->bindParam(':filter', $filter);
            $statement->execute();

            //Insert color in db
            $postId = $this->getPreviouslyInsertedPostId($timestamp, $userId);
            $arrColor = Color::findColors($filePath);
            Color::insertIntoDB($postId, $arrColor);
        } catch (Throwable $t) {
            return false;
        }
    }

    public function insertProfilePictureIntoDB($filePath, $userID)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET picture=:path WHERE id = '$userID'");
            $statement->bindParam(':path', $filePath);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Throwable $t) {
            return false;
        }
    }

    public static function getSearchPosts($search)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE description LIKE '%$search%' AND active = '1' ORDER BY id DESC");
            $statement->execute();
            $posts = $statement->fetchAll();

            return $posts;
        } catch (Throwable $t) {
            return false;
        }
    }

    public function getPreviouslyInsertedPostId($timestamp, $userId){
        try{
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT id FROM `posts` WHERE `timestamp` = :timestamp AND `user_id` = :id");
            $statement->bindParam(':timestamp', $timestamp);
            $statement->bindParam(':id', $userId);
            $statement->execute();
            $postId = $statement->fetch(PDO::FETCH_ASSOC);
            $postId = intval($postId["id"]);
            return $postId;
        }
        catch(Throwable $t){
            return false;
        }
    }

    public static function getPostById($id)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `posts` WHERE `id` = $id");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        } catch (Trowable $t) {
            return false;
        }
    }

    public static function like($userID, $postID)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes_post WHERE user_id = '$userID' AND post_id = '$postID'");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function likeCount($postID)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes_post WHERE post_id = '$postID' AND active = '1'");
        $statement->execute();
        $result = $statement->fetchAll();

        return count($result);
    }

    public function delete($id, $filename)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE posts SET active = '0' WHERE user_id = '$id' AND image = '$filename'");
            $result = $statement->execute();
        } catch (Throwable $t) {
            return false;
        }
    }

    public function edit($id, $desc)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE posts SET description = '$desc' WHERE id = '$id'");
            $result = $statement->execute();
        } catch (Throwable $t) {
            return false;
        }
    }
}
