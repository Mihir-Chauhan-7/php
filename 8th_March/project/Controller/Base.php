<?php

namespace Controller;

abstract class Base{

    protected $request = NULL;

    public function redirect($action = null,$controller = null ,$params = null){ 
        //header('Location:'.$this->getUrl('viewGallery',Null,['id' => $id]));
        if($controller == NULL){
            $controller = $this->getRequest()->getControllerName(); 
        }
        header('Location:'.$_SERVER['PHP_SELF'].'?c='.$controller.'&a='.$action);
    }

    public function setRequest(){
        $this->request = new \Model\Core\Request();
        return $this;
    }

    public function getRequest(){
        return $this->request;
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

}