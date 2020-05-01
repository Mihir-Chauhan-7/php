<?php

class Cybercom_Vendor_Block_Adminhtml_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {

        parent::__construct();

        $this->setDefaultSort('vendor_id');
        $this->setId('vendor_index_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'vendor/vendor_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header' => $this->__('ID'),
                'align' => 'right',
                'width' => '50px',
                'index' => 'vendor_id'
            )
        );
        $this->addColumn(
            'name',
            array(
                'header' => $this->__('Name'),
                'align' => 'right',
                'index' => 'name'
            )
        );
        $this->addColumn('edit',
            array(
                'header'    =>  Mage::helper('vendor')->__('Edit'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('vendor')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));
        $this->addColumn('delete',
            array(
                'header'    =>  Mage::helper('vendor')->__('Delete'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('vendor')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('vendor')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));
        return $this;
    }
}
