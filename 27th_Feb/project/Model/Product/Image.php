<?php

namespace Model\Product;

use Model\Core\Request;
use Model\Core\Row;

class Image extends Row{

    protected $tableName = 'product_images';
    protected $primaryKey = 'imageId';

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);        
    }

    public function displayImages($id = null){
        $id = $id == null ? $this->request->getRequest('id') : $id;
        $result = $this->fetchAll("
            SELECT * 
            FROM `{$this->tableName}` 
            WHERE `productId` = $id");
         
        foreach($result as &$row){
            $row = $row->getData();
        }
        return $result;
    }

}
?>