<?php

namespace Block\Category;

class Grid extends \Block\Core\Template{

    protected $categories = NULL;
    
    public function __construct()
    {
        $this->setTemplate('category/view.php');
    }

    public function getCategories(){
        $this->categoryModel = new \Model\Category();
        return $this->categoryModel->fetchAll();
    }



}

?>