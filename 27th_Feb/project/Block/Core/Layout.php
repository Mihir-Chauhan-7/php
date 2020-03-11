<?php

namespace Block\Core;


class Layout extends Template{

    protected $template;
    protected $controller;

    public function __construct()
    {
        $this->setTemplate('core/layout.php');
    }

    public function setController($controller){
        $this->controller = $controller;
    }

    public function getController(){
        return $this->controller;
    }
    
}
?>