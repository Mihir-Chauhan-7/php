<?php

namespace Block\Customer;

class Grid extends \Block\Core\Template{

    protected $customers = NULL;
    
    public function __construct()
    {
        $this->setTemplate('customer/view.php');
    }

    public function setCustomers($customers){
        $this->customers = $customers;
    }

    public function getCustomers(){
        
        return $this->customers;
    }

    public function setAddresses($addresses){
        $this->addresses = $addresses;
        return $this;
    }

    public function getAddresses(){
        return $this->addresses;
    }

}

?>