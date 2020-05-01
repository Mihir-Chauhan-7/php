<?php

namespace Controller;

class Order extends Base{
    public function __construct()
    {
        $this->cartModel = $this->getCustomer()->getCart();
        $this->orderModel = \Ccc::objectManager('\Model\Order',true);
    }

    public function addAction(){
        try{
            if($this->cartModel->createOrder()){
                $orderDetails = $this->getLayout()
                    ->createBlock('\Block\Order\Details');
                $this->addElement('content',$orderDetails->toHtml());
                $this->displayMessage("Order Placed.",1);
            }

        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse();
    }

    public function displayAction(){
        if(!$customerId = (int)$this->getRequest()->getRequest('customerId')){
            throw new Exception("Customer Not Found");
        }

        $customer = \Ccc::objectManager('\Model\Customer',true)
            ->load($customerId);

        $orderDetails = $this->getLayout()
            ->createBlock('\Block\Order\Details')->toHtml();
        $this->sendResponse('content',$orderDetails);
    }

    public function gridAction(){
        $gridData = $this->getLayout()
            ->createBlock('Block\Order\Grid','orderGrid');
        $this->sendResponse('content',$gridData->toHtml());        
    }

    public function editAction(){
        try{
            if(!$orderId = (int)$this->getRequest()->getRequest()){
                throw new Exception("Invalid Request.");
            }

            if($this->orderModel->load($orderId)){
                $this->displayMessage("Delete Successful.");
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            if(!$orderId = (int)$this->getRequest()->getRequest($this
                ->orderModel->getPrimaryKey())){
                throw new Exception("Invalid Request.");
            }
    
            $this->orderModel->id = $orderId;
            if($this->orderModel->deleteData()){
                $this->addElementBlock('content','Block\Order\Grid');
                $this->displayMessage("Delete Successful.");
            }
        }catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse();
    }
}

?>