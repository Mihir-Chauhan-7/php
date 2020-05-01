<?php

class Cybercom_Salesman_Model_Salesman extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('salesman/salesman');
    }

    public function getAddress(){
        $address = Mage::getModel('salesman/address')->addData(['salesmanId' => $this->getId()]);
        return $address->load($this->getId(),'salesmanId');
    }
}
