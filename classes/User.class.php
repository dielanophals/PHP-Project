<?php

    class User{
        private $email;
        private $firstname;
        private $lastname;
        private $username;
        private $password;
        protected $userID;

        public function setEmail($email){
            $this->email = $email;
            return $this;
        }

        public function setFirstname($firstname){
            $this->firstname = $firstname;
            return $this;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
            return $this;
        }

        public function setUsername($username){
            $this->username = $username;
            return $this;
        }

        public function setDescription($description) {
            $this->description = $description;
            return $this;
        }

        public function setPassword($password){
            $this->password = $password;
            return $this;
        }

        public function setPasswordConfirmation($passwordconfirmation){
            $this->passwordconfirmation = $passwordconfirmation;
            return $this;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getFirstname(){
            return $this->firstname;
        }

        public function getLastname(){
            return $this->lastname;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getPasswordConfirmation(){
            return $this->passwordConfirmation;
        }

         //Check if user exists based on email address
         public static function isAccountAvailable($email){
             $u = self::findByEmail($email);
            //Any matches?
             return $u;
        }

        // Find user based on email addres
        public static function findByEmail($email){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from users where email = :email limit 1");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $statement->fetch(PDO::FETCH_ASSOC);
            return $statement->rowCount();
        }

        public function register() {
            $password = Security::hash($this->password);

            try{
                $conn = Db::getInstance();

                date_default_timezone_set("Europe/Brussels"); 
                $timestamp = date('Y-m-d H:i:s');
                $statement = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, timestamp) VALUES (:firstname, :lastname, :username, :email, :password, :timestamp)");
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":username", $this->username);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $password);
                $statement->bindParam(":timestamp", $timestamp);
                $result = $statement->execute();
                return($result);
            } catch(Throwable $t){
                return false;
            }
        }

        public function login($p_sEmail, $p_sPassword){
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $statement->bindParam(":email", $p_sEmail);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if(password_verify($p_sPassword, $user['password'])){
                  $this->userID = $user['id'];
                  return true;
                }
                else{
                    return false;
                }
            }
            catch(Throwable $t){
                return false;
            }
        }



        public function passwordCheck($userID){
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE id = $userID");
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if(password_verify($this->password, $user['password'])){
                    return true;
                    echo "gelukt!";
                }
                else {
                    return false;
                    echo "niet gelukt!";
                }
            }
            catch(Throwable $t){
                return false;
            }
        }

        public function updateInfo($userID) {
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET email=:email, username=:name, description=:description WHERE id='$userID'");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":name", $this->username);
                $statement->bindParam(":description", $this->description);
                $statement->execute();
            }
            catch(Throwable $t){
                return false;
            }
        }

        public function updatePassword($userID) {
            $password = Security::hash($this->password);

            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET password=:password WHERE id='$userID'");
                $statement->bindParam(":password", $password);
                $statement->execute();
            }
            catch(Throwable $t) {
                return false;
            }
        }

        public function userID(){
          return $this->userID;
        }

        public function getUserID(){
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $statement->bindParam(":email", $this->email);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                  
                $id = $this->userID = $user['id'];
                return $id;
            }
            catch(Throwable $t){
                return false;
            }
        }

        public static function getUserInfo($userID) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $information = $statement->fetchAll();
            return $information;
        }

        public static function getUserPosts($userID){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$userID' AND active = '1'");
            $statement->execute();
            $posts = $statement->fetchAll();
            return $posts;
        }
    }
