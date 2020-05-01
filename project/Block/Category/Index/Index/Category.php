<?php

namespace Block\Category\Index\Index;

class Category extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->setTemplate('category/index/index/category.php');
    }

    public function getCategories(){
        return $this->categoryModel
            ->fetchAll("SELECT * FROM Categories WHERE status != 0") ?? [];
    }
}

?>