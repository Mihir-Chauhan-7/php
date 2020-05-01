<?php

namespace Controller\Category;

use Exception;

class Index extends \Controller\Base{
    
    public function __construct()
    {
        $this->cartModel = $this->getCustomer()->getCart();
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
    }

    public function indexAction(){
        $indexBlock = $this->getLayout()
                        ->createBlock('Block\Category\Index\Index');
    
        $indexBlock->addChild('Block\Category\Index\Index\Category','category');
        $indexBlock->addChild('Block\Category\Index\Index\Product','product');      
        $indexBlock->addChild('Block\Category\Index\Index\Cart','cart');              

        $this->addElement('content',$indexBlock->toHtml());
        $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
        $this->addIdentifier('#categories','remove','activeBlue');
        $this->addIdentifier('#category_'.$this->getCurrentCategory(),'add','activeBlue');
        $this->sendResponse();
    }

    public function viewAction(){
        if(!$categoryId = (int)$this->getRequest()->getRequest('id')){
            if(!key_exists('currentCategory',$_SESSION)){
                $categoryId = 1;
            }
            else{
                $categoryId = $_SESSION['currentCategory'];
            }
        }

        \Ccc::objectManager('\Model\Category',true)->load($categoryId);
        $_SESSION['currentCategory'] = $categoryId;
        
        $this->addElementBlock('productList','Block\Category\Index\Index\Product');
        $this->addIdentifier('#categories','remove','activeBlue');
        $this->addIdentifier('#category_'.$categoryId,'add','activeBlue');
        $this->sendResponse();

    }

    public function addAction(){
        try{
            if(!$productId = (int)$this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request.");   
            }

            if($this->cartModel->addItem($productId)){
                $this->cartModel->reCalculateTotal();
                
                $this->addElementBlock('productList','Block\Category\Index\Index\Product');                
                $this->addElementBlock('cart','Block\Category\Index\Index\Cart');                
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        
        $this->sendResponse();
    }
    
    public function removeAction(){
        try{
            if(!$productId = $this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request");
            }
            
            if($this->cartModel->removeItem($productId,1)){
                $this->cartModel->recalculateTotal();
                $this->addElementBlock('productList','Block\Category\Index\Index\Product');
                $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
    
    public function updateQuantityAction(){
        try{
            if(!$productId = $this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request");
            }
            
            $flag = $this->getRequest()->getRequest('flag');

            if(!$flag){
                $this->cartModel->removeItem($productId);      
            }
            else{
                if($this->cartModel->addItem($productId)){
                }    
            }
            
            $this->cartModel->recalculateTotal();
            $this->addElementBlock('productList','Block\Category\Index\Index\Product');                
            $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
    
    public function removeCartAction(){
        try{
            if($this->cartModel->deleteCart()){
                $this->displayMessage("Cart Empty");
                
                $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
                $this->addElementBlock('productList','Block\Category\Index\Index\Product');
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
}

?>