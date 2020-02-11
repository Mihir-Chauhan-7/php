<?php

namespace Core;

abstract class Model{
    protected static function getDB(){

        static $db=null;
        if($db === null){
            $host="localhost";
            $dbname="demo";
            $username="root";
            $pass="";

            $conn=mysqli_connect($host,$username,$pass,$dbname);
            return $conn;
        }
        
    }
}

?>