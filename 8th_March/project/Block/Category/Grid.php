<?php

namespace Block\Category;

class Grid extends \Block\Core\Template{

    protected $categories = NULL;
    
    public function __construct()
    {
        $this->setTemplate('category/view.php');
    }

    public function setCategories($categories){
        $this->categories = $categories;
    }

    public function getCategories(){
        
        return $this->categories;
    }



}

?>