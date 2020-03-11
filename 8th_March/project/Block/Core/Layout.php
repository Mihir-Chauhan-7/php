<?php

namespace Block\Core;


class Layout extends Template{

    protected $controller;

    public function __construct()
    {
        $this->setTemplate('core/layout.php');
    }
    
}
?>