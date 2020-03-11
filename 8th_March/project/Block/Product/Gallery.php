<?php

namespace Block\Product;

class Gallery extends \Block\Core\Template{

    protected $product = NULL;

    public function __construct()
    {
        $this->setTemplate('product/image.php');
    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setImages($images){
        $this->images = $images;
        return $this;
    }

    public function getImages(){
        return $this->images;
    }

}

?>