<?php

namespace Block\Checkout\Index\Cart;

class Products extends \Block\Core\Template{

    public function __construct()
    {
        $currentCategory = key_exists('currentCategory',$_SESSION) 
            ? $_SESSION['currentCategory'] 
            : $_SESSION['currentCategory'] = 1; 
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true)
            ->load($currentCategory);
        $this->setTemplate('\checkout\index\cart\products.php');
    }

    public function getProducts(){
        return $this->categoryModel->getProducts();
    }
}

?>