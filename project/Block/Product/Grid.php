<?php

namespace Block\Product;

class Grid extends \Block\Core\Component\Grid{
    
    protected $title = 'Products';    
    protected $productColumns = [
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
                'method' => 'getName',
            ],
        'sku' => 
            [
                'label' => 'SKU',
                'column' => 'sku',
            ],
        'status' => 
            [ 
                'label' => 'Status',
                'method' => 'getStatusLabel',
            ],
        'price' => 
            [
                'label' => 'Price',
                'column' => 'price',
            ],
        'stock' => 
            [
                'label' => 'Stock',
                'column' => 'stock',
            ]
    ];

    protected $productActions = [

        'viewGallery' => 
            [
                'label' => 'View Gallery',
                'method' => 'getViewGalleryUrl'
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


    public function __construct()
    {
        parent::__construct();
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
        $this->setModel($this->productModel);
        $this->setColumns($this->productColumns);
        $this->setActions($this->productActions);
    }

    public function getName($row){
        return strlen($row->name) > 30 ? substr($row->name,0,30).".."
            : $row->name;
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

    public function getViewGalleryUrl($row){
        return $this->getUrl('viewGallery','product_media',[ $row
            ->getPrimaryKey() => $row->getData($row->getPrimaryKey())]);
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