<?php
require_once 'Controller/Core/Front.php';
require_once 'Model/Core/Request.php';

class Ccc{

    public function getBaseDirectory($path = NULL){
        if($path == NULL){
            return getcwd();
        }
        return getcwd().DIRECTORY_SEPARATOR.$path;
    }
    public function init(){
        Front::init();
    }
}

//echo Ccc::getBaseDirectory('media');
Ccc::init();
?>