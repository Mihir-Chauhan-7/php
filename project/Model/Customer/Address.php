<?php

namespace Model\Customer;

class Address extends \Model\Core\Row{
    protected $tableName = "customer_address";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }
}


?>