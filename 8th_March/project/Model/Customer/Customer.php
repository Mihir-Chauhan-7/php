<?php

namespace Model\Customer;

use Model\Core\Row;


class Customer extends Row{
    protected $request = NULL;
    protected $tableName = "customers";
    protected $primaryKey = "id";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }
}