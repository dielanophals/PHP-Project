<?php
    abstract class Db {
        private static $conn;

        public static function getConfig(){
            // get the config file
            return parse_ini_file(__DIR__ . "/../config/config.ini");
        }

        public static function getInstance() {
            if(self::$conn != null) {
                // REUSE our connection
                return self::$conn;
            }
            else {
                // CREATE a new connection

                // get the configuration for our connection from one central settings file
                try{
                    $config = self::getConfig();
                    $host = $config['host'];
                    $database = $config['database'];
                    $port = $config['port'];
                    $charset = $config['charset'];
                    $user = $config['user'];
                    $password = $config['password'];
    
                    self::$conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
                    return self::$conn;
                }
                catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
               }
            }
        }
    }