<?php

namespace Block\Customer\Address;

class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->customerModel = \Ccc::objectManager('\Model\Customer\Customer',true);
        $this->setTemplate('customer/address/view.php');
    }

    public function getAddreses(){
        return $this->customerModel->getAddreses();
    }

}

?>