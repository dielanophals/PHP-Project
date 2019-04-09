<?php
    class User{
        private $email;
        private $firstname;
        private $lastname;
        private $username;
        private $password;

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

        public function getPassword(){
            return $this->password;
        }

        public function getPasswordConfirmation(){
            return $this->passwordConfirmation;
        }

        public function login($p_sEmail, $p_sPassword){
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $statement->bindParam(":email", $p_sEmail);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if(password_verify($p_sPassword, $user['password'])){
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

        public function register() {
            //2^12 hashen
            $options = [
                'cost' => 12
            ];
            //ww hashen
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);
            
        //connection with database
            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("INSERT INTO users(email, password) VALUES (:email,:password)");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $password);
                $statement->execute();
                $result = $statement->execute();
                return($result);
            }
            catch(Throwable $t){
                return false;
            }
        }
    }
