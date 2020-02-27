<?php

class Request{

    public function isPOST(){
        return $_SERVER['REQUEST_METHOD'] != 'POST' ? false : true;
    }
    
    public function isGET(){
        return $_SERVER['REQUEST_METHOD'] != 'GET' ? false : true;
    }

    public function getPOST($key = NULL, $value = NULL){
        if($this->isPOST()){
            if($key != NULL){
                return key_exists($key, $_POST) ? $_POST[$key] : NULL;
            }
            else if($value != NULL){
                //return in_array($value, $_POST) ? $value : NULL;
                return $value;
            }
            else{
                return $_POST;
            }
        }
        return NULL;
    }

    public function getGET(){
        return $this->isGET() ? $_GET : NULL; 
    }

    public function getRequest(){

    }

}
$request = new Request();
var_dump($request->getPOST('name',NULL));
var_dump($request->getPOST(NULL,'Mihir'));
var_dump($request->getPOST(NULL,NULL));
?>
<form method="POST">
<input type="text"  name="name">
<input type="submit">
</form>