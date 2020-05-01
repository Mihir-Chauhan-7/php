<?php
class Cybercom_Abc_Block_Abc extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getAbc()     
     { 
        if (!$this->hasData('abc')) {
            $this->setData('abc', Mage::registry('abc'));
        }
        return $this->getData('abc');
        
    }
}