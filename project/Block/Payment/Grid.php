<?php

namespace Block\Payment;

class Grid extends \Block\Core\Component\Grid{
    
    protected $title = 'Payment Methods';    
    protected $paymentColumns = [
        'massDelete' => 
            [ 
                'label' => '<input onclick="selectAll(this)" type="checkbox"> All',
                'method' => 'getCheckBox'
            ],
        'methodId' => 
            [ 
                'label' => 'Id',
                'column' => 'methodId',
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
    ];

    protected $paymentActions = [

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
        $this->paymentMethodModel = \Ccc::
            objectManager('\Model\Payment\Method',true);
        $this->setModel($this->paymentMethodModel);
        $this->setColumns($this->paymentColumns);
        $this->setActions($this->paymentActions);
        //$this->manageColumns();
        //$this->manageActions();
    }

    public function getPaymentMethods(){
        return $this->paymentMethodModel->fetchAll();
    }

    public function getStatusLabel($row){
        $class = $row->status ? 'success' : 'danger';  
        
        return "<span class='badge badge-".$class."'>".$row
            ->getStatusLabel()."</span>";
    }

    public function getCheckBox($row){
        return '<input type="checkbox" name="check[]" value="'.$row
            ->{$row->getPrimaryKey()}.'" >';
    }

    // public function manageColumns(){
    //     foreach($this->paymentColumns as $name => $data){
    //         $this->addColumn($name,$data);
    //     }
    // }

    // public function manageActions(){
    //     foreach($this->paymentActions as $name => $data){
    //         $this->addAction($name,$data);
    //     }
    // }

    public function getEditUrl($row){
        return $this->getUrl('edit',NULL,['methodId' => $row->methodId]);
    }

    public function getDeleteUrl($row){
        return $this->getUrl('delete',NULL,['methodId' => $row->methodId]);
    }

} 

?>