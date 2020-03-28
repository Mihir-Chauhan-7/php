<?php

namespace Block\Checkout\Index\Cart;

class Summary extends \Block\Core\Template{

    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('\Model\Cart',true);
        $this->setTemplate('\checkout\index\cart\summary.php');
    }

    public function getCart(){
        return $this->cartModel;

    }
}

?>