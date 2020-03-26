<?php

namespace Block\Checkout;

class Index extends \Block\Core\Template{
    public function __construct()
    {
        $this->setTemplate('checkout\index.php');
    }
}

?>