<?php
class Cybercom_Salesman_Block_Adminhtml_Index_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_index';

        $newOrEdit = $this->getRequest()->getParam('id')
        ? $this->__('Edit')
        : $this->__('New');

        $this->_headerText =  $newOrEdit . ' ' . $this->__('Salesman');


        $this->_updateButton('save', 'label', Mage::helper('salesman')->__('Save Salesman'));
        $this->_updateButton('delete', 'label', Mage::helper('salesman')->__('Delete Salesman'));
    }

}