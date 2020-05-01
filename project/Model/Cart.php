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

    public function updateCart($key,$value){
        try{
            $this->$key = $value;
            return $this->saveData();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function getAddress($type){
        $cartAddressModel = \Ccc::objectManager('\Model\Cart\Address',false);
        
        $cartAddress = $cartAddressModel->fetchRow("SELECT * FROM ".$cartAddressModel
            ->getTable()." WHERE ".$this->primaryKey." = ".$this
            ->getData($this->primaryKey)." AND type = ".$type);
                        
        if($cartAddress == NULL){
            $customerModel = \Ccc::objectManager('\Model\Customer',true);
            $customerAddress = $customerModel->getAddress($type);
        
            if($customerAddress == NULL){
                return $cartAddressModel;
            }
  
            $cartAddressModel->setData($customerAddress->getData());
            $cartAddressModel->unsetData('addressId');
            $cartAddressModel->cartId = $this->cartId;
            $cartAddressModel->saveData();
            return  $cartAddressModel;
        }
        return $cartAddress;
    }

    public function saveCartAddress($data,$type){
        $address = $this->getAddress($type);

        $address->setData($data);
        $address->cartId = $this->cartId;
        $address->customerId = $this->customerId;
        $address->type = $type;

        return $address->saveData();
    }

    public function getCartItems(){
        $cartItem = \Ccc::objectManager('\Model\Item',true);
        return $cartItem->fetchAll("SELECT * FROM ".$cartItem->getTable(). 
            " WHERE ".$this->primaryKey." = ".$this->cartId) ?? [];
    }

    public function getShipmentMethod(){
        return \Ccc::objectManager('\Model\Shipment\Method')
            ->load($this->shippingId) ?? \Ccc::objectManager('\Model\Shipment\Method');
    }

    public function updatePaymentMethod($methodId){
        return $this->updateCart('paymentId',$methodId);
    }

    public function updateShippingMethod($methodId){
        $this->updateCart('shippingId',$methodId);

        $amount = $this->getShipmentMethod($methodId)->amount;
        return $this->updateCart('shippingAmount',$amount);
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

    public function deleteCart(){  //clears all cart items
        $cartItemModel = \Ccc::objectManager('\Model\Item',false);

        foreach($this->getCartItems() as $item){
            $ids[] = $item->itemId;
        }
        
        if($cartItemModel->deleteData($ids)){
            return true;
        }

        return false;
    }

    public function reCalculateTotal(){
        $price = 0;
        foreach($this->getCartItems() as $item){
            $price += ($item->getProduct()->price) * ($item->quantity);
        }
        $this->updateCart('total',$price);
    }
    
    public function createOrder(){
        $customerModel = \Ccc::objectManager('\Model\Customer',true)
            ->load($this->customerId);
    
        $orderModel = \Ccc::objectManager('\Model\Order',true);

        $orderAddress = \Ccc::objectManager('\Model\Order\Address',false);
        $orderAddress1 = \Ccc::objectManager('\Model\Order\Address',false);

        $name = explode(' ',$customerModel->name);
        
        $orderModel->firstName = $name[0];
        $orderModel->lastName = $name[1];

        $orderModel->customerId = $customerModel->customerId; 
        $orderModel->email = $customerModel->email;
        $orderModel->mobileNo = $customerModel->mobileNo;
        $orderModel->shippingAmount = $this->shippingAmount;
        $orderModel->shippingId = $this->shippingId;
        $orderModel->paymentId = $this->paymentId;
        $orderModel->discount = $this->discount;
        $orderModel->total = $this->total;

        if($orderId = $orderModel->saveData()){
            if(\Ccc::objectManager('\Model\Order\Item',true)
            ->addItem($orderId,$this->customerId)){
            
                $shippingaddress = $this->getAddress(1);
                $billingaddress = $this->getAddress(0);
        
                $shippingaddress->unsetData('id');
                $shippingaddress->unsetData('cartId');
                $shippingaddress->orderId = $orderId;    

                $billingaddress->unsetData('cartId');
                $billingaddress->unsetData('id');
                $billingaddress->orderId = $orderId;

                $orderAddress->setData($shippingaddress->getData());
                $orderAddress1->setData($billingaddress->getData());

                if($orderAddress->saveData() && $orderAddress1->saveData()){
                    $this->id = $this->cartId;
                    return $this->deleteData();
                }

                return false;
            }
        }
    }

    public function getProducts(){
        $cartItemModel = \Ccc::objectManager('\Model\Item',false);
        return $cartItemModel->getAdapter()->fetchPairs("SELECT itemId,productId FROM ".$cartItemModel->getTable()." WHERE ".$this->primaryKey." = ".$this->getData($this->primaryKey));
    }

    
}

?>