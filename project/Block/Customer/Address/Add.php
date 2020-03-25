<?php

namespace Block\Customer\Address;

class Add extends \Block\Core\Template{
    protected $address = NULL;
    public function __construct()
    {
        $this->customerModel = \Ccc::objectManager('\Model\Customer\Customer',true);
        $this->setTemplate('customer/address/form.php');
    }

    public function getAddress(){
        return \Ccc::objectManager('\Model\Customer\Address',true);
    }
    
}

?>