<?php

namespace Block\Category;

class Add extends \Block\Core\Template{

    public function __construct()
    {
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->setTemplate('category/form.php');
    }
    
    public function getCategory(){
        return \Ccc::objectManager('\Model\Category',true);
    }

    public function getCategories($path = NULL){
        $categories = $this->categoryModel->getAdapter()->fetchPairs('SELECT id,name FROM Categories');
        if(!$path == NULL){
            return $this->getName($path,$categories);
        }

        $paths =   $this->categoryModel->getAdapter()->fetchPairs('SELECT id,path FROM Categories');
        foreach($paths as $id => $path){
            $paths[$id] = $this->getName($path,$categories);
        }    
        return $paths;
    }

    public function getName($path,$categories){
        $currentPath = '';
        foreach(explode('_',$path) as $parent){
            if(key_exists($parent,$categories)){
                $currentPath .= ' > '.$categories[$parent];
            }
        }
        return trim($currentPath,' > ');
    }
    // public function getCategories(){
    //     return \Ccc::objectManager('\Model\Category',true)->getAdapter()->
    //         fetchPairs("SELECT id,name FROM Categories");
        
    // }
}

?>