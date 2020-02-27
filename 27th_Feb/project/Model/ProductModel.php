<?php

require_once 'Core/Request.php';
require_once 'Core/Row.php';

class ProductModel extends Row{

    protected $tableName = 'products';
    protected $primaryKey = 'id';

    

    public function insertProduct(){
        $request = new Request();
        $row = new Row();
        
        return $result = $this->setTable($this->tableName)
            ->setPrimaryKey($this->primaryKey)
            ->setData($request
            ->getPOST())
            ->insertData();
    }
    public function displayProduct(){
        $request = new Request();
        $row = new Row();
        $result = $this->setTable($this->tableName)->fetchAll();
        foreach($result as &$row){
            $row = $row->getData();
        }
        return $result;
    }
}