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
    }
