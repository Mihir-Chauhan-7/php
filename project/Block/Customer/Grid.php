<?php

namespace Block\Customer;

class Grid extends \Block\Core\Template{

    protected $customers = NULL;
    
    public function __construct(){
        $this->setTemplate('customer/view.php');
    }

    public function getCustomers(){
        return \Ccc::objectManager('\Model\Customer\Customer',true)->fetchAll();
    }
}
?>