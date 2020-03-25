<?php

namespace Model\Product;

class ProductCategories extends \Model\Core\Row{
    protected $tableName = 'product_categories';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);        
    }    
    
}

?>