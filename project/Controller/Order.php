<?php

namespace Controller;

class Order extends Base{
    public function __construct()
    {
        $this->orderModel = \Ccc::objectManager('\Model\Order',true);
    }

    public function addAction(){
        try{
            if($this->orderModel->createOrder($this->getCustomer())){
                $this->orderModel->calculateTotal();
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }

    }
}

?>