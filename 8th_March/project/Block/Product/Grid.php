<?php

namespace Block\Product;


class Grid extends \Block\Core\Template{

    protected $products = NULL;
    
    public function __construct()
    {
        $this->setTemplate('product/view.php');
    }

    public function setProducts($products){
        $this->products = $products;
    }

    public function getProducts(){
        
        return $this->products;
    }



}

?>