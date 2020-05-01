<?php

class Cybercom_Salesman_Model_Resource_Address_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('salesman/address');
    }
}
