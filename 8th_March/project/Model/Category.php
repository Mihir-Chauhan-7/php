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

}