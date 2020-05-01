<?php

namespace Block\Category;

class Add extends \Block\Core\Template{

    public function __construct()
    {
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->setTemplate('category/form.php');
    }
    
    public function getCategory(){
        return $this->categoryModel;
    }

    public function getCategories(){
        return $this->categoryModel->getCategories();
    }

}

?>