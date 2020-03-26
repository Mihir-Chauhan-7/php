<?php

namespace Block\Checkout\Index;

class Address extends \Block\Core\Template{
    public function __construct()
    {
        $this->setTemplate('checkout\index\address.php');
        $this->addChild('Block\Checkout\Index\Address\AddressChild','shippingAddress');
        $this->addChild('Block\Checkout\Index\Address\AddressChild','billingAddress');
        $this->getChild('billingAddress')->setTemplate('checkout\index\address\billing.php');
    }
}

?>