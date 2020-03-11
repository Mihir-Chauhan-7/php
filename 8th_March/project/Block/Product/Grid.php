<?php

namespace Block\Product;


class Grid extends \Block\Core\Template{

    protected $products = NULL;
    
    public function __construct()
    {
        $this->setTemplate('product/view.php');
    }

    public function getProducts(){
        $this->productModel = new \Model\Product();
        return $this->productModel->fetchAll();
    }



}

?>