<?php

class Cybercom_Vendor_Block_Adminhtml_Index_Edit_Form extends Mage_Adminhtml_Block_Widget_Form

{
    protected function _prepareForm()
    {       
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save',
                    array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
        ));

        $fieldset = $form->addFieldset('vendor_form',
            array('legend' => Mage::helper('vendor')
                ->__('Vendor Details'))
        );

        $fieldset->addField('name', 'text', array(
            'label'     => Mage::helper('vendor')->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'Name',
        ));

        if (Mage::getSingleton('adminhtml/session')->getVendorData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorData());
            Mage::getSingleton('adminhtml/session')->setVendorData(null);
        } elseif (Mage::registry('current_vendor')) {
            $form->setValues(Mage::registry('current_vendor')->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return $this;
    }

}