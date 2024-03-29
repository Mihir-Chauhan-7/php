<?php

namespace Model;

class Item extends \Model\Core\Row{

    protected $tableName = "cart_items";
    protected $primaryKey = "itemId";
    
    public function __construct()
    {   
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function getProduct(){
        $product = \Ccc::objectManager('\Model\Product',false)
            ->load($this->productId);
        return $product;
    }
}

?>