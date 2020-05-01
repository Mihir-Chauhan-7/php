<?php

namespace Controller\Customer;

use Exception;

class Address extends \Controller\Base{

    protected $cid;

    public function __construct()
    {
        $this->customerModel = \Ccc::objectManager('\Model\Customer',true);
        $this->addressModel = \Ccc::objectManager('\Model\Customer\Address',true);
    }

    public function addAction(){
        $this->addressModel->customerId = $this->getRequest()->getRequest('customerId');
        $addData = $this->getLayout()->createBlock('\Block\Customer\Address\Add',true)->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function gridAction(){
        $this->customerModel
            ->load($this->getRequest()->getRequest('customerId'));

        $gridData = $this->getLayout()
            ->createBlock('\Block\Customer\Address\Grid',true)->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function editAction(){
        try{
            if(!$addressId = (int)$this->getRequest()->getRequest('addressId')){
                throw new Exception("Invalid Request");
            }

            $this->addressModel->load($addressId);
            $add = $this->getLayout()->createBlock('Block\Customer\Address\Add')->toHtml();
            $this->sendResponse('content',$add);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }

    public function saveAction(){
        try{
            if(!$customerId = (int)$this->getRequest()->getRequest('customerId')){
                throw new Exception("Customer Not Found");
            }
            
            if(!$this->getRequest()->getPOST()){
                throw new Exception('Invalid Data.');
            }

            if($addressId = (int)$this->getRequest()->getRequest('addressId')){
                $this->displayMessage('Updated Successfully..',1);
                if(!$this->addressModel->load($addressId)){
                    $this->displayMessage('Inserted Successfully..',1);
                }
            }


            $this->addressModel->setData($this->getRequest()->getPOST());
            $this->addressModel->customerId = $customerId;
        
            if(!$this->addressModel->saveData()){
                throw new Exception('Error Operation Failed.');
           
            }

            header('Location:'.$this->getUrl('grid',Null,['customerId' => $customerId]));
           
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
        }
    }

    public function deleteAction(){
        $customerId = $this->getRequest()->getRequest('customerId');
        try{
            if($addressId = (int)$this->getRequest()->getRequest('addressId')){
                $this->addressModel->id = $addressId;        
                $this->addressModel->deleteData();
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                $this->addressModel->deleteData($idList);
            }
            else{
                throw new Exception("Invalid Operation.");
            }
            $this->displayMessage('Deleted Successfully..',1);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        header('Location:'.$this->getUrl('grid',Null,['customerId' => $customerId]));
    }

    public function updateTypeAction(){
        try{
            if(!$customerId = (int)$this->getRequest()->getRequest('customerId')){
                throw new Exception("Invalid Request");                
            }
            $addressIds = $this->getRequest()->getRequest('address');
            $this->customerModel->load($customerId);
            
            if($addressIds['shipping'] == $addressIds['billing']){
                throw new Exception("Address Cannot Be Same");
            }
            $this->customerModel->updateAddressType($addressIds);
            $this->displayMessage("Address Type Updated.");
            $gridData = $this->getLayout()
                ->createBlock('\Block\Customer\Address\Grid',true)->toHtml();
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage());
            
        }
        $this->sendResponse('content',$gridData);
    }
}

?>