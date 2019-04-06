<?php
    Abstract class Security{
        public function hash($password){
            $options = [
                'cost' => 10
            ];

            $hash = password_hash($password, PASSWORD_DEFAULT, $options);
            return $hash;
        }
    }