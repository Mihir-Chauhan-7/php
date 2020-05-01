<?php

class Cybercom_Salesman_Block_Adminhtml_Index_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('_address');
        $form->setFieldNameSuffix('address');

        $fieldset = $form->addFieldset('address', array(
            'legend' => Mage::helper('salesman')->__('Address Information')
        ));

        $fieldset->addField('line1', 'text', array(
            'label'     => Mage::helper('salesman')->__('Address Line 1'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'line1',
        ));

        $fieldset->addField('line2', 'text', array(
            'label'     => Mage::helper('salesman')->__('Address Line 2'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'line2',
        ));

        $fieldset->addField('city', 'text', array(
            'label'     => Mage::helper('salesman')->__('City'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'city',
        ));

        $fieldset->addField('zip_code', 'text', array(
            'label'     => Mage::helper('salesman')->__('Zip Code'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'zip_code',
        ));

        $fieldset->addField('mobileNo', 'text', array(
            'label'     => Mage::helper('salesman')->__('Mobile No'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'mobileNo',
        ));

        if (Mage::getSingleton('adminhtml/session')->getSalesmanData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSalesmanData());
            Mage::getSingleton('adminhtml/session')->setSalesmanData(null);
        } elseif (Mage::registry('current_salesman')) {
            $form->setValues(Mage::registry('current_salesman')->getAddress()->getData());     
        }

        $this->setForm($form);
        return $this;
    }

    // protected function _getStatusOptions()
    // {
    //     return Mage::getModel('salesman/salesman')->getStatusOptions();
    // }
}
