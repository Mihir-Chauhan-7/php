<?php

namespace Block\Category\Index\Index;

class Product extends \Block\Core\Template{
    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('\Model\Cart',true);
        $currentCategory = key_exists('currentCategory',$_SESSION) 
            ? $_SESSION['currentCategory'] 
            : $_SESSION['currentCategory'] = 1; 
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true)
            ->load($currentCategory);
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->setTemplate('category\index\index\product.php');
        $this->cartItems = $this->cartModel->getCartItems();
    }


    public function getItem($productId){
        foreach($this->cartItems as $item){
            if($item->productId == $productId){
                return $item;
            }
        }
        return NULL;
    }

    public function getProducts(){
        return $this->categoryModel->getProducts();
    }

    public function getSelectedProducts(){
        return $this->cartModel->getProducts();
    }

}
?>