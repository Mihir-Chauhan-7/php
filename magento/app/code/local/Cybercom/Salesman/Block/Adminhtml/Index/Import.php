<?php
class Cybercom_Salesman_Block_Adminhtml_Index_Import extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {

        parent::__construct();

        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_index';
        $this->_mode = 'import';
        $this->_headerText =  $this->__('Import Salesmans');

    
        $this->_updateButton('save', 'label', Mage::helper('salesman')->__('Import'));
    }

}