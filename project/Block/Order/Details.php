<?php 

namespace Block\Order;

class Details extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate('order/details.php');    
    }

    public function getOrders(){
        return \Ccc::objectManager('\Model\Customer',true)
            ->getOrders();
    }
}

?>