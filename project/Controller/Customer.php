<?php

namespace Controller;
class Customer extends Base {

    protected $customers = NULL;
    protected $customerModel = NULL;

    public function __construct()
    {
        $this->customerModel = \Ccc::objectManager('\Model\Customer\Customer',true);
    }

    public function addAction(){
        $addData = $this->getLayout()->createBlock('Block\Customer\Add')->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function gridAction(){   
        $gridData = $this->getLayout()->createBlock('Block\Customer\Grid')->toHtml();
        $this->sendResponse('content',$gridData); 
    }
    
    public function editAction(){
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Operation.");
            }
            if($this->customerModel->load($id) == NULL){
                throw new Exception("Customer Not Found.");
            }

            $this->customerModel->load($id);
            $addData = $this->getLayout()->createBlock('Block\Customer\Add')->toHtml();
            $this->sendResponse('content',$addData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }   
    }

    public function saveAction(){
        try{
            $this->displayMessage('Inserted Successfully..',1);
            if(!$this->getRequest()->isPOST()){
                throw new Exception("Invalid Request.");
            }

            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->displayMessage('Updated Successfully..',1);
                $this->customerModel->load($id);
            }

            $this->customerModel->setData($this->getRequest()->getPOST());
            if(!($this->customerModel->saveData())){
                throw new Exception("Error Operation Failed.");
            }
            $gridData = $this->getLayout()->createBlock('Block\Customer\Grid')->toHtml();
            $this->sendResponse('content',$gridData); 
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        
    }

    public function deleteAction(){
        
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                if($id){
                    $this->customerModel->id = $id;
                    if($this->customerModel->deleteData()){
                        $this->displayMessage('Deleted Successfully..',1);
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                
                if($idList){
                    $this->customerModel->deleteData($idList);
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new Exception('Invalid Operation.');
            }
            $gridData = $this->getLayout()->createBlock('Block\Customer\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
            $gridData = $this->getLayout()->createBlock('Block\Customer\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
    }
}

?>