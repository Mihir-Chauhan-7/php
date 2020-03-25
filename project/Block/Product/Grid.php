<?php

namespace Block\Product;


class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
        $this->setTemplate('product/view.php');
    }

    public function getProducts(){
        return $this->productModel->fetchAll();
    }

}

?>