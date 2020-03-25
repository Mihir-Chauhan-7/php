<?php

namespace Controller\Customer;

use Exception;

class Address extends \Controller\Base{

    protected $cid;

    public function __construct()
    {
        $this->addressModel = \Ccc::objectManager('\Model\Customer\Address',true);
        $this->customerModel = \Ccc::objectManager('\Model\Customer\Customer',true);
    }

    public function addAction(){
        $this->addressModel->cid = $this->getRequest()->getRequest('cid');
        $addData = $this->getLayout()->createBlock('\Block\Customer\Address\Add',true)->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function gridAction(){
        $this->customerModel->load($this->getRequest()->getRequest('cid'));
        $gridData = $this->getLayout()->createBlock('\Block\Customer\Address\Grid',true)->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function editAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest('id')){
                throw new Exception("Invalid Request");
            }
            $this->addressModel->load($id);
            $add = $this->getLayout()->createBlock('Block\Customer\Address\Add');
            $this->sendResponse('content',$add);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }

    public function saveAction(){
        $this->displayMessage('Inserted Successfully..',1);
        try{
            if(!$cid = (int)$this->getRequest()->getRequest('cid')){
                throw new Exception("Customer Not Found");
            }
            
            if(!$this->getRequest()->getPOST()){
                throw new Exception('Invalid Data.');
            }
            

            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->displayMessage('Updated Successfully..',1);
                $this->addressModel->load($id);
            }

            $this->addressModel->setData($this->getRequest()->getPOST());
            $this->addressModel->cid = $cid;
            if(!$this->addressModel->saveData()){
                throw new Exception('Error Operation Failed.');
            }
            header('Location:'.$this->getUrl('grid',Null,['cid' => $cid]));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function deleteAction(){
        $cid = $this->getRequest()->getRequest('cid');
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->addressModel->id = $id;        
                if($this->addressModel->deleteData()){
                    $this->displayMessage('Deleted Successfully..',1); 
                    header('Location:'.$this->getUrl('grid',Null,['cid' => $cid]));
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                if($this->addressModel->deleteData($idList)){
                    $this->displayMessage('Deleted Successfully..',1);
                    header('Location:'.$this->getUrl('grid',Null,['cid' => $cid]));
                }
            }
            else{
                throw new Exception("Invalid Operation.");
            }
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
            header('Location:'.$this->getUrl('grid',Null,['cid' => $cid]));
        }
    }

}

?>