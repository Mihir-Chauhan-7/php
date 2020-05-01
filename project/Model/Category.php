<?php

namespace Model;

class Category extends \Model\Core\Row{

    protected $tableName = "categories";
    protected $primaryKey = "id";
    
    const STATUS_ENABLE = 1;
    const STATUS_ENABLE_LABEL = 'Enable';
    const STATUS_DISABLE = 0;
    const STATUS_DISABLE_LABEL = 'Disable';

    protected $statusOptions = [
        self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
        self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function getCategories(){
        return $this->fetchAll() ?? []; 
    }

    public function getStatusLabel(){
        return key_exists($this->status,$this->statusOptions) 
            ? $this->statusOptions[$this->status] 
            : NULL;
    }

    public function getStatusOptions(){
        return $this->statusOptions;
    }

    public function getParentPath(){
        $parent = (new Category())->load($this->parent_id);
        return $parent->path.'_'.$this->id; 
    }

    public function getProducts(){
        $productModel = \Ccc::objectManager('\Model\Product',true);
        return $productModel->fetchAll("SELECT * 
            FROM product_categories AS PC INNER JOIN products AS P 
                ON PC.productId = P.id  WHERE PC.categoryId = $this->id");
    }

    public function updateChilds($id = NULL,$newPath = NULL){
        if($id == NULL){
            $id = $this->id;
        }    
        
        $childs = (new Category())->fetchAll("SELECT * FROM 
            Categories WHERE parent_id = $id ORDER BY id ASC") ?? [];
        $newPath = (new Category())->getAdapter()->fetchOne("SELECT path 
            FROM Categories WHERE id = $id");  

        if(sizeof($childs) > 0){
            foreach($childs as $child){
                $categoryModel = new Category();
                $child->setTable($this->tableName)->setPrimaryKey($this
                    ->primaryKey);
                $child->path = $newPath.'_'.$child->id;
                $child->level = count(explode('_',$child->path));
                $child->saveData();

                if(sizeof($categoryModel->getAdapter()->fetchRow("SELECT * 
                    FROM Categories WHERE parent_id = $child->id") ?? []) > 0 ){
                      $this->updateChilds($child->id,$newPath);
                }
            }    
        }
        else{
            return false;
        }
    }
    
    public function getChilds($id){
        $childList = []; 
        $childs = (new Category())->fetchAll("SELECT id,path 
            FROM ".$this->tableName." WHERE parent_id = $id ORDER BY id ASC") ?? [];
        if($childs > 0){
            foreach($childs as $child){
                $childList[$child->id] = $this->getChilds($child->id);
            }
        }
        
        return $childList;
    }

    public function getChildId($id = NULL){

        if($id == NULL){
           $id = $this->id ?? 'NULL'; 
        }
        
        $childList = []; 
        $childs = (new Category())->fetchAll("SELECT id 
            FROM ".$this->tableName." WHERE parent_id = ".$id) ?? [];
        if($childs > 0){
            foreach($childs as $child){
                $childList[] = $child->id;
                $childList = array_merge($childList,$this->getChildId($child->id));
            }
        }
        
        return $childList;
    }

    public function deleteChilds(){
        // foreach(){

        // }
    }

    public function getProductCount(){
        return $this->getAdapter()->fetchOne("SELECT count(id) 
            FROM product_categories WHERE categoryId = $this->id");
    }

    public function getName($path = NULL){
        if($path == NULL){
            $path = $this->path;
        }
        $categories = $this->getAdapter()->fetchPairs("SELECT id,name 
            FROM ".$this->tableName);
        $currentPath = '';
        foreach(explode('_',$path) as $parent){
            if(key_exists($parent,$categories)){
                $currentPath .= ' > '.$categories[$parent];
            }
        }
        return trim($currentPath,' > ');
    }

    public function getParentName(){
        return $this->getAdapter()
            ->fetchOne("SELECT name FROM {$this->tableName} 
                WHERE {$this->primaryKey} = $this->parent_id");
    }

}