<?php

namespace Block\Checkout\Index;

class Address extends \Block\Core\Template{
    public function __construct()
    {
        $this->setTemplate('checkout\index\address.php');
        $this->addChild('Block\Checkout\Index\Address\Shipping','shippingAddress');
        $this->addChild('Block\Checkout\Index\Address\Billing','billingAddress');
    }
}

?>