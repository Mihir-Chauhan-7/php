<?php

namespace Block\Checkout\Index\Address;

class Billing extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate('checkout\index\address\billing.php');
    }

    public function getAddress($type){
        return \Ccc::objectManager('\Model\Cart',true)
            ->getAddress($type);
    }
    

}

?>