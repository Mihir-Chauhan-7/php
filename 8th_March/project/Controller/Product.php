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
}

?>