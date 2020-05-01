<?php

class Cybercom_Salesman_Block_Adminhtml_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        
        parent::__construct();

        $this->setDefaultSort('salesman_id');
        $this->setId('salesman_index_grid');
        $this->setDefaultDir('asc');
        //$this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'salesman/salesman_collection';
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
                'index' => 'salesman_id'
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
        $this->addColumn(
            'email',
            array(
                'header' => $this->__('Email'),
                'align' => 'right',
                'index' => 'email'
            )
        );
        $this->addColumn('edit',
            array(
                'header'    =>  Mage::helper('salesman')->__('Edit'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('salesman')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));
        $this->addColumn('delete',
            array(
                'header'    =>  Mage::helper('salesman')->__('Delete'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('salesman')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('salesman')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('salesman')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('salesman_id');
        $this->getMassactionBlock()->setFormFieldName('salesman');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('salesman')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('salesman')->__('Are you sure?')
        ));
        return $this;
    }
}
