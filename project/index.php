<?php

session_start();

require_once 'Controller/Core/Front.php';
require_once 'Model/Core/Request.php';

spl_autoload_register(function($className){
    require_once Ccc::getBaseDirectory($className).'.php';
});

class Ccc{
    public function init(){
        \Controller\Core\Front::init();
    }

    public static function getBaseDirectory($path = NULL){
    
        if($path == NULL){
            return getcwd();
        }

        return getcwd().DIRECTORY_SEPARATOR.$path;
    }

    public static function getBaseUrl($url){
        return $_SERVER['PHP_SELF'].$url;
    }

    public static function register($key,$value){ 
        if($key == NULL){
            throw new Exception("Key Cannot Be NULL");
        }
        $GLOBALS[$key] = $value;
        return $value;
    }

    public function getRegistry($key){
        return key_exists($key,$GLOBALS) ? $GLOBALS[$key] : NULL; 
    }

    public function objectManager($class,$ton = false){
        if(!$ton){
            return new $class();
        }
        if(($object = self::getRegistry($class))){
            return $object;
        }
        return self::register($class,(new $class()));
    }
}

//echo Ccc::getBaseDirectory('media');
Ccc::init();
?>