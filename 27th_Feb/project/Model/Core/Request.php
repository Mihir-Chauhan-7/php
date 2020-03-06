<?php

namespace Model\Core;

class Request{

    public function isPOST(){
        return $_SERVER['REQUEST_METHOD'] != 'POST' ? false : true;
    }
    
    public function isGET(){
        return $_SERVER['REQUEST_METHOD'] != 'GET' ? false : true;
    }

    public function isRequest(){
        return sizeof($_REQUEST) > 0 ? true : false;
    }

    public function getPOST($key = NULL, $value = NULL){
        if($key == NULL){
            return $_POST;
        }

        if(!key_exists($key, $_POST)){
            return $value;
        }

        return $_POST[$key];
    }

    public function getGET(){
        return $this->isGET() ? $_GET : NULL; 
    }

    public function getRequest($key = NULL,$value = NULL){
        if($key == NULL){
            return $_REQUEST;
        }

        if(!key_exists($key, $_REQUEST)){
            return $value;
        }

        return $_REQUEST[$key];
        
    }

    public function getActionName(){
        return $this->getRequest('a','index');
    }

    public function getControllerName(){
        return $this->getRequest('c','index');
    }
    
}
?>