<?php

namespace Model\Order;

class Address extends \Model\Core\Row{
    protected $tableName = "order_address";
    protected $primaryKey = "order_addressId";

    public function __construct(){
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    
}

?>