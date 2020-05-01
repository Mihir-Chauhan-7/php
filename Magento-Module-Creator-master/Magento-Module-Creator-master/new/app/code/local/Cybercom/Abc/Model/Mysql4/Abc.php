<?php

class Cybercom_Abc_Model_Mysql4_Abc extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the abc_id refers to the key field in your database table.
        $this->_init('abc/abc', 'abc_id');
    }
}