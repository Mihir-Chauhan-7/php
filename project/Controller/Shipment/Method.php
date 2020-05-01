<?php

namespace Controller\Shipment;

class Method extends \Controller\Base{

    public function __construct()
    {
        $this->shipmentModel = \Ccc::
            objectManager('\Model\Shipment\Method',true);
        $this->add = \Ccc::objectManager('\Block\Shipment\Add',true);
    }

    public function gridAction(){
        $gridData = $this->getLayout()->createBlock('Block\Shipment\Grid')
            ->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function addAction(){
        $addData = $this->getLayout()->createBlock('Block\Shipment\Add')
            ->toHtml();
        $this->sendResponse('content',$addData);
    }

    public function editAction(){
        try{
            if(!$id = (int)$this->getRequest()->getRequest($this
                ->shipmentModel->getPrimaryKey())){
                throw new \Exception("Invalid Request");
            }

            $this->shipmentModel->load($id);
            $addData = $this->getLayout()->createBlock('Block\Shipment\Add')->toHtml();
            $this->sendResponse('content',$addData);
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        
    }

    public function saveAction(){
        try{
            $this->displayMessage('Inserted Successfully..');
            if(!$this->getRequest()->isPOST()){
                throw new \Exception("Invalid Request");
            }

            if($id = (int)$this->getRequest()->getRequest($this
                ->shipmentModel->getPrimaryKey())){

                $this->shipmentModel->load($id);
                $this->displayMessage('Updated Successfully..');
            }

            $this->shipmentModel->setData($this->getRequest()->getPOST());
            $this->shipmentModel->saveData();

        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $gridData = $this->getLayout()->createBlock('Block\Shipment\Grid')->toHtml();
        $this->sendResponse('content',$gridData);
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest($this
                ->shipmentModel->getPrimaryKey())){
                
                $this->shipmentModel->id = $id; 
                if($this->shipmentModel->deleteData()){
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){

                if($this->shipmentModel->deleteData($idList)){
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new \Exception("Invalid Request.");
            }
        }
        catch(\Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
        $gridData = $this->getLayout()->createBlock('Block\Shipment\Grid')
            ->toHtml();
        $this->sendResponse('content',$gridData);
    }
}
?>