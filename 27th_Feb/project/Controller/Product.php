<?php

require_once 'Model/ProductModel.php';
class Product extends ProductModel{
    public function index(){
        $productList = $this->displayProduct();
        require_once 'Views/product/view.php';
    }
    public function add(){
        require_once 'Views/product/add.php';
    }

    public function save(){
        if($this->insertProduct()){
            $this->index();
        }
    }
    
}