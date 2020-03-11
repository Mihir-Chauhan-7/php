<?php

namespace Block\Core;

use Model\Core\Message as MessageModel;

class Message extends Template{

    public function __construct(){
        $this->setTemplate('core/message.php');
    }
    
    public function getMessage($key = NULL)
    { 
        $messageModel = new MessageModel();
        $messageModel->getSession()->setNameSpace('admin');
        if($key == NULL){
            $msg = $messageModel->getMessage();    
            $messageModel->clearMessage();    
            return $msg;
        }
        $msg = $messageModel->getMessage($key);
        $messageModel->clearMessage($key);
        return $msg;
    }

}

?>