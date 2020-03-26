<?php

namespace Block\Checkout\Index\Address;

class AddressChild extends \Block\Core\Template{

    public function __construct()
    {

        $this->setTemplate('checkout\index\address\shipping.php');
    }

    public function getAddress($type){
        return \Ccc::objectManager('Model\Cart',true)
            ->getAddress($type);
    }
    

}

?>