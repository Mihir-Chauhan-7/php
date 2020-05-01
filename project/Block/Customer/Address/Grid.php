<?php

namespace Block\Customer\Address;

class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->setTemplate('customer/address/view.php');
    }
    

    public function getCustomer(){
        return \Ccc::objectManager('\Model\Customer',true);
    }

}

?>