<?php

class Cybercom_Abc_Model_Abc extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('abc/abc');
    }
}