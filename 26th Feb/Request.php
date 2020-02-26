<?php

class Request{

    public function isPOST(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return false;
        }
        return true;
    }

    public function isGET(){
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return false;
        }
        return true;
    }

    public function getPOST(){
        return $this->isPOST() ? $_POST : NULL;
    }

    public function getGET(){
        return $this->isGET() ? $_GET : NULL;
    }

}
$request = new Request();
var_dump($request->getGET());
var_dump($request->getPOST());
?>
<form method="POST">
    <input type="text" name="name" >
    <input type="submit">
</form>