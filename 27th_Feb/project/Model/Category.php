<?php

namespace Model;

use Model\Core\Row;


class Category extends Row{

    protected $tableName = "categories";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function displayCategories(){
        $result = $this->fetchAll();
         
        foreach($result as &$row){
             $row = $row->getData();
         }
         
        return $result;
    }

}