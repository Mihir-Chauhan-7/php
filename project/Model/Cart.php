<?php

namespace Model;

use Exception;

class Cart extends \Model\Core\Row{
    protected $tableName = "cart";
    protected $secondaryTable = "cart_items";
    protected $primaryKey = "cartId";
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function getCart($customerId){    
        return $this->fetchRow("SELECT * FROM $this->tableName WHERE customerId = $customerId");
    }

    public function getCartItems(){
        $cartItem = \Ccc::objectManager('Model\Item',false);
        return $cartItem
        ->fetchAll("SELECT * FROM $this->secondaryTable WHERE $this->primaryKey = $this->cartId") ?? [];
    }

    public function updateCart($key,$value){
        try{
            $this->$key = $value;
            $this->saveData();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function getCartValue($key = NULL){
        $cart = $this->fetchRow("SELECT * FROM $this->tableName WHERE $this->primaryKey = $this->cartId");
        if(!$cart){
            return $cart->$key;
        }
        return NULL;
    }

    public function reCalculateTotal(){
        $price = 0;
        foreach($this->getCartItems() as $item){
            $price += ($item->getProduct()->price) * ($item->quantity);
        }

        $this->updateCart('total',$price);
    }
}

?>