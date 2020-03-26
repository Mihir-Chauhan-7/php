<?php

namespace Block\Checkout\Index;

class PaymentMethod extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate('checkout\index\paymentmethod.php');
    }

    public function getPaymentMethods(){
        return \Ccc::objectManager('\Model\Payment\Method',false)
            ->fetchAll() ?? [];
    }
}
?>