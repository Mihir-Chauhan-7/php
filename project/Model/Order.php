<?php

namespace Model;

class Order extends \Model\Core\Row{

    protected $tableName = "customer_order";
    protected $primaryKey = "orderId";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);   
    }

    public function createOrder($customerId){
        $customerModel = \Ccc::objectManager('\Model\Customer\Customer',true)
            ->load($customerId);

        $cartModel = \Ccc::objectManager('\Model\Cart',true)
            ->load($customerId,'customerId');
    
        $name = explode(' ',$customerModel->name);
        
        $this->firstName = $name[0];
        $this->lastName = $name[1];

        $this->customerId = $customerModel->id; 
        $this->email = $customerModel->email;
        $this->mobileNo = $customerModel->mobileNo;
        $this->shippingAmount = $cartModel->shippingAmount;
        $this->shippingId = $cartModel->shippingId;
        $this->paymentId = $cartModel->paymentId;
        $this->discount = $cartModel->discount;
        $this->total = $cartModel->total;

        if(\Ccc::objectManager('\Model\Order\Item',true)
            ->addItem($this->saveData(),$customerId)){
            return true;
        }
    }

    public function getOrderItems(){
        $orderItem = \Ccc::objectManager('\Model\Order\Item',true);
        return $orderItem->fetchAll("SELECT * FROM ".$orderItem->getTable()." WHERE $this->primaryKey =".$this->getData($this->primaryKey)) ?? [];
    }

    public function calculateTotal($discount=0){
        $total = 0;
        foreach($this->getOrderItems() as $item){
            $total += $item->price;
        }

        $this->total = $total;
        if($this->saveData()){
            return $total;
        }

        return false;
    }
}

?>