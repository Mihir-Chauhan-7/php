<?php

class Cybercom_Salesman_Block_Adminhtml_Index_Edit_Tab_Account extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('_account');
        $form->setFieldNameSuffix('account');

        $fieldset = $form->addFieldset('account', array(
            'legend' => Mage::helper('salesman')->__('Account Information')
        )); 
        $fieldset->addField('name', 'text', array(
            'label'     => Mage::helper('salesman')->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'Name',
        ));

        $fieldset->addField('email', 'text', array(
            'label'     => Mage::helper('salesman')->__('Email'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'Email',
        ));

        // $fieldset->addField('status', 'select', array(
        //     'label' => Mage::helper('salesman')->__('Status'),
        //     'class' => 'required-entry',
        //     'name'  => 'status',
        //     'values'   => $this->_getStatusOptions(),
        //     'value' => 'status',
        //     'required'  => true
        // ));

        if (Mage::getSingleton('adminhtml/session')->getSalesmanData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSalesmanData());
            Mage::getSingleton('adminhtml/session')->setSalesmanData(null);
        } elseif (Mage::registry('current_salesman')) {
            $form->setValues(Mage::registry('current_salesman')->getData());     
        }

        $this->setForm($form);
        return $this;
    }

    // protected function _getStatusOptions()
    // {
    //     return Mage::getModel('salesman/salesman')->getStatusOptions();
    // }
}
