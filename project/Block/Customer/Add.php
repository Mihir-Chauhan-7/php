<?php

namespace Block\Customer;

class Add extends \Block\Core\Template{

    protected $customer;
    public function __construct()
    {
        $this->setTemplate('customer/form.php');
    }

    public function getAddress(){
        return $this->address;
    }
    
    public function getCustomer(){
        return \Ccc::objectManager('\Model\Customer',true);
    }
}

?>