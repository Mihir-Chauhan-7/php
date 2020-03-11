<?php

namespace Model\Core;

class Message{

    protected $session = NULL;
    protected const SUCCESS = 1;
    protected const FAILED = 0;
    protected const NOTICE = 2;

    public function __construct()
    {
        $this->setSession();
    }

    public function setSession($session = NULL){
        if($session == NULL){
            $this->session = new Session();
            $this->session->getSession()['message'] = [];
            return $this;
        }

        $this->session->getSession()['message'] = $session;
        return $this;
    }
    
    public function getSession(){
        return $this->session;
    }

    public function getMessage($key = null){
        if($key == NULL){
            return $this->getSession()->getSession();
        }

        if(!key_exists($key,$this->getSession()->getSession()['message'])){

            return $this->getSession()->getSession()['message'];    
        }

        $message = $this->getSession()->getSession()['message'][$key];
        $this->clearMessage($key);
        return $message;       
    }

    public function setMessage($message,$type = NULL)
    {
        $existingMessage = $this->getSession()->message;
        if($existingMessage == NULL){
            $existingMessage = [];
        }
        switch($type){
            case self::FAILED :
                $newMessage = ['Failed' => $message];    
                break;
            case self::NOTICE :
                $newMessage = ['Notice' => $message];
                break;
            default :
                $newMessage = ['Success' => $message];
                break;  
        }
        $this->getSession()->message = array_merge($existingMessage,$newMessage);
        return $this;
    }

    public function clearMessage($key = NULL){
        if($key == NULL){
            $_SESSION[$this->getSession()->getNameSpace()]['message'] = [];
        }

        unset($_SESSION[$this->getSession()->getNameSpace()]['message'][$key]);

        
    }
}
?>