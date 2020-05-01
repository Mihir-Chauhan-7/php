<?php

namespace Controller\Payment;

class Method extends \Controller\Base{

    public function __construct()
    {
        $this->paymentMethodModel = \Ccc::
            objectManager('\Model\Payment\Method',true);
    }

    public function addAction(){
        $addData = $this->getLayout()
            ->createBlock('Block\Payment\Add');
        $this->sendResponse('content',$addData->toHtml());
    }

    public function gridAction(){        
        
        $gridData = $this->getLayout()->createBlock('Block\Payment\Grid');
        $this->sendResponse('content',$gridData->toHtml());
    }

    public function editAction(){   
        try{
            if(!$id = (int)$this->getRequest()->getRequest($this
                ->paymentMethodModel->getPrimaryKey())){

                throw new \Exception("Invalid Request.");
            }

            if($this->paymentMethodModel->load($id) == NULL){
                throw new \Exception("Payment Method Not Found.");
            }
            
            $editData = $this->getLayout()->createBlock('Block\Payment\Add');
        } 
        catch(\Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse('content',$editData->toHtml());
    }

    public function saveAction(){
        $this->displayMessage('Inserted Successfully..',1);
        try{
            if(!$this->getRequest()->getPOST()){
                throw new \Exception('Invalid Data.');
            }
        
            if($id = (int)$this->getRequest()->getRequest($this
                ->paymentMethodModel->getPrimaryKey())){

                $this->displayMessage('Updated Successfully..',1);
                $this->paymentMethodModel->load($id);
            }

            $this->paymentMethodModel->setData($this->getRequest()
                ->getPOST());
            if(!$this->paymentMethodModel->saveData()){
                throw new \Exception('Error Operation Failed.');
            }
            $gridData = $this->getLayout()->createBlock('Block\Payment\Grid');
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse('content',$gridData->toHtml());
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest($this
            ->paymentMethodModel->getPrimaryKey())){
                $this->paymentMethodModel->id = ($id);
                if($this->paymentMethodModel->deleteData()){
                    $this->displayMessage('Deleted Successfully..',1);
                }    
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                if($idList){
                    $this->paymentMethodModel->deleteData($idList);
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new \Exception('Invalid Operation.');
            }
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $gridData = $this->getLayout()->createBlock('Block\Payment\Grid');   
        $this->sendResponse('content',$gridData->toHtml());
    }
}

?>