<?php

namespace Block\Category;

class Grid extends \Block\Core\Component\Grid{
    
    protected $title = 'Categories';    
    protected $categoryColumns = [
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
        'status' => 
            [ 
                'label' => 'Status',
                'method' => 'getStatusLabel',
            ],
        'name' => 
            [
                'label' => 'Name',
                'method' => 'getName',
            ],
        'level' =>
            [
                'label' => 'Level',
                'column' => 'level'
            ],
        'parent' =>
            [
                'label' => 'Parent',
                'method' => 'getParentName'
            ]
    ];

    protected $categoryActions = [

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
        $this->setColumns($this->categoryColumns);
        $this->setActions($this->categoryActions);
        $this->categoryModel  = \Ccc::objectManager('\Model\Category',true);
        $this->setModel($this->categoryModel);

    }

    public function getParentName($row){
        if($name = $row->getParentName()){
            return '<span class="badge badge-info">'.$name.'</span>';
        }

        return '<span class="badge badge-secondary">No Parent</span>';
    }

    public function getStatusLabel($row){
        $class = $row->status ? 'success' : 'danger';  

        return "<span class='badge badge-".$class."'>".$row
            ->getStatusLabel()."</span>";
    }

    public function getName($row){
        return $row->getName($row->path);
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