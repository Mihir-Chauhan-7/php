<?php

namespace Block\Core;

class Dashboard extends \Block\Core\Template{

    public function __construct()
    {
       $this->setTemplate('core/dashboard.php');
    }
}

?>