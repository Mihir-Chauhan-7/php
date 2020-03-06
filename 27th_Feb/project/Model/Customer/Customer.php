<?php

namespace Model\Customer;

use Model\Core\Request;
use Model\Core\Row;


class Customer extends Row{
    protected $request = NULL;
    protected $tableName = "customers";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function displayCustomers(){
        $this->setTable('customers');
        
        $result = $this->getAdapter()->fetchAll("SELECT 
            C.`id`,C.`name`,C.`email`,A.`line1`,A.`line2`,
            A.`city`,A.`state`,A.`country`,A.`code`
            FROM `{$this->tableName}` AS C INNER JOIN `address` AS A 
            ON C.`{$this->primaryKey}` = A.`cid`;");
        
        return $result;
    }

    // public function getCustomer(){
    //     $id = $this->request->getRequest('id');
        
    //     if($id != NULL){
    //         $data= $this->fetchRow("SELECT * 
    //         FROM `{$this->tableName}` AS C INNER JOIN `address` AS A 
    //         ON C.`{$this->primaryKey}` = A.`cid` WHERE C.`{$this->primaryKey}` = $id;");
    //         return $data;
    //     }

    //     return $this;
    // }
}