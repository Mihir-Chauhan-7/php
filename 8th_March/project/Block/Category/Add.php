<?php

namespace Block\Category;

class Add extends \Block\Core\Template{

    protected $category;
    public function __construct()
    {
        $this->setTemplate('category/form.php');
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getCategory(){
        
        return $this->category;
    }
}

?>