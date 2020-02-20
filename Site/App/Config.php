<?php

namespace App;
class Config{

    const ADMIN_EMAIL = 'chauhanmihir51@gmail.com';
    const ADMIN_PASSWORD = 'mihir@123';
    const HOME = '/Cybercom/php/Site/public/';
    const HOST_NAME = 'localhost';
    const DB_NAME = 'ecommerce';
    const USER_NAME = 'root';
    const PASSWORD = '';
    const SHOW_ERROR = true;

    public static function checkLogin($user){
        if($user){
            return isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']==true 
            ? true 
            : false;
        } 
        else{
            return isset($_SESSION['userId']) ? true : false;
        }
         
    }
}
?>
