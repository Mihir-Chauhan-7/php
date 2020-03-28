<?php

namespace Block\Checkout\Index;

class Details extends \Block\Core\Template{ 
    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('\Model\Cart',true);
        $this->setTemplate('checkout\index\details.php');
    }

    public function getCartDetails(){
        return $this->cartModel;
    }

}

?>