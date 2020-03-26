<?php

namespace Model\Cart;

class Address extends \Model\Core\Row{
    
    protected $tableName = "cart_address";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);   
    }

}

?>