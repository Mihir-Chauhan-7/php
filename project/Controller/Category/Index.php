<?php

namespace Controller\Category;

use Exception;

class Index extends \Controller\Base{
    
    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('\Model\Cart',true)->getCart($_SESSION['customerId']);
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
    }

    public function indexAction(){
        $this->getCustomer();

        $indexBlock = $this
                        ->getLayout()
                        ->createBlock('Block\Category\Index\Index');
        
        $this->_addContent($indexBlock,'index');

        $this
            ->getLayout()
            ->getChild('content')
            ->getChild('index')
            ->addChild('Block\Category\Index\Index\Category','category');

        $this
            ->getLayout()
            ->getChild('content')
            ->getChild('index')
            ->addChild('Block\Category\Index\Index\Product','product');      
        
        $this
            ->getLayout()
            ->getChild('content')
            ->getChild('index')
            ->addChild('Block\Category\Index\Index\Cart','cart');      
        
                
        $this->addElement('content',$indexBlock->toHtml());
        $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
        $this->addIdentifier('#categories','remove','active');
        $this->addIdentifier('#category_'.$this->getCurrentCategory(),'add','active');
        $this->sendResponse();
    }

    public function addAction(){
        try{
            if($this->getRequest()->isPOST()){
                $this
                    ->productModel
                    ->load($id = $this->getRequest()->getPOST('productId'));
                
                $this->cartItemModel->cartId = $this->cartModel->cartId;
                $this->cartItemModel->productId = $this->productModel->id;
                $this->cartItemModel->sku = $this->productModel->sku;
                
                if($this->cartItemModel->saveData()){
                    $this->cartModel->reCalculateTotal();
                    
                    $this->addElementBlock('cart','Block\Category\Index\Index\Cart');                
                    $this->addIdentifier('#product_'.$id,'add','btn btn-danger');
                    $this->addIdentifier('#product_'.$id,'html','Added');
                }
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        
        $this->sendResponse();
    }
    
    public function removeAction(){
        try{
            if(!$id = $this->getRequest()->getRequest('id')){
                throw new Exception("Invalid Request");
            }
            
            $this->cartItemModel->id = $id;
            $this->cartItemModel->deleteData();
            $this->cartModel->recalculateTotal();


            $this->addElementBlock('productList','Block\Category\Index\Index\Product');
            $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
    
    public function updateQuantityAction(){
        try{
            if(!$id = $this->getRequest()->getRequest('id')){
                throw new Exception("Invalid Request");
            }
            
            $flag = $this->getRequest()->getRequest('flag');
            
            $this->cartItemModel->load($id);
            $qty = $this->cartItemModel->quantity;
    
            if($flag){
                $qty++;
            }
            else{
                if($qty != 1){
                    $qty--;
                }
            }
        
            $this->cartItemModel->quantity = $qty;
            $this->cartItemModel->saveData();
            $this->cartModel->recalculateTotal();
    
            $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
            
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
    
    public function removeCartAction(){
        try{
            foreach($this->cartModel->getCartItems() as $item){
                $item->id = $item->itemId;
                $item->deleteData();
            }

            $this->cartModel->updateCart('total',0);
            $this->displayMessage("Cart Empty");
            
            $this->addElementBlock('cart','Block\Category\Index\Index\Cart');
            $this->addElementBlock('productList','Block\Category\Index\Index\Product');
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }
}

?>