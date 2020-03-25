<?php

namespace Block\Payment;

class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->paymentMethodModel = \Ccc::objectManager('\Model\Payment\Method',true);
        $this->setTemplate('/payment/method/view.php');
    }

    public function getPaymentMethods(){
        return $this->paymentMethodModel->fetchAll();
    }

}


?>