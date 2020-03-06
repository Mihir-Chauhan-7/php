<?php

namespace Controller;


use Model\Core\Request;
use Model\Product as ProductModel;
use Model\Product\Image;

class Product extends Base{
    
    protected $action = '';
    protected $productModel = NULL;

    public function __construct()
    {
        $this->request = new Request();
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
        require_once 'Views/product/view.php';
    }

    public function addAction(){
        $this->action = 'Add';
        $this->setProduct($this->productModel);
        require_once 'Views/product/form.php';
    }

    public function editAction(){

        $this->action = 'Update';
        try{
            
            $id = (int) $this->request->getRequest('id');

            if(!$id){
                throw new Exception("Invalid Operation");
            }

            if($this->productModel->load($id) == NULL){
                throw new Exception("Product Not Found");
            }

            $this->setProduct($this->productModel->load($id));
            require_once 'Views/product/form.php';
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function deleteAction(){
        
        if($id = (int)$this->request->getRequest('id')){
            $this->productModel->id = $id;
            if($this->productModel->deleteData()){
                $this->redirect('product','index');
            }
        }

        if($idList = $this->request->getRequest('check')){
            foreach($idList as $id){
                $this->productModel->id = $id;
                $this->productModel->deleteData();
            }
            $this->redirect('product','index');
        }
        
    }

    public function saveAction(){
        try{
            if(!$this->request->getPOST()){
                throw new Exception('Invalid Data');
            }
    
            if($id = (int)$this->request->getRequest('id')){
                $this->productModel->load($id);
            }        
    
            $this->productModel->setData($this->request->getPOST());        
            if(!$this->productModel->saveData()){
                throw new Exception("Error Operation Failed");
            }
            $this->redirect('product','index');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function viewGalleryAction(){
        
        try{
            $id = (int)$this->request->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Request");
            }
            if(!($product = $this->productModel->load($id))){
                throw new Exception("Product Not Loaded");
            }
            $this->setProduct($product);
            require_once 'Views/product/image.php';
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveImageAction(){
        try{
            $id = (int)$this->request->getRequest('id');
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
        if($id = (int)$this->request->getRequest('id')){
            $this->imageModel->id = $id;
            if($this->imageModel->deleteData()){
                $this->redirect('product','index');
            }
        }
    }

    public function updateGalleryAction(){
        $productId = $this->request->getRequest('id');
        $image = $this->request->getPOST('product');
        $this->productModel->setData($image);
        $this->productModel->id = $productId;
        $this->productModel->saveData();

        if(($excludeList = $this->request->getPOST('exclude')) == null){
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
}

?>