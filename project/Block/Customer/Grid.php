<?php

namespace Block\Customer;


class Grid extends \Block\Core\Component\Grid{

    protected $title = 'Customers';    
    protected $customerColumns = [
        'massDelete' =>   
            [ 
                'label' => '<input onclick="selectAll(this)" type="checkbox"> All',
                'method' => 'getCheckBox'
            ],
        'customerId' => 
            [ 
                'label' => 'Id',
                'column' => 'customerId',
            ],
        'name' => 
            [
                'label' => 'Name',
                'column' => 'name',
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
        'password' => 
            [
                'label' => 'Password',
                'column' => 'password',
            ]
    ];

    protected $customerActions = [
        'manageOrder' => 
            [
                'label' => 'Manage Order',
                'method' => 'getOrderUrl'
            ],
        'manageAddress' => 
            [
                'label' => 'Manage Address',
                'method' => 'getAddressUrl'
            ],
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
    
    public function __construct(){
        parent::__construct();
        $this->customerModel = \Ccc::objectManager('\Model\Customer',true);
        $this->setModel($this->customerModel);
        $this->setColumns($this->customerColumns);
        $this->setActions($this->customerActions);
    }

    public function getCheckBox($row){
        return '<input type="checkbox" name="check[]" value="'.$row
            ->{$row->getPrimaryKey()}.'" >';
    }

    public function getOrderUrl($row){        
        return $this->getUrl('index','category_index',[ 
            'cid' => $row->getData($row->getPrimaryKey())]);
    }

    public function getAddressUrl($row){
        return $this->getUrl('grid','customer_address',[ $row->getPrimaryKey() 
            => $row->getData($row->getPrimaryKey())]);
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