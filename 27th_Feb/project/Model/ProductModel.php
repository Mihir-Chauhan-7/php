<?php

require_once 'Core/Request.php';
require_once 'Core/Row.php';

class ProductModel extends Row{
    protected $request = NULL;
    protected $row = NULL;
    protected $tableName = 'products';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);        
    }    

    public function displayProduct(){
        $result = $this->fetchAll();
         foreach($result as &$row){
             $row = $row->getData();
         }
        return $result;
    }
    public function getProduct($id){
        return $this->fetchRow("SELECT * 
        FROM {$this->tableName} 
        WHERE {$this->primaryKey}=$id");
    }
}