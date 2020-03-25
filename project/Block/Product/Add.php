<?php

namespace Block\Product;

class Add extends \Block\Core\Template{

    protected $product = NULL; 
    public function __construct()
    {
        $this->setTemplate('product/form.php');
    }
    // public function setProduct($product){
    //     $this->product = $product;
    // }
    public function getProduct(){
        return \Ccc::objectManager('\Model\Product',true);;
    }
}

?>