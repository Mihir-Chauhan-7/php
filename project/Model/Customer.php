<?php namespace Model;

class Customer extends \Model\Core\Row{
    
    protected $tableName = "customers";
    protected $primaryKey = "customerId";

    public function __construct(){
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function getCart(){    
        $cartModel = \Ccc::objectManager('\Model\Cart',true);
        $cart = $cartModel->fetchRow("SELECT * FROM ".$cartModel->getTable().
            " WHERE customerId = ".$this->getData($this->primaryKey));

        if(!$cart){
            $cartModel->customerId = $this->getData($this->primaryKey);
            $cartModel->email = $this->email;
            $cartModel->saveData();
            return $cartModel;
        }
        return $cart;
    }

    public function getCustomers(){
        return $this->getAdapter()->fetchPairs("SELECT ".$this->primaryKey.",name FROM ".$this->tableName);
    }

    public function getAddreses(){
        $addressModel = \Ccc::objectManager('\Model\Customer\Address',true);
        return $addressModel->fetchAll("SELECT * FROM ".$addressModel->getTable()
            ." WHERE ".$this->primaryKey." = ".$this->getData($this->primaryKey)) ?? [];       
    }

    public function getAddress($type){
        $customerAddress = \Ccc::objectManager('\Model\Customer\Address',true);

        return $customerAddress->fetchRow("SELECT * 
            FROM ".$customerAddress->getTable().
            " WHERE ".$this->primaryKey." = "
            .$this->getData($this->primaryKey)." AND type = ".$type);
    }

    public function getOrders(){
        $orderModel = \Ccc::objectManager('\Model\Order',true);
        return $orderModel->fetchAll("SELECT * FROM ".$orderModel
            ->getTable()." WHERE ".$this->primaryKey." = ".
            $this->getData($this->primaryKey)." ORDER BY ".$orderModel->getPrimaryKey()." DESC") ?? [];
    }

    public function updateAddressType($addressIds)
    {
        foreach($this->getAddreses() as $address){
            if($addressIds['shipping'] == $address->addressId){
                $type = 1;
            }
            else if($addressIds['billing'] == $address->addressId){
                $type = 0;
            }
            else{
                $type = 2;
            }

            $address->type = $type;
            $address->saveData();
        }
    }
}