<?php 

namespace Block\Checkout\Index;

class Customer extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->setTemplate('checkout\index\customer.php');
    }

    public function getCustomer(){
        return \Ccc::objectManager('\Model\Customer\Customer',false)->load($_SESSION['customerId']);
    }
}

?>