<?php

require_once 'Controller/Core/Front.php';
require_once 'Model/Core/Request.php';

spl_autoload_register(function($className){
    //echo "<br>".Ccc::getBaseDirectory($className).'.php';
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

}

//echo Ccc::getBaseDirectory('media');
Ccc::init();
?>