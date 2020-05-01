<?php

namespace Controller\Customer;

use Exception;

class Group extends \Controller\Base{

    public function __construct()
    {
        $this->groupModel = \Ccc::objectManager('\Model\Customer\Group',true);
    }

    public function addAction(){
        $addData = $this->getLayout()
            ->createBlock('Block\Customer\Group\Add');
        $this->sendResponse('content',$addData->toHtml());
    }

    public function gridAction(){
        $gridData = $this->getLayout()->createBlock('Block\Customer\Group\Grid')
            ->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function editAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest($this
                ->groupModel->getPrimaryKey())){

                throw new \Exception("Invalid Request.");
            }

            if($this->groupModel->load($id) == NULL){
                throw new \Exception("Payment Method Not Found.");
            }
            
            $editData = $this->getLayout()
                ->createBlock('Block\Customer\Group\Add');
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
                ->groupModel->getPrimaryKey())){

                $this->displayMessage('Updated Successfully..',1);
                $this->groupModel->load($id);
            }

            $this->groupModel->setData($this->getRequest()
                ->getPOST());
            if(!$this->groupModel->saveData()){
                throw new \Exception('Error Operation Failed.');
            }
            $gridData = $this->getLayout()
                ->createBlock('Block\Customer\Group\Grid');
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage());
        }
        $this->sendResponse('content',$gridData->toHtml());
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest($this->groupModel
                ->getPrimaryKey())){    
                if($id){
                    $this->groupModel->id = ($id);
                    if($this->groupModel->deleteData()){
                        $this->displayMessage('Deleted Successfully..',1);
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                if($idList){
                    $this->groupModel->deleteData($idList);
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new Exception('Invalid Operation.');
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }   

        $gridData = $this->getLayout()->createBlock('Block\Customer\Group\Grid')
            ->toHtml();
        $this->sendResponse('content',$gridData);
    }
}

?>