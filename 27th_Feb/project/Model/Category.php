<?php

namespace Model;

require_once 'Core/Request.php';
require_once 'Core/Row.php';

use Model\Core\Request;
use Model\Core\Row;


class Category extends Row{

    protected $request = NULL;
    protected $tableName = "categories";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
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