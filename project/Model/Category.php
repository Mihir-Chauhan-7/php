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

    public function getStatusLabel($status){
        return key_exists($status,$this->statusOptions) ? $this->statusOptions[$status] : NULL;
    }

    public function getStatusOptions(){
        return $this->statusOptions;
    }

    public function getParentPath(){
        $parent = (new Category())->load($this->parent_id);
        return $parent->path.'_'.$this->id; 
    }

    public function getProductImage($id){
        return $this->fetchRow("SELECT name FROM product_images WHERE imageId = $id")->name;
    }

    public function getProducts(){
        return $this->fetchAll("SELECT * FROM product_categories AS PC INNER JOIN products AS P ON PC.productId = P.id  WHERE PC.categoryId = $this->id");
    }

    public function updateChilds(){

        $childs = $this->getChilds($this->id);
        $newPath = (new Category())->getAdapter()->fetchOne("SELECT path FROM Categories WHERE id = $this->id");  


        if(sizeof($childs) > 0){
            foreach($childs as $child){
                $this->update($child,$newPath);
            }    
        }
        else{
            return false;
        }
        
    }

    function update($childsList,$newPath){
        foreach($childsList as $keys => $child){
            $category = (new Category())->load($keys);
            $category->path = $newPath.'_'.$keys;
            $category->level = count(explode('_',$category->path));
            $category->saveData();
        }
    }

    public function getChilds($id){
        $childList = [];
        $childs = (new Category())->fetchAll("SELECT id,path FROM Categories WHERE parent_id = $id ORDER BY id ASC");
        if($childs > 0){
            foreach($childs as $child){
                $childList[$child->id] = $this->getChilds($child->id);
            }
        }
        
        return $childList;
    }

    public function deleteChilds(){
        // foreach(){

        // }
    }

    public function getProductCount(){
        return $this->getAdapter()->fetchOne("SELECT count(id) FROM product_categories WHERE categoryId = $this->id");
    }

    public function getName($path=NULL){
        if($path == NULL){
            $path = $this->path;
        }
        $categories = $this->getAdapter()->fetchPairs('SELECT id,name FROM Categories');
        $currentPath = '';
        foreach(explode('_',$path) as $parent){
            if(key_exists($parent,$categories)){
                $currentPath .= ' > '.$categories[$parent];
            }
        }
        return trim($currentPath,' > ');
    }

}