<?php

namespace Controller;

class Product extends Base{
    
    protected $action = '';
    protected $productModel = NULL;

    public function __construct()
    {
        $this->imageModel = \Ccc::objectManager('\Model\Product\Image',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
        $this->productCategoriesModel = \Ccc::objectManager('\Model\Product\ProductCategories',true);
    }

    public function gridAction(){
        $gridData = $this->getLayout()->createBlock('Block\Product\Grid')->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function addAction(){
        $addData = \Ccc::objectManager('Block\Product\Add',true)->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function editAction(){
        try{
            
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Request.");
            }

            if($this->productModel->load($id) == NULL){
                throw new Exception("Product Not Found.");
            }

            $addData = \Ccc::objectManager('Block\Product\Add',true)->toHtml();
            $this->sendResponse('content',$addData);

        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        
    }

    public function deleteAction(){
        
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                if($id){
                    $this->productModel->id = $id;
                    if($this->productModel->deleteData()){
                        $this->displayMessage('Deleted Successfully..',1);
                        $this->redirect();
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                
                if($idList){
                    $this->productModel->deleteData($idList);
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new Exception('Invalid Operation.');
            }
            $gridData = $this->getLayout()->createBlock('Block\Product\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }    
    }

    public function saveAction(){
        try{
            $this->displayMessage('Inserted Successfully..',1);
            if(!$this->getRequest()->isPOST()){
                throw new Exception('Invalid Request.');
            }
            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->displayMessage('Updated Successfully..',1);
                $this->productModel->load($id);
            }        
    
            $this->productModel->setData($this->getRequest()->getPOST());
            $categoryId = $this->productModel->categoryId;
            $this->productModel->unsetData('categoryId');        
            if(!$this->productModel->saveData()){
                throw new Exception("Error Operation Failed.");
            }
        
            $productId = $this->productModel->id;

            $this->productCategoriesModel->getAdapter()->delete("DELETE FROM `product_categories` WHERE productId = $productId ");
            $this->productCategoriesModel->setData(['categoryId' => $categoryId,'productId' => $this->productModel->id]);

            if(!$this->productCategoriesModel->saveData()){
                throw new Exception("Error Operation Failed.");
            }

            $gridData = $this->getLayout()->createBlock('Block\Product\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }
}

?>