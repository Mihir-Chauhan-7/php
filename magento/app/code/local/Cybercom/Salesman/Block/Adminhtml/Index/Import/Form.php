<?php

class Cybercom_Salesman_Block_Adminhtml_Index_Import_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {       
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/importSave',
                    array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('importCSV', array(
            'legend' => Mage::helper('salesman')->__('Account Information')
        )); 
        
        $fieldset->addField(Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE, 'file', array(
            'name'     => Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE,
            'label'    => Mage::helper('importexport')->__('Please Select CSV'),
            'title'    => Mage::helper('importexport')->__('Please Select CSV'),
            'required' => true
        ));

        $fieldset->addField('btnimport', 'submit', array(
            'value' => 'Import',
            'class' => 'form-button',
            
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}