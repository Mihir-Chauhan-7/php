<?php

namespace Block\Core;

class Home extends \Block\Core\Template{

    public function __construct()
    {
       $this->setTemplate('core/home.php');
    }
}

?>