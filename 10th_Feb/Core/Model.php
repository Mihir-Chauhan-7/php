<?php

namespace Core;
use App\Config;
use PDO;

abstract class Model{
    protected static function getDB(){

        static $db = null;
        if($db === null){
            // $conn = mysqli_connect(Config::HOST_NAME,Config::USER_NAME,Config::PASSWORD
            //     ,Config::DB_NAME);
            $dsn = 'mysql:host=' . Config::HOST_NAME . ';dbname=' . Config::DB_NAME 
            . ';charset=utf8';
            $conn= new PDO($dsn,Config::USER_NAME,Config::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return $conn;
    }
}

?>