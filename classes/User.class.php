<?php

    class User
    {
        private $email;
        private $firstname;
        private $lastname;
        private $username;
        private $password;
        protected $userID;

        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

            return $this;
        }

        public function setUsername($username)
        {
            $this->username = $username;

            return $this;
        }

        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        public function setPasswordConfirmation($passwordconfirmation)
        {
            $this->passwordconfirmation = $passwordconfirmation;

            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getFirstname()
        {
            return $this->firstname;
        }

        public function getLastname()
        {
            return $this->lastname;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getPasswordConfirmation()
        {
            return $this->passwordConfirmation;
        }

        //Check if user exists based on email address
        public static function isAccountAvailable($email)
        {
            $u = self::findByEmail($email);
            //Any matches?
            return $u;
        }

        // Find user based on email addres
        public static function findByEmail($email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from users where email = :email limit 1');
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->fetch(PDO::FETCH_ASSOC);

            return $statement->rowCount();
        }

        public function register()
        {
            $password = Security::hash($this->password);

            try {
                $conn = Db::getInstance();

                date_default_timezone_set('Europe/Brussels');
                $timestamp = date('Y-m-d H:i:s');
                $statement = $conn->prepare('INSERT INTO users (firstname, lastname, username, email, password, timestamp, active) VALUES (:firstname, :lastname, :username, :email, :password, :timestamp, 1)');
                $statement->bindParam(':firstname', $this->firstname);
                $statement->bindParam(':lastname', $this->lastname);
                $statement->bindParam(':username', $this->username);
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':timestamp', $timestamp);
                $result = $statement->execute();

                return $result;
            } catch (Throwable $t) {
                return false;
            }
        }

        public function login($p_sEmail, $p_sPassword)
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('SELECT * FROM users WHERE email = :email');
                $statement->bindParam(':email', $p_sEmail);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if (password_verify($p_sPassword, $user['password'])) {
                    $this->userID = $user['id'];

                    return true;
                } else {
                    return false;
                }
            } catch (Throwable $t) {
                return false;
            }
        }

        public function passwordCheck($userID)
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE id = $userID");
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if (password_verify($this->password, $user['password'])) {
                    return true;
                    echo 'gelukt!';
                } else {
                    return false;
                    echo 'niet gelukt!';
                }
            } catch (Throwable $t) {
                return false;
            }
        }

        public function updateInfo($userID)
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET email=:email, username=:name, description=:description WHERE id='$userID'");
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':name', $this->username);
                $statement->bindParam(':description', $this->description);
                $statement->execute();
            } catch (Throwable $t) {
                return false;
            }
        }

        public function updatePassword($userID)
        {
            $password = Security::hash($this->password);

            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET password=:password WHERE id='$userID'");
                $statement->bindParam(':password', $password);
                $statement->execute();
            } catch (Throwable $t) {
                return false;
            }
        }

        public function userID()
        {
            return $this->userID;
        }

        public function getUserID()
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('SELECT * FROM users WHERE email = :email');
                $statement->bindParam(':email', $this->email);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                $id = $this->userID = $user['id'];

                return $id;
            } catch (Throwable $t) {
                return false;
            }
        }

        public static function getUserInfo($userID)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            return $user;
        }

        public static function getUserInfoSettings($userID)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = '$userID'");
            $statement->execute();
            $user = $statement->fetchAll();

            return $user;
        }

        public static function getUserPosts($userID)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = '$userID' AND active = '1'");
            $statement->execute();
            $posts = $statement->fetchAll();

            return $posts;
        }

        public static function getUsernameOfDb($id){
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT username FROM `users` WHERE `id` = :id AND active = 1");
                $statement->bindParam(':id', $id);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                $user = $user["username"];
                return $user;
            }
            catch(Throwable $t){
                return false;
            }
        }

        public static function timeAgo($timestamp)
        {
            date_default_timezone_set('Europe/Brussels');
            $timeAgo = strtotime($timestamp);
            $currentTime = time();
            $timeDifference = $currentTime - $timeAgo;
            $seconds = $timeDifference;

            $minutes = round($seconds / 60);
            $hours = round($seconds / 3600);
            $days = round($seconds / 86400);
            $weeks = round($seconds / 604800);
            $months = round($seconds / 2629440);
            $years = round($seconds / 31553280);

            if ($seconds <= 60) {
                return 'Just Now';
            } elseif ($minutes <= 60) {
                if ($minutes == 1) {
                    return 'One minute ago';
                } else {
                    return "$minutes minutes ago";
                }
            } elseif ($hours <= 24) {
                if ($hours == 1) {
                    return 'An hour ago';
                } else {
                    return "$hours hrs ago";
                }
            } elseif ($days <= 7) {
                if ($days == 1) {
                    return 'Yesterday';
                } else {
                    return "$days days ago";
                }
            } elseif ($weeks <= 4.3) {
                if ($weeks == 1) {
                    return 'A week ago';
                } else {
                    return "$weeks weeks ago";
                }
            } elseif ($months <= 12) {
                if ($months == 1) {
                    return 'A month ago';
                } else {
                    return "$months months ago";
                }
            } else {
                if ($years == 1) {
                    return 'One year ago';
                } else {
                    return "$years years ago";
                }
            }
        }
    }
