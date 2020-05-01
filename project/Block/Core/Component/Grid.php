<?php

namespace Block\Core\Component;

class Grid extends \Block\Core\Template{
    
    protected $columns = [];
    protected $actions = [];
    protected $modelObject = NULL;

    public function __construct()
    {
        $this->setTemplate('core/grid.php');
    }

    public function getTitle(){
        return $this->title;
    }

    public function setModel($modelObject){
        $this->modelObject = $modelObject;
        return $this;
    }
    
    public function getModel(){
        return $this->modelObject;
    }

    public function setColumns($columns){
        $this->columns = array_merge($this->columns,$columns);
    }

    public function getColumns(){
        return $this->columns;
    }

    public function setActions($actions){
        $this->actions = array_merge($this->actions,$actions);
    }

    public function getActions(){
        return $this->actions;
    }

    public function addColumn($name,$data){
        $this->columns[$name] = $data; 
    }

    public function addAction($name,$data){
        $this->actions[$name] = $data; 
    }

    public function getCollection(){
        return $this->modelObject->fetchAll() ?? [];
    }

    public function getAddUrl(){
        return $this->getUrl('add'); 
    }
}
?>