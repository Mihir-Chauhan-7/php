<?php

namespace Model\Customer;

class Group extends \Model\Core\Row{

    protected $tableName = "customer_group";
    protected $primaryKey = "groupId";

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }
}

?>