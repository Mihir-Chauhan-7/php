<?php

namespace App;
class Config{

    const ADMIN_EMAIL = 'chauhanmihir51@gmail.com';
    const ADMIN_PASSWORD = 'mihir@123';
    const HOME = 'Cybercom/php/vehicleregistration/';
    const HOST_NAME = 'localhost';
    const DB_NAME = 'vehicle';
    const USER_NAME = 'root';
    const PASSWORD = '';
    const SHOW_ERROR = true;

    public static function checkLogin(){
        
            return isset($_SESSION['userId']) ? true : false;
         
    }
}
?>
