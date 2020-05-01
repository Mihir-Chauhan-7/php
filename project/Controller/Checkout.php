<?php

namespace Controller;

class Checkout extends Base{
    
    public function __construct()
    {
        $this->cartModel = $this->getCustomer()->getCart();
        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
        $this->cartAddress = \Ccc::objectManager('\Model\Cart\Address',true);
    }

    public function indexAction(){
        if($this->cartModel->cartId == NULL){
            throw new Exception("Invalid Request");
        }

        $indexBlock = $this->getLayout()->createBlock('Block\Checkout\Index');
         
        $indexBlock->addChild('Block\Checkout\Index\Customer','customer');
        $indexBlock->addChild('Block\Checkout\Index\Address','address');
        $indexBlock->addChild('Block\Checkout\Index\PaymentMethod','paymentMethod');
        $indexBlock->addChild('Block\Checkout\Index\ShipmentMethod','shipmentMethod');
        $indexBlock->addChild('Block\Checkout\Index\Cart\Summary','productCart');
        $indexBlock->addChild('Block\Checkout\Index\Details','details');
        
        //$this->_addContent($indexBlock,'index');

        $this->addElement('content',$indexBlock->toHtml());
        $this->sendResponse();
    } 
    
    public function addAction(){
        try{
            if(!$productId = (int)$this->getRequest()->getRequest('productId')){
                throw new Exception("Invalid Request.");
            }

            if($this->cartModel->addItem($productId)){
                $this->addElementBlock('productCart','Block\Checkout\Index\Cart\Summary');                
                $this->addElementBlock('details','Block\Checkout\Index\Details');
            }     
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
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
                $this->addElementBlock('productCart','Block\Checkout\Index\Cart\Summary');
                $this->addElementBlock('details','Block\Checkout\Index\Details');
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
            $this->addElementBlock('productCart','Block\Checkout\Index\Cart\Summary');
            $this->addElementBlock('details','Block\Checkout\Index\Details');
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $this->sendResponse();
    }    

    public function updateAddressAction(){
        try{
            if(!$this->getRequest()->isPOST()){
                throw new Exception("Invalid Request");
            }

            $type = $this->getRequest()->getRequest('type');
            
            $name = $type == 1 ? 'shipping' : 'billing';
            $data = $this->getRequest()->getPOST()[$name];
            
            if($this->cartModel->saveCartAddress($data,$type)){
                $this->displayMessage("Address Saved.");
                $this->addElementBlock($name.'Address','Block\Checkout\Index\Address\\'.$name);                                
            
            }

        }catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse();
    }

    public function updateMethodAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest('id')){
                throw new Exception("Invalid Request.");
            }

            if($this->getRequest()->getRequest('flag')){
                $this->cartModel->updatePaymentMethod($id);
                $this->displayMessage("Payment Method Changed.");
            }
            else{
                $this->cartModel->updateShippingMethod($id);
                $this->displayMessage("Shipping Method Changed.");
            }
            
            $this->addElementBlock('paymentMethod','Block\Checkout\Index\paymentMethod');                
            $this->addElementBlock('shipmentMethod','Block\Checkout\Index\shipmentMethod');                        
            $this->addElementBlock('details','Block\Checkout\Index\Details');
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse();
    }

    public function showAction(){
        $block = $this->getRequest()->getRequest('flag') 
            ? 'Summary' 
            : 'Products';
        
            $this->addElementBlock('productCart','Block\Checkout\Index\Cart\\'.$block);
        
        $this->sendResponse();
    }

    public function applyDiscountAction(){
        $amount = $this->getRequest()->getRequest('amount');
    
        if($amount >= $this->cartModel->total || $amount == 0){
            $this->displayMessage("Discount Not Applied.");
        }
        else{
            $this->cartModel->updateCart('discount',$amount);
            $this->displayMessage("Discount Applied.");
            $this->addElementBlock('details','Block\Checkout\Index\Details');
        }
        
        $this->sendResponse();
    }
}

?>