<?php

class Cybercom_Salesman_Block_Adminhtml_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_index';
        $this->_headerText = $this->__('Salesman Grid');
        $this->_addButton('custom_button', array(
            'label'     => Mage::helper('salesman')->__('Import CSV'),
            'onclick'   => "location.href='".$this->getUrl('*/*/importForm')."'",
            'class'     => '',
        ));
        parent::__construct();
    }

    public function getHeaderCssClass()
    {
        return 'icon-head head-customer';
    }
}
