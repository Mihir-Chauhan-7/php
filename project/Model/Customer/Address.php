<?php

namespace Model\Customer;

class Address extends \Model\Core\Row{
    protected $tableName = "customer_address";
    protected $primaryKey = "addressId";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }
    
    public function getCustomer(){
        return \Ccc::objectManager('\Model\Customer',true)->load($this->customerId) ?? 0;
    }
}
?>