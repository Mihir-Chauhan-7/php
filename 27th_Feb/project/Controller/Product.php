<?php

require_once 'Model/ProductModel.php';
class Product{
    public function __construct()
    {
        $this->request = new Request();
        $this->productModel =new ProductModel();
    }
    public function indexAction(){
        require_once 'Views/product/view.php';
    }

    public function addAction(){
        require_once 'Views/product/add.php';
    }

    public function saveAction(){
        $this->productModel->setData($this->request->getPOST());
        if($this->productModel->insertData()){
            $this->indexAction();
        }
    }

    public function editAction(){
        require_once 'Views/product/edit.php';
    }

    public function updateAction(){
        $this->productModel->setData($this->request->getPOST());
        $this->productModel->setData($this->productModel->getData());
        if($this->productModel->updateData()){
           $this->indexAction();
        }
    }

    public function deleteAction(){
        $this->productModel->id = ($this->request->getRequest('id'));
        if($this->productModel->deleteData()){
            $this->indexAction();
        }
    }


}