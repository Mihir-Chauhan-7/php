<?php

namespace Controller\Category;

use Exception;

class Index extends \Controller\Base{
    
    public function __construct()
    {
        $this->cartModel = $this->getCustomer()->getCart();
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
    }

    public function indexAction(){
        $this->getCustomer();

        $indexBlock = $this->getLayout()
                        ->createBlock('Block\Category\Index\Index');
    
        $indexBlock->addChild('Block\Category\Index\Index\Category','category');
        $indexBlock->addChild('Block\Category\Index\Index\Product','product');      
        $indexBlock->addChild('Block\Category\Index\Index\Cart','cart');              
        $this->_addContent($indexBlock,'index');

        $this->addElement('content',$indexBlock->toHtml());
        $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
        $this->addIdentifier('#categories','remove','active');
        $this->addIdentifier('#category_'.$this->getCurrentCategory(),'add','active');
        $this->sendResponse();
    }

    public function viewAction(){
        if(!$id = (int)$this->getRequest()->getRequest('id')){
            if(!key_exists('currentCategory',$_SESSION)){
                $id = 1;
            }
            else{
                $id = $_SESSION['currentCategory'];
            }
        }

        \Ccc::objectManager('\Model\Category',true)->load($id);
        $_SESSION['currentCategory'] = $id;
        
        $this->addElementBlock('productList','Block\Category\Index\Index\Product');
        $this->addIdentifier('#categories','remove','active');
        $this->addIdentifier('#category_'.$id,'add','active');
        $this->sendResponse();

    }

    public function addAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request.");   
            }

            if($this->cartModel->addItem($id)){
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
            if(!$id = $this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request");
            }
            
            if($this->cartModel->removeItem($id,1)){
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
            if(!$id = $this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request");
            }
            
            $flag = $this->getRequest()->getRequest('flag');

            if(!$flag){
                $this->cartModel->removeItem($id);      
            }
            else{
                if($this->cartModel->addItem($id)){
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