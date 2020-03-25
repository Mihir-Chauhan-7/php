<?php

namespace Controller\Product;


class Media extends \Controller\Base{

    protected $productModel = NULL;
    public function __construct()
    {
        $this->imageModel = \Ccc::objectManager('\Model\Product\Image',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
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
                throw new \Exception("Invalid Request.");
            }
            if(!($product = $this->productModel->load($id))){
                throw new \Exception("Product Not Loaded.");
            }

            $gallery = $this->getLayout()->createBlock('Block\Product\Gallery')->toHtml();
            $this->sendResponse('content',$gallery);
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }

    public function saveImageAction(){
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new \Exception("Invalid Request.");
            }

            if(!($product = $this->productModel->load($id))){
                throw new \Exception("Product Not Loaded.");
            }

            $this->setProduct($product);
            if((key_exists('image',$_FILES) && empty($_FILES['image']['name']))){
                throw new \Exception("Image Not Found.");
            }
            $this->imageModel = $this->productModel->uploadImage($_FILES);
            $this->displayMessage('Image Added..',1);
            header('Location:'.$this->getUrl('viewGallery',Null,['id' => $id]));
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
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
                $this->displayMessage('Image Deleted..',1);
                header('Location:'.$this->
                    getUrl('viewGallery',NULL,['id' => $productId]));
            }
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
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
                    $this->imageModel->imageId = $image['imageId'];
                    $this->imageModel->exclude = 1;
                    $this->imageModel->saveData();
                }
                else{
                    $this->imageModel->unsetData();
                    $this->imageModel->imageId = $image['imageId'];
                    $this->imageModel->exclude = 0;
                    $this->imageModel->saveData();
                }
            }
            $this->displayMessage('Images Updated..',1);
            header('Location:'.$this->getUrl('viewGallery',null,['id' => $productId]));
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }
}

?>