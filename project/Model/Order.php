<?php

namespace Model;

class Order extends \Model\Core\Row{

    protected $tableName = "customer_order";
    protected $primaryKey = "orderId";
    
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_CANCELED= 2;
    const STATUS_DELIVERED= 3;
    const STATUS_PENDING_LABEL = 'Pending';
    const STATUS_APPROVED_LABEL = 'Approved';
    const STATUS_CANCELED_LABEL = 'Canceled';
    const STATUS_DELIVERED_LABEL = 'Delivered';

    protected $statusOptions = [
        self::STATUS_PENDING => self::STATUS_PENDING_LABEL,
        self::STATUS_APPROVED => self::STATUS_APPROVED_LABEL,
        self::STATUS_CANCELED => self::STATUS_CANCELED_LABEL,
        self::STATUS_DELIVERED => self::STATUS_DELIVERED,
    ];


    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);   
    }

    public function getStatusLabel(){
        return key_exists($this->status,$this->statusOptions) 
            ? $this->statusOptions[$this->status] : NULL;
    }
    
    public function getStatusOptions(){
        return $this->statusOptions;
    }


    public function getOrderItems(){
        $orderItem = \Ccc::objectManager('\Model\Order\Item',true);
        return $orderItem->fetchAll("SELECT * FROM ".$orderItem->getTable()." WHERE $this->primaryKey =".$this->getData($this->primaryKey)) ?? [];
    }

    public function getShippingMethod(){
        return \Ccc::objectManager('\Model\Shipment\Method',true)->load($this->shippingId);
    }

    public function getPaymentMethod(){
        return \Ccc::objectManager('\Model\Payment\Method',true)->load($this->paymentId);
    }

    public function getShippingAddress(){
        $address = \Ccc::objectManager('\Model\Order\Address',true);
        $address->fetchRow("SELECT * FROM ".$address->getTable()
            ." WHERE ".$this->primaryKey." = ".$this
            ->getData($this->primaryKey)." AND type = 1");
        return $address;
    }

    public function getBillingAddress(){
        $address = \Ccc::objectManager('\Model\Order\Address',true);
        $address->fetchRow("SELECT * FROM ".$address->getTable()
            ." WHERE ".$this->primaryKey." = ".$this
            ->getData($this->primaryKey)." AND type = 0");
        return $address;
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

    public function getCustomerDetails(){
        return \Ccc::objectManager('\Model\Customer',true)->load($this->customerId);
    }
}

?>