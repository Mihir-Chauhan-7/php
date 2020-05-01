<?php

class Cybercom_Abcadmin_Block_Abc_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'abcadmin';
        $this->_controller = 'abcadmin';
        
        $this->_updateButton('save', 'label', Mage::helper('abc')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('abc')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('abc_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'abc_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'abc_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('abc_data') && Mage::registry('abc_data')->getId() ) {
            return Mage::helper('abc')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('abc_data')->getTitle()));
        } else {
            return Mage::helper('abc')->__('Add Item');
        }
    }
}
