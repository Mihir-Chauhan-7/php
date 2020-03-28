<?php

namespace Controller;

class Checkout extends Base{
    
    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('\Model\Cart',true)
            ->load($this->getCustomer(),'customerId');

        $this->cartItemModel = \Ccc::objectManager('\Model\Item',true);
        $this->productModel = \Ccc::objectManager('\Model\Product',true);
        $this->cartAddress = \Ccc::objectManager('Model\Cart\Address',true);
    }

    public function indexAction(){
        if($this->cartModel->cartId == NULL){
            throw new Exception("Invalid Request");
        }

        $indexBlock = $this->getLayout()
                        ->createBlock('Block\Checkout\Index');
         
        $indexBlock->addChild('Block\Checkout\Index\Customer','customer');
        $indexBlock->addChild('Block\Checkout\Index\Address','address');
        $indexBlock->addChild('Block\Checkout\Index\PaymentMethod','paymentMethod');
        $indexBlock->addChild('Block\Checkout\Index\ShipmentMethod','shipmentMethod');
        $indexBlock->addChild('Block\Checkout\Index\Cart\Summary','productCart');
        $indexBlock->addChild('Block\Checkout\Index\Details','details');
        
        $this->getLayout()->createBlock('Block\Checkout\Index\Address');
        $this->_addContent($indexBlock,'index');

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
            }     
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        $this->sendResponse();
    }

    public function removeAction(){
        try{
            if(!$itemId = (int)$this->getRequest()->getRequest('itemId')){
                throw new Exception("Invalid Request.");
            }

            $this->cartItemModel->id = $itemId;
            
            if($this->cartItemModel->deleteData()){
                $this->cartModel->recalculateTotal();
                $this->addElementBlock('productCart','Block\Checkout\Index\Cart\Summary');                
            }

        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        $this->sendResponse();
    }

    public function updateAddressAction(){
        try{
            
            if(!$this->getRequest()->isPOST()){
                throw new Exception("Invalid Request");
            }

            $type = $this->getRequest()->getRequest('type');
            $address = $this->cartModel->getAddress($type);
            $name = $type == 1 
                ? 'shipping' 
                : 'billing';

            $address->setData($this->getRequest()->getPOST()[$name]);
            $address->cartId = $this->cartModel->cartId;
            $address->customerId = $this->cartModel->customerId;
            $address->type = $this->getRequest()->getRequest('type');

            if($address->saveData()){
                $this->addElementBlock('address','Block\Checkout\Index\Address');                                
            }

        }catch(Exception $e){
            echo $e->getMessage();
        }
        $this->sendResponse();
    }

    public function updateMethodAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest('id')){
                throw new Exception("Invalid Request.");
            
            }

            $fieldname = $this->getRequest()->getRequest('flag') == 1 
                ? 'paymentId' 
                : 'shippingId';
    
            $this->cartModel->updateCart($fieldname,$id);
            $this->addElementBlock('paymentMethod','Block\Checkout\Index\paymentMethod');                
            $this->addElementBlock('shipmentMethod','Block\Checkout\Index\shipmentMethod');                        
            $this->addElementBlock('details','Block\Checkout\Index\Details');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        $this->sendResponse();
    }

    public function showAction(){
        $block = $this->getRequest()->getRequest('flag') ? 'Summary' : 'Products';
        $this->addElementBlock('productCart','Block\Checkout\Index\Cart\\'.$block);
        $this->sendResponse();
    }

    public function applyDiscountAction(){
        $amount = $this->getRequest()->getRequest('amount');
        $this->cartModel->discount = $amount;
        $this->cartModel->saveData();
    }
}

?>