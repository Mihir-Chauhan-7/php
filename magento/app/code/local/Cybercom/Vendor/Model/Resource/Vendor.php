<?php

class Cybercom_Vendor_Model_Resource_Vendor extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('vendor/vendor', 'vendor_id');
    }
}
