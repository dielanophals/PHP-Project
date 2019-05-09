<?php
    Abstract class Session{

        private static function start(){
            return session_start();
        }

        public static function create($id){
            self::start();
            $_SESSION["userID"] = $id;
        }

        public static function check(){
            self::start();
            if(!empty($_SESSION["userID"])){
                return true;
            }
            else{
                return false;
            }
        }

        public static function destroy(){
            return session_destroy();
        }
    }
