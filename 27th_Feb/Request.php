<?php

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

    public function getRequest($key = NULL,$value = NULL){
        
        if(!$this->isRequest()){
            return NULL;    
        }
        
        if($key != NULL){
            return key_exists($key, $_REQUEST) ? $_REQUEST[$key] : NULL;
        }
        else if($value != NULL){
            //return in_array($value, $_REQUEST) ? $value : NULL;
            return $value;
        }
        else{
            return $_REQUEST;
        }
    }

}
$request = new Request();
var_dump($request->getRequest('name',NULL));
var_dump($request->getRequest(NULL,'Mihir'));
var_dump($request->getRequest(NULL,NULL));
echo "<pre>";
        print_r($_REQUEST);
?>
<form method="POST">
<input type="text"  name="name">
<input type="submit">
</form>