<?php

namespace Block\Customer\Group;


class Grid extends \Block\Core\Component\Grid{
    
    protected $title = 'Customer Groups';    
    protected $groupColumns = [
        'massDelete' => 
            [ 
                'label' => '<input onclick="selectAll(this)" type="checkbox"> All',
                'method' => 'getCheckBox'
            ],
        'groupId' => 
            [ 
                'label' => 'Id',
                'column' => 'groupId',
            ],
        'name' => 
            [
                'label' => 'Name',
                'column' => 'name',
            ],
        'sortOrder' =>
            [
                'label' => 'Sort Order',
                'column' => 'sortOrder'
            ]
    ];

    protected $groupActions = [

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
        $this->setModel(\Ccc::objectManager('\Model\Customer\Group',true));
        $this->setColumns($this->groupColumns);
        $this->setActions($this->groupActions);    
    } 

    public function getCheckBox($row){
        return '<input type="checkbox" name="check[]" value="'.$row
            ->{$row->getPrimaryKey()}.'" >';
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