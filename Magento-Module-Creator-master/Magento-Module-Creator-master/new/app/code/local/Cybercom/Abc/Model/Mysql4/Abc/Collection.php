<?php

class Cybercom_Abc_Model_Mysql4_Abc_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('abc/abc');
    }
}