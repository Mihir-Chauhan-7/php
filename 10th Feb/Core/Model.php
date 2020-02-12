<?php

namespace Core;
use App\Config;

abstract class Model{
    protected static function getDB(){

        static $db=null;
        if($db === null){
            $conn=mysqli_connect(Config::HOST_NAME,Config::USER_NAME,Config::PASSWORD
                ,Config::DB_NAME);
            return $conn;
        }
        
    }
}

?>