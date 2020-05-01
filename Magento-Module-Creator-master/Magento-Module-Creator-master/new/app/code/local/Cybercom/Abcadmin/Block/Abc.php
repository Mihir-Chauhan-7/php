<?php
class Cybercom_Abcadmin_Block_Adminhtml_Abc extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'abcadmin';
    $this->_blockGroup = 'abcadmin';
    $this->_headerText = Mage::helper('abcadmin')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('abcadmin')->__('Add Item');
    parent::__construct();
  }
}
