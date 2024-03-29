<?php

class Cybercom_Abcadmin_Block_Abc_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('abc_form', array('legend'=>Mage::helper('abc')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('abc')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('abc')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('abc')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('abc')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('abc')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('abc')->__('Content'),
          'title'     => Mage::helper('abc')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getAbcData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getAbcData());
          Mage::getSingleton('adminhtml/session')->setAbcData(null);
      } elseif ( Mage::registry('abc_data') ) {
          $form->setValues(Mage::registry('abc_data')->getData());
      }
      return parent::_prepareForm();
  }
}