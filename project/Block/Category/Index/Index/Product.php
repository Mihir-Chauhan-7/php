<?php

namespace Block\Category\Index\Index;

class Product extends \Block\Core\Template{
    public function __construct()
    {
        $currentCategory = key_exists('currentCategory',$_SESSION) 
            ? $_SESSION['currentCategory'] 
            : 1; 
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true)
            ->load($currentCategory);
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->setTemplate('category\index\index\product.php');
    }

    public function getProducts(){
        return $this->categoryModel->getProducts();
    }

    public function getSelectedProducts(){
        return $this->cartItemModel->getProducts($_SESSION['customerId']);
    }
   
    public function getProductImage($id){
        return $this->categoryModel->getProductImage($id);
    }
}
?>