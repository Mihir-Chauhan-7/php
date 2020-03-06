<?php

namespace Controller;

use Model\Core\Request;
use Model\Customer\Customer as CustomerModel;

class Customer extends Base{

    protected $customerModel = NULL;
    protected $action;

    public function __construct()
    {
        $this->request = new Request();
        $this->customerModel = new CustomerModel();
    }

    public function setCustomer($singleCustomer){
        $this->customerModel = $singleCustomer;
        return $this;
    }

    public function getCustomer(){
        return $this->customerModel;
    }

    public function indexAction(){
        require_once 'Views/customer/view.php';
    }

    public function addAction(){
        $this->action = 'Add';
        $this->setCustomer($this->customerModel);
        require_once 'Views/customer/form.php';
    }
    
    public function editAction(){
        $this->action = 'Update';
        $id = (int)$this->request->getRequest('id');

        if(!$id){
            throw new Exception("Invalid Operation");
        }

        $this->setCustomer($this->customerModel->load($id));
        require_once 'Views/customer/form.php';
    }

    public function saveAction(){
        if(!$this->request->isPOST()){
            throw new Exception("Invalid Data");
        }

        if($id = (int)$this->request->getRequest('id')){
            $this->customerModel->load($id);
        }

        $this->customerModel->setData($this->request->getPOST()['customer']);
        
        if(!$this->customerModel->saveData()){
            throw new Exception("Error Operation Failed");
        }

        $this->redirect('customer','index');
    }

    public function deleteAction(){
        
        if($id = (int)$this->request->getRequest('id')){
            $this->customerModel->id = $id;
            if($this->customerModel->deleteData()){
                $this->redirect('customer','index');
            }
        }

        if($idList = $this->request->getRequest('check')){
            foreach($idList as $id){
                $this->customerModel->id = $id;
                $this->customerModel->deleteData();
            }
            $this->redirect('customer','index');
        }
    }
}

?>