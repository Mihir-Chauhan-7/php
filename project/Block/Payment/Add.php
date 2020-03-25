<?php

namespace Block\Payment;

class Add extends \Block\Core\Template{
    
    protected $paymentmethod = NULL;

    public function __construct()
    {
        $this->setTemplate('payment/method/form.php');
    }

    // public function setPaymentMethod($paymentmethod){
    //     $this->paymentmethod = $paymentmethod;
    //     return $this;
    // }

    public function getPaymentMethod(){
        return \Ccc::objectManager('\Model\Payment\Method',true);
    }
}

?>