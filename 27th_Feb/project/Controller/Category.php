<?php 

namespace Controller;

use Exception;
use Model\Category as CategoryModel;

class Category extends Base{

    protected $categoryModel = NULL;

    public function __construct()
    {
        $this->setRequest();
        $this->categoryModel =new CategoryModel();
    }

    public function setCategory($singleCategory){
        $this->categoryModel = $singleCategory;
        return $this;
    }

    public function getCategory(){
        return $this->categoryModel;
    }

    public function indexAction(){
        require_once 'Views/category/view.php';
    }

    public function addAction(){
        $this->action = 'Add';
        $this->setCategory($this->categoryModel);
        require_once 'Views/category/form.php';
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

            $this->setCategory($this->categoryModel->load($id));
            $this->action = 'Update';
            require_once 'Views/category/form.php';
        
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    public function deleteAction(){
        if($id = (int)$this->getRequest()->getRequest('id')){
            $this->categoryModel->id = ($id);
            if($this->categoryModel->deleteData()){
                $this->redirect('category','index');
            }
        }
        
        if($idList = $this->getRequest()->getRequest('check')){
            foreach($idList as $id){
                $this->categoryModel->id = ($id);
                $this->categoryModel->deleteData();
            }
            $this->redirect('category','index');
        }
    }

    public function saveAction(){
        
        if(!$this->getRequest()->getPOST()){
            throw new Exception('Invalid Data');
        }

        if($id = (int)$this->getRequest()->getRequest('id')){
            $this->categoryModel->load($id);
        }
        
        $this->categoryModel->setData($this->request->getPOST());
        
        if(!$this->categoryModel->saveData()){
            throw new Exception('Error Operation Failed');
        }
        
        $this->redirect('category','index');
    
    }


}

?>