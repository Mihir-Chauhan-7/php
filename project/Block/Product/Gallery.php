<?php

namespace Block\Product;

class Gallery extends \Block\Core\Template{

    protected $product = NULL;

    public function __construct()
    {
        $this->setTemplate('product/image.php');
    }

    public function getProduct(){
        return \Ccc::objectManager('\Model\Product',true);;
    }

    public function getImages(){
        return \Ccc::objectManager('\Model\Product\Image',true);
    }

}

?>