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
    }
