<?php

namespace Block\Order;


class Grid extends \Block\Core\Component\Grid{

    protected $title = 'Orders';    
    protected $orderColumns = [
        'massDelete' =>   
            [ 
                'label' => '<input onclick="selectAll(this)" type="checkbox"> All',
                'method' => 'getCheckBox'
            ],
        'orderId' => 
            [ 
                'label' => 'Id',
                'column' => 'orderId',
            ],
        'firstName' => 
            [
                'label' => 'First Name',
                'column' => 'firstName',
            ],
        'lastName' => 
            [
                'label' => 'Last Name',
                'column' => 'lastName',
            ],
        'email' => 
            [
                'label' => 'Email',
                'column' => 'email',
            ],
        'mobileNo' => 
            [
                'label' => 'Mobile No',
                'column' => 'mobileNo',
            ],
        'discount' => 
            [
                'label' => 'Discount',
                'column' => 'discount',
            ],
        'shippingAmount' => 
            [
                'label' => 'Shipping Charges',
                'column' => 'shippingAmount',
            ],
        'shippingMethod' => 
            [
                'label' => 'Shipping Method',
                'method' => 'getShippingMethod',
            ],
        'paymentMethod' => 
            [
                'label' => 'Payment Method',
                'method' => 'getPaymentMethod',
            ],
        'status' => 
            [
                'label' => 'Status',
                'method' => 'getStatusLabel',
            ],
    ];

    protected $orderActions = [
        'edit' => 
            [
                'label' => 'Edit',
                'method' => 'getEditUrl'
            ],
        'delete' => 
            [
                'label' => 'Delete',
                'method' => 'getDeleteUrl'
            ],
    ];

    public function __construct()
    {
        parent::__construct();
        
        $this->setModel(\Ccc::objectManager('\Model\Order'));
        $this->setColumns($this->orderColumns);
        $this->setActions($this->orderActions);
    }

    public function getCheckBox($row){
        return '<input type="checkbox" name="check[]" value="'.$row
            ->{$row->getPrimaryKey()}.'" >';
    }

    public function getAddUrl(){
        return $this->getUrl('index','category_index');
    }

    public function getEditUrl($row){
        return $this->getUrl('edit',NULL,[ $row->getPrimaryKey() 
            => $row->getData($row->getPrimaryKey())]);
    }

    public function getDeleteUrl($row){
        return $this->getUrl('delete',NULL,[ $row->getPrimaryKey() 
            => $row->getData($row->getPrimaryKey())]);
    }

    public function getStatusLabel($row){ 

        return "<span class='badge badge-info'>".$row
            ->getStatusLabel()."</span>";
    }

    public function getPaymentMethod($row){
        return $row->getPaymentMethod()->name;
    }

    public function getShippingMethod($row){
        return $row->getShippingMethod()->name;
    }

}

?>