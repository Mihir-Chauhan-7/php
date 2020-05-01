<?php

namespace Block\Shipment;

class Grid extends \Block\Core\Component\Grid{
    
    protected $title = 'Shipment Methods';    
    protected $shipmentColumns = [
        'massDelete' => 
            [ 
                'label' => '<input onclick="selectAll(this)" type="checkbox"> All',
                'method' => 'getCheckBox'
            ],
        'id' => 
            [ 
                'label' => 'Id',
                'column' => 'id',
            ],
        'name' => 
            [
                'label' => 'Name',
                'column' => 'name',
            ],
        'status' => 
            [ 
                'label' => 'Status',
                'method' => 'getStatusLabel',
            ],
        'amount' =>
            [
                'label' => 'Amount',
                'column' => 'amount'
            ]
    ];

    protected $shipmentActions = [

        'edit' => 
            [
                'label' => 'Edit',
                'method' => 'getEditUrl'
            ],
        'delete' => 
            [
                'label' => 'Delete',
                'method' => 'getDeleteUrl'
            ]
    ];


    public function __construct()
    {
        parent::__construct();
        $this->shipmentMethodModel = \Ccc::objectManager('\Model\Shipment\Method',true); 
        $this->setModel($this->shipmentMethodModel);
        $this->setColumns($this->shipmentColumns);
        $this->setActions($this->shipmentActions);
    }

    public function getCheckBox($row){
        return '<input type="checkbox" name="check[]" value="'.$row
            ->{$row->getPrimaryKey()}.'" >';
    }

    public function getStatusLabel($row){
        $class = $row->status ? 'success' : 'danger';  
        
        return "<span class='badge badge-".$class."'>".$row
            ->getStatusLabel()."</span>";
    }

    public function getEditUrl($row){
        return $this->getUrl('edit',NULL,[ $row->getPrimaryKey() 
            => $row->getData($row->getPrimaryKey())]);
    }

    public function getDeleteUrl($row){
        return $this->getUrl('delete',NULL,[ $row->getPrimaryKey() 
            => $row->getData($row->getPrimaryKey())]);
    }
}
?>