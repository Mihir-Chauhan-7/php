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
        $cart = $this->fetchRow("SELECT * FROM $this->tableName WHERE customerId = $customerId");
        if(!$cart){
            $cart = \Ccc::objectManager('\Model\Cart',false);
            $cart->customerId = $customerId;
            $cart->saveData();
            return $cart;
        }
        return $cart;
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


    public function getAddress($type){
        $cartAddressModel = \Ccc::objectManager('Model\Cart\Address',false);
        $cartAddress = $cartAddressModel
            ->fetchRow("SELECT * 
                        FROM cart_address 
                        WHERE cartId = $this->cartId 
                        AND type = $type");
                        
        if($cartAddress == NULL){
            $customerAddress = \Ccc::objectManager('Model\Customer\Address',true)
                ->fetchRow("SELECT * 
                            FROM customer_address 
                            WHERE customerId = $this->customerId 
                            AND type = $type");

            if($customerAddress == NULL){
                return $cartAddressModel;
            }
            $cartAddressModel->setData($customerAddress->getData());
            $cartAddressModel->unsetData('id');
                $cartAddressModel->cartId = $this->cartId;
                $cartAddressModel->saveData();
                return  $cartAddressModel;
        }
        return $cartAddress;
    }

    public function addItem($productId){
        $cartItemModel = \Ccc::objectManager('\Model\Item',false);
        $productModel =\Ccc::objectManager('\Model\Product',true)
        ->load($productId);

        $product = $cartItemModel
            ->fetchRow("SELECT * FROM ".$cartItemModel
            ->getTable()." WHERE cartId = ".$this->cartId." AND productId = ".$productId);
        
        if($product != NULL){
            $product->quantity += 1;
            $product->saveData();
            $this->reCalculateTotal();
            return true;
        }

        $cartItemModel->cartId = $this->cartId;
        $cartItemModel->productId = $productModel->id;
        $cartItemModel->sku = $productModel->sku;

        if($cartItemModel->saveData()){
            $this->reCalculateTotal();
            return true;   
        }
        return false;
    }

    public function removeItem($productId,$all = 0){
        $cartItemModel = \Ccc::objectManager('\Model\Item',false);
        $product = $cartItemModel
            ->fetchRow("SELECT * FROM ".$cartItemModel
            ->getTable()." WHERE cartId = ".$this->cartId." AND productId = ".$productId);
        
        if($product != NULL){
            if($all){
                $product->id = $product->itemId; 
                $product->deleteData();
                return true;
            }

            if($product->quantity > 1){
                $product->quantity -= 1;
                $product->saveData();
            }

            $this->reCalculateTotal();
            return true;
        }
        
        return false;
    }

    public function deleteCart(){
        $cartItemModel = \Ccc::objectManager('\Model\Item',false);

        foreach($this->getCartItems() as $item){
            $ids[] = $item->itemId;
        }
        
        if($cartItemModel->deleteData($ids)){
            return true;
        }

        return false;
    }

    public function getShipmentMethod(){
        return \Ccc::objectManager('Model\Shipment\Method')
            ->load($this->shippingId) ?? \Ccc::objectManager('Model\Shipment\Method');
    }
}

?>