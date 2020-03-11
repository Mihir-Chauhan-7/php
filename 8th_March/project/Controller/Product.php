<?php

namespace Controller;

use Block\Product\Add;
use Block\Product\Gallery;
use Model\Product as ProductModel;
use Model\Product\Image;

class Product extends Base{
    
    protected $action = '';
    protected $productModel = NULL;

    public function __construct()
    {
        $this->setRequest();
        $this->imageModel = new Image();
        $this->productModel = new ProductModel();

    }

    public function setProduct($singleProduct){
        $this->productModel = $singleProduct;
        return $this;
    }

    public function getProduct(){
        return $this->productModel;
    }

    public function indexAction(){
        $grid = new \Block\Product\Grid();
        echo $grid->toHTML();
    }

    public function addAction(){
        $this->action = 'Add';
        $add = new Add(); 
        $add->setProduct($this->productModel);
        echo $add->toHTML();
    }

    public function editAction(){

        $this->action = 'Update';
        try{
            
            $id = (int) $this->getRequest()->getRequest('id');

            if(!$id){
                throw new Exception("Invalid Operation");
            }

            if($this->productModel->load($id) == NULL){
                throw new Exception("Product Not Found");
            }

            $add = new Add(); 
            $add->setProduct($this->productModel->load($id));
            echo $add->toHTML();

        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function deleteAction(){
        
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                if($id){
                    $this->productModel->id = $id;
                    if($this->productModel->deleteData()){
                        $this->redirect('index');
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){

                if($idList){
                    foreach($idList as $id){
                        $this->productModel->id = $id;
                        $this->productModel->deleteData();
                    }
                    $this->redirect('index');
                }
            }
            else{
                throw new Exception('Invalid Operation');
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }    
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->getPOST()){
                throw new Exception('Invalid Data');
            }
    
            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->productModel->load($id);
            }        
    
            $this->productModel->setData($this->getRequest()->getPOST());        
            if(!$this->productModel->saveData()){
                throw new Exception("Error Operation Failed");
            }
            $this->redirect('index');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function viewGalleryAction(){
        
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Request");
            }
            if(!($product = $this->productModel->load($id))){
                throw new Exception("Product Not Loaded");
            }

            $gallery = new Gallery();
            $gallery->setImages($this->imageModel);
            $gallery->setProduct($product);
            echo $gallery->toHTML();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveImageAction(){
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Request");
            }

            if(!($product = $this->productModel->load($id))){
                throw new Exception("Product Not Loaded");
            }

            $this->setProduct($product);
            if((key_exists('image',$_FILES) && empty($_FILES['image']['name']))){
                throw new Exception("Image Not Found");
            }
            $this->imageModel = $this->productModel->uploadImage($_FILES);
            header('Location:'.$this->getUrl('viewGallery',Null,['id' => $id]));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function deleteImageAction(){
        try{

            $productId = (int)$this->getRequest()->getRequest('pid');
            $id = (int)$this->getRequest()->getRequest('id');
            
            if(!$id){
                throw new Exception("Invalid Request");
            }

            $this->imageModel->id = $id;
            
            if($this->imageModel->deleteData()){
                header('Location:'.$this->
                    getUrl('viewGallery',NULL,['id' => $productId]));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }   
    }

    public function updateGalleryAction(){
        try{
            $productId = $this->getRequest()->getRequest('id');
            if(!$productId){
                throw new Exception("Invalid Request");
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
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>