<?php

namespace Block\Category\Index\Index;

class Product extends \Block\Core\Template{
    public function __construct()
    {
        $currentCategory = key_exists('currentCategory',$_SESSION) 
            ? $_SESSION['currentCategory'] 
            : $_SESSION['currentCategory'] = 1; 
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true)
            ->load($currentCategory);
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->setTemplate('category\index\index\product.php');
        $this->items = $this->getItems();
    }

    public function getProducts(){
        return $this->categoryModel->getProducts();
    }

    public function getItems(){
        $cartId = \Ccc::objectManager('Model\Cart',true)
            ->getCart($_SESSION['customerId'])->cartId;

        $cartItem = \Ccc::objectManager('Model\Item',true);

        return $cartItem->fetchAll("SELECT * 
                FROM cart_items 
                WHERE cartId = $cartId") ?? [];
    }

    public function getItemId($productId){
        foreach($this->items as $item){
            if($item->productId == $productId){
                return $item;
            }
        }
        return NULL;
    }

    public function getSelectedProducts(){
        return $this->cartItemModel->getProducts($_SESSION['customerId']);
    }
   
    public function getProductImage($id){
        return $this->categoryModel->getProductImage($id);
    }
}
?>