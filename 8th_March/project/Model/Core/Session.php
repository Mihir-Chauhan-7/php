<?php

namespace Model\Core;
session_start();

class Session {

    protected $nameSpace = NULL;

    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    public function getNameSpace()
    {
        return $this->nameSpace;
    }

    public function setSession($session)
    {
        $_SESSION[$this->getNameSpace()] = $session;
        return $this;
    }

    public function getSession(){
        if(!key_exists($this->getNameSpace(),$_SESSION)){
            return NULL;
        }
        return $_SESSION[$this->getNameSpace()];
    }

    public function __set($key,$value){
        $_SESSION[$this->getNameSpace()][$key] = $value;
        return $this;
    }

    public function __get($key){
        if(!key_exists($key,$_SESSION[$this->getNameSpace()])){
            return $_SESSION[$this->getNameSpace()];    
        }
        return $_SESSION[$this->getNameSpace()][$key];
        
    }

}

?>
