<?php
class Cybercom_Vendor_Block_Adminhtml_Index_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'vendor';
        $this->_controller = 'adminhtml_index';

        $newOrEdit = $this->getRequest()->getParam('id')
        ? $this->__('Edit')
        : $this->__('New');

        $this->_headerText =  $newOrEdit . ' ' . $this->__('Vendor');


        $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save Vendor'));
        $this->_updateButton('delete', 'label', Mage::helper('vendor')->__('Delete Vendor'));
    }

}