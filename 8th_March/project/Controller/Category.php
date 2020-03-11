<?php 

namespace Controller;

use Block\Category\Add;
use Exception;
use Model\Category as CategoryModel;
use Model\Core\Message;
use Model\Core\Session;

class Category extends Base{

    protected $categoryModel = NULL;

    public function __construct()
    {
        $this->setRequest();
        $this->categoryModel =new CategoryModel();
    }

    public function indexAction(){    
        $grid = new \Block\Category\Grid();
        echo $grid->toHTML();
    }

    public function addAction(){
        $this->action = 'Add';
        $add = new Add();
        $add->setCategory($this->categoryModel);
        echo $add->toHTML();
    }
    
    public function editAction(){
        try{

            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception('Invalid Operation');
            }

            if($this->categoryModel->load($id) == NULL){
                throw new Exception('Category Not Found');
            }

            $add = new Add();
            $add->setCategory($this->categoryModel->load($id));
            echo $add->toHTML();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){
                
                if($id){
                    $this->categoryModel->id = ($id);
                    if($this->categoryModel->deleteData()){
                        $this->redirect('index');
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){

                if($idList){
                    foreach($idList as $id){
                        $this->categoryModel->id = ($id);
                        $this->categoryModel->deleteData();
                        $this->redirect('index');
                    }
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

    public function saveAction(){
        
        $message = new Message();
        $message->getSession()->setNameSpace('admin');
        $message->setMessage('Inserted',1);
        if(!$this->getRequest()->getPOST()){
            throw new Exception('Invalid Data');
        }

        if($id = (int)$this->getRequest()->getRequest('id')){
            $message->setMessage('Updated',1);
            $this->categoryModel->load($id);
        }
        
        $this->categoryModel->setData($this->request->getPOST());
        
        if(!$this->categoryModel->saveData()){
            throw new Exception('Error Operation Failed');
        }

        $this->redirect('index');
    }
}

?>