<?php

namespace Controller;

class Checkout extends Base{
    
    public function __construct()
    {
        $this->cartModel = \Ccc::objectManager('Model\Cart',true)
            ->load($this->getCustomer(),'customerId');
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

        $this->getLayout()->createBlock('Block\Checkout\Index\Address');
        $this->_addContent($indexBlock,'index');

        $this->addElement('content',$indexBlock->toHtml());
        $this->sendResponse();
    }  
}

?>