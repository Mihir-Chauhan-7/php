<?php

namespace Model\Core;

class Url{

    protected $request = NULL;

    public function __construct()
    {
        $this->setRequest();
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

?>