<?php

namespace Model\Customer;

class Customer extends \Model\Core\Row{
    protected $tableName = "customers";
    protected $primaryKey = "id";

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

    public function getAddreses(){
        return $this->fetchAll("SELECT * FROM customer_address WHERE cid = $this->id");       
    }

    public function getAddress($id){
        return $this->fetchRow("SELECT * FROM customer_address WHERE id = $id");
    }
}