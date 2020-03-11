<?php

namespace Block\Customer;

class Add extends \Block\Core\Template{

    protected $customer;
    public function __construct()
    {
        $this->setTemplate('customer/form.php');
    }

    public function setAddress($address){
        $this->address = $address;
        return $this;
    }

    public function getAddress(){
        return $this->address;
    }
    
    public function setCustomer($customer){
        $this->customer = $customer;
    }

    public function getCustomer(){
        
        return $this->customer;
    }
}

?>