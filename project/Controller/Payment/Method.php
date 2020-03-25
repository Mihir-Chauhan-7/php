<?php

namespace Controller\Payment;

use Exception;

class Method extends \Controller\Base{

    public function __construct()
    {
        $this->paymentMethodModel = \Ccc::objectManager('\Model\Payment\Method',true);
    }

    public function addAction(){
        $addData = $this->getLayout()->createBlock('Block\Payment\Add')->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function gridAction(){
        $gridData = $this->getLayout()->createBlock('Block\Payment\Grid')->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function editAction(){   
        try{
            if(!$id = (int)$this->getRequest()->getRequest('id')){
                throw new \Exception("Invalid Request.");
            }

            if($this->paymentMethodModel->load($id) == NULL){
                throw new \Exception("Payment Method Not Found.");
            }

            $this->paymentMethodModel->load($id);
            $addData = $this->getLayout()->createBlock('Block\Payment\Add')->toHtml();
            $this->sendResponse('content',$addData);
        } 
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction(){
        $this->displayMessage('Inserted Successfully..',1);
        try{
            if(!$this->getRequest()->getPOST()){
                throw new Exception('Invalid Data.');
            }
        
            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->displayMessage('Updated Successfully..',1);
                $this->paymentMethodModel->load($id);
            }

            $this->paymentMethodModel->setData($this->getRequest()->getPOST());
            if(!$this->paymentMethodModel->saveData()){
                throw new Exception('Error Operation Failed.');
            }
            $gridData = $this->getLayout()->createBlock('Block\Payment\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                $this->paymentMethodModel->id = $id; 
                if($this->paymentMethodModel->deleteData()){
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){

                if($this->paymentMethodModel->deleteData($idList)){
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new \Exception("Invalid Request.");
            }
            $gridData = $this->getLayout()->createBlock('Block\Payment\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>