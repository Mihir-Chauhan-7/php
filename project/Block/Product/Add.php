<?php

namespace Block\Product;

class Add extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate('product/form.php');
    }

    public function getProduct(){
        return \Ccc::objectManager('\Model\Product',true);;
    }

    public function getCategories(){
        return \Ccc::objectManager('\Model\Category',true)->getCategories();
    }
    
}

?>