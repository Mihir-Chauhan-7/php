<?php

namespace Block\Core\Layout\Element;

class Message extends \Block\Core\Template{

    public function __construct(){
        $this->setTemplate('core\layout\element\message.php');
    }
    
    public function getMessage($key = NULL)
    { 
        $messageModel = \Ccc::objectManager('\Model\Core\Message');
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