<?php

class Cybercom_Salesman_Model_Resource_Address extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('salesman/address', 'address_id');
    }
}
