<?php

class Cybercom_Vendor_Block_Adminhtml_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'vendor';
        $this->_controller = 'adminhtml_index';
        $this->_headerText = $this->__('Vendor Grid');
        parent::__construct();
    }

    public function getHeaderCssClass()
    {
        return 'icon-head head-customer';
    }
}
