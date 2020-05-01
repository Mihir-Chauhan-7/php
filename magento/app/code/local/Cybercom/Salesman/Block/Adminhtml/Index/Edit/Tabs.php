<?php

class Cybercom_Salesman_Block_Adminhtml_Index_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('index_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('salesman')
            ->__('Salesman Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('account', array(
            'label'     => Mage::helper('salesman')->__('Account Information'),
            'content'   => $this->getLayout()->createBlock('salesman/adminhtml_index_edit_tab_account')->initForm()->toHtml(),
        ));
        $this->addTab('address', array(
            'label'     => Mage::helper('salesman')->__('Address'),
            'content'   => $this->getLayout()->createBlock('salesman/adminhtml_index_edit_tab_address')->initForm()->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
