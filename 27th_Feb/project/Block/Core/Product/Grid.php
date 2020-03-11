<?php

class Grid{

    protected $products=NULL;
    
    public function setProducts($products){
        $this->products = $products;
    }

    public function getProducts(){
        return $this->products;
    }

    
}

?>