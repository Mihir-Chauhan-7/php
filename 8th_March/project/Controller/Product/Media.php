<?php

namespace Controller\Product;


class Media extends \Controller\Base{

    protected $productModel = NULL;
    public function __construct()
    {
        $this->imageModel = new \Model\Product\Image();
        $this->productModel = new \Model\Product();
        $this->setRequest();
    }

    public function setProduct($singleProduct){
        $this->productModel = $singleProduct;
        return $this;
    }

    public function getProduct(){
        return $this->productModel;
    }

    public function viewGalleryAction(){
        
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new \Exception("Invalid Request");
            }
            if(!($product = $this->productModel->load($id))){
                throw new \Exception("Product Not Loaded");
            }

            $gallery = new \Block\Product\Gallery();
            $gallery->setImages($this->imageModel);
            $gallery->setProduct($product);
            echo $gallery->toHTML();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveImageAction(){
        try{

            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new \Exception("Invalid Request");
            }

            if(!($product = $this->productModel->load($id))){
                throw new \Exception("Product Not Loaded");
            }

            $this->setProduct($product);
            if((key_exists('image',$_FILES) && empty($_FILES['image']['name']))){
                throw new \Exception("Image Not Found");
            }
            $this->imageModel = $this->productModel->uploadImage($_FILES);
            header('Location:'.$this->getUrl('viewGallery',Null,['id' => $id]));
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function deleteImageAction(){
        try{

            $productId = (int)$this->getRequest()->getRequest('pid');
            $id = (int)$this->getRequest()->getRequest('id');
            
            if(!$id){
                throw new \Exception("Invalid Request");
            }

            $this->imageModel->id = $id;
            
            if($this->imageModel->deleteData()){
                header('Location:'.$this->
                    getUrl('viewGallery',NULL,['id' => $productId]));
            }
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }   
    }

    public function updateGalleryAction(){
        try{
            $productId = $this->getRequest()->getRequest('id');
            if(!$productId){
                throw new \Exception("Invalid Request");
            }

            $image = $this->getRequest()->getPOST('product');
            $this->productModel->setData($image);
            $this->productModel->id = $productId;
            $this->productModel->saveData();
            
            if(($excludeList = $this->getRequest()->getPOST('exclude')) == null){
                $excludeList = [];
            }

            $imageList = $this->imageModel->displayImages();

            foreach($imageList as $image){
                if(in_array($image['imageId'],$excludeList)){
                    $this->imageModel->unsetData();
                    $this->imageModel->id = $image['imageId'];
                    $this->imageModel->exclude = 1;
                    $this->imageModel->saveData();
                }
                else{
                    $this->imageModel->unsetData();
                    $this->imageModel->id = $image['imageId'];
                    $this->imageModel->exclude = 0;
                    $this->imageModel->saveData();
                }
            }
            header('Location:'.$this->getUrl('viewGallery',null,['id' => $productId]));
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}

?>