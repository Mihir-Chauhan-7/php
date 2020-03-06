<?php 

namespace Controller;

use Exception;
use Model\Core\Request;
use Model\Category as CategoryModel;

class Category extends Base{

    protected $categoryModel = NULL;

    public function __construct()
    {
        $this->request = new Request();
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
        $id = (Int)$this->request->getRequest('id');
        
        if(!$id){
            throw new Exception('Invalid Operation');
        }

        $this->setCategory($this->categoryModel->load($id));
        $this->action = 'Update';
        require_once 'Views/category/form.php';
    }

    public function deleteAction(){
        if($id = (int)$this->request->getRequest('id')){
            $this->categoryModel->id = ($id);
            if($this->categoryModel->deleteData()){
                $this->redirect('category','index');
            }
        }
        
        if($idList = $this->request->getRequest('check')){
            foreach($idList as $id){
                $this->categoryModel->id = ($id);
                $this->categoryModel->deleteData();
            }
            $this->redirect('category','index');
        }
    }

    public function saveAction(){
        
        if(!$this->request->getPOST()){
            throw new Exception('Invalid Data');
        }

        if($id = (int)$this->request->getRequest('id')){
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