<?php

namespace Controller;

abstract class Base{

    protected $message = NULL;
    protected $request = NULL;
    protected $response = NULL;
    protected $layout = NULL;

    public function redirect($action = null,$controller = null ,$params = null){ 
        if($action == NULL){
            $action = 'grid';
        }

        if($controller == NULL){
            $controller = $this->getRequest()->getControllerName(); 
        }

        header('Location:'.$_SERVER['PHP_SELF'].'?c='.$controller.'&a='.$action);
    }

    public function setRequest(){
        $this->request = \Ccc::objectManager('\Model\Core\Request',true);
        return $this;
    }

    public function getRequest(){
        if($this->request == NULL){
            $this->setRequest();
        }
        return $this->request;
    }

    public function setResponse(){
        $this->response = \Ccc::objectManager('\Model\Core\Response',true);
        return $this;
    }
    
    public function getResponse(){
        if($this->response == NULL){
            $this->setResponse();
        }
        return $this->response;
    }

    public function getBaseurl($url){
        return \Ccc::getBaseUrl($url);
    }

    public function getUrl($action = null, $controller = null, $params = []){
        $parameters = [
            'c' => NULL,
            'a' => NULL
        ];

        if($controller == NULL){
            $parameters['c'] = $this->getRequest()->getControllerName(); 
        }
        else{
            $parameters['c'] = $controller;
        }

        if($action == NULL){
            $parameters['a'] = $this->getRequest()->getActionName(); 
        }
        else{
            $parameters['a'] = $action;
        }

        if(is_array($params)){
            $parameters = array_merge($parameters,$params);
        }

        return $this->getBaseurl('?'.http_build_query($parameters));
    }

    public function setMessage(){
        $this->message = new \Model\Core\Message();
        $this->message->getSession()->setNameSpace('admin');
        return $this;
    }

    public function getMessage(){
        if($this->message == NULL){
            $this->setMessage();
        }
        return $this->message;
    }

    public function displayMessage($msg,$type = 1){
        $this->getMessage()->setMessage($msg,$type);
    }

    public function setLayout($layout = NULL){
        if($layout == NULL){
            $layout = new \Block\Core\Layout(); 
        }
        $this->layout = $layout;
        return $this;
    }

    public function getLayout(){
        if($this->layout == NULL){
            $this->setLayout();
        }
        return $this->layout;
    }

    public function renderLayout(){
        echo $this->getLayout()->toHTML();
    }

    protected function _addContent($object,$key){
        $this->getLayout()->getChild('content')->addChild($object,$key);
        return $this;
    }

    public function addElement($elementId,$html){
        $this->getResponse()->addElement($elementId,$html);
    }

    public function addIdentifier($identifier,$operation,$class){
        $this->getResponse()->addIdentifier($identifier,$operation,$class);
    }

    public function sendResponse($elementId = NULL,$html = NULL){
        $msg = $this->getLayout()->createBlock('\Block\Core\Layout\Element\Message')->toHtml();
        $this->getResponse()->addElement('message',$msg);
        
        if($elementId == NULL){
            $this->getResponse()->getJson(json_encode($this->getResponse()->generateResponse()));
            return;
        }
        
        $this->getResponse()->addElement($elementId,$html);
        $this->getResponse()->getJson(json_encode($this->getResponse()->generateResponse()));
        return;
    }

    public function getCustomer(){
        if(!$customerId = (int)$this->getRequest()->getRequest('cid')){
            $customerId = key_exists('customerId',$_SESSION) 
            ? $_SESSION['customerId'] 
            : 1;
        }

        $_SESSION['customerId'] = $customerId;
        $customerModel = \Ccc::objectManager('\Model\Customer\Customer',false)->load($customerId);
        if(!$customerModel){
            throw new Exception("Customer Not Found");
        }
        return $customerModel;
    }

    public function getCurrentCategory(){
        return key_exists('currentCategory',$_SESSION) 
            ? $_SESSION['currentCategory'] 
            : 1;
    }

    public function addElementBlock($elementId,$blockname){
        $html = $this->getLayout()->createBlock($blockname)->toHtml();
        $this->getResponse()->addElement($elementId,$html);
    }
}