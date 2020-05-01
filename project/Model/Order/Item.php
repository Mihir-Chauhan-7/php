<?php

namespace Model\Order;

use Exception;

class Item extends \Model\Core\Row{
    
    protected $tableName = "order_item";
    protected $primaryKey = "order_itemId";

    public function __construct()
    {
        parent::__construct();
    }

    public function addItem($orderId,$customerId){
        try{

            $cartModel = \Ccc::objectManager('\Model\Cart',true)
            ->load($customerId,'customerId');

            foreach($cartModel->getCartItems() as $item){
                $orderItem = \Ccc::objectManager('\Model\Order\Item',false);
                $productModel = \Ccc::objectManager('\Model\Product',false)
                    ->load($item->productId);
                

                $orderItem->orderId = $orderId;
                $orderItem->productId = $productModel->id;
                $orderItem->name = $productModel->name;
                $orderItem->price = $productModel->price;
                $orderItem->quantity = $item->quantity;
                $orderItem->sku = $item->sku;

                $orderItem->saveData();

            }
            return true;
        }
        catch(Exception $e){
            $e->getMessage();
            return false;
        }
    }

    public function getProduct(){
        $product = \Ccc::objectManager('\Model\Product',false)
            ->load($this->productId);
        return $product;
    }
}

?>