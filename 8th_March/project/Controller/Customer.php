<?php

namespace Controller;

use Block\Customer\Add;
use Model\Customer\Customer as CustomerModel;

class Customer extends Base {

    protected $customers = NULL;
    protected $customerModel = NULL;
    protected $addressModel = NULL;
    protected $action;

    public function __construct()
    {
        $this->setRequest();
        $this->customerModel = new CustomerModel();
        $this->addressModel = new \Model\Customer\Address();
    }

    

    public function indexAction(){   
        $grid = new \Block\Customer\Grid();
        $grid->setTemplate('/customer/view.php');
        $grid->setCustomers($this->customerModel->fetchAll());
        $grid->setAddresses($this->addressModel->fetchAll());
        $grid->setController($this);
        echo $grid->toHTML();
    }

    public function addAction(){
        $add = new Add();
        $add->setCustomer($this->customerModel);
        $add->setAddress($this->addressModel);
        $add->setController($this);
        echo $add->toHTML();
    }
    
    public function editAction(){
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Invalid Operation");
            }
            if($this->customerModel->load($id) == NULL){
                throw new Exception("Customer Not Found");
            }

            $add = new Add();
            $add->setCustomer($this->customerModel->load($id));
            $add->setAddress($this->addressModel->getAddress($id));
            $add->setController($this);
            echo $add->toHTML();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }   
    }

    public function saveAction(){
        if(!$this->getRequest()->isPOST()){
            throw new Exception("Invalid Data");
        }
        if($id = (int)$this->getRequest()->getRequest('id')){
            $this->customerModel->load($id);
        }

        $this->customerModel->setData($this->getRequest()->getPOST()['customer']);
        $this->addressModel->setData($this->getRequest()->getPOST()['address']);

        $this->addressModel->id = $this->customerModel->id;
        $this->addressModel->setPrimaryKey('cid');
        if(!($this->customerModel->saveData())){
            throw new Exception("Error Operation Failed");
        }
        $this->addressModel->cid = $this->customerModel->id;
        if(!$this->addressModel->saveData()){
            throw new Exception("Error Operation Failed");
        }

        $this->redirect('customer','index');
    }

    public function deleteAction(){
        
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                if($id){
                    $this->customerModel->id = $id;
                    if($this->customerModel->deleteData()){
                        $this->redirect('customer','index');
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){

                if($idList){
                    foreach($idList as $id){
                        $this->customerModel->id = $id;
                        $this->customerModel->deleteData();
                    }
                    $this->redirect('customer','index');
                }
            }
            else{
                throw new Exception('Invalid Operation');
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>