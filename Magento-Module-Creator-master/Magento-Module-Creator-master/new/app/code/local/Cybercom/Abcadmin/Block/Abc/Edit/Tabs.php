<?php

class Cybercom_Abcadmin_Block_Abc_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('abcadmin_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('abc')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('abc')->__('Item Information'),
          'title'     => Mage::helper('abc')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('abc/adminhtml_abc_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
