<?php namespace Controller;

class Category extends Base{

    protected $categoryModel = NULL;

    public function __construct()
    {
        $this->categoryModel = \Ccc::objectManager('\Model\Category',true);
    }

    public function gridAction(){
        $gridData = $this->getLayout()->createBlock('Block\Category\Grid')->toHtml();
        $this->sendResponse('content',$gridData);   
    }

    public function addAction(){
        $addData = $this->getLayout()->createBlock('Block\Category\Add')->toHtml();
        $this->sendResponse('content',$addData);
    }
    
    public function editAction(){
        try{

            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception('Invalid Request.');
            }

            if($this->categoryModel->load($id) == NULL){
                throw new Exception('Category Not Found.');
            }
            
            $this->categoryModel->load($id);
            $addData = $this->getLayout()->createBlock('Block\Category\Add')->toHtml();
            $this->sendResponse('content',$addData);
            
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }
    }

    public function deleteAction(){
        try{
            if($id = (int)$this->getRequest()->getRequest('id')){    
                if($id){
                    $this->categoryModel->id = ($id);
                    if($this->categoryModel->deleteData()){
                        $this->displayMessage('Deleted Successfully..',1);
                    } 
                }
            }
            else if($idList = $this->getRequest()->getRequest('check')){
                if($idList){
                    $this->categoryModel->deleteData($idList);
                    $this->displayMessage('Deleted Successfully..',1);
                }
            }
            else{
                throw new Exception('Invalid Operation.');
            }
            $gridData = $this->getLayout()->createBlock('Block\Category\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
        }   
    }

    public function saveAction(){
        try{
            $this->displayMessage('Inserted Successfully..',1);
            if(!$this->getRequest()->isPOST()){
                throw new Exception('Invalid Request.');
            }

            if($id = (int)$this->getRequest()->getRequest('id')){
                $this->displayMessage('Updated Successfully..',1);
                $this->categoryModel->load($id);
            }

            $this->categoryModel->setData($this->request->getPOST());
            
            if(!$this->categoryModel->saveData()){
                throw new Exception('Error Operation Failed.');
            }

            if(!$this->categoryModel->parent_id){
                $this->categoryModel->path = $this->categoryModel->id;
            }
            else{
                $this->categoryModel->path = $this->categoryModel->getParentPath();
            }

            $this->categoryModel->level = count(explode('_',$this->categoryModel->path));
            $this->categoryModel->saveData();
            $this->categoryModel->updateChilds();
            $gridData = $this->getLayout()->createBlock('Block\Category\Grid')->toHtml();
            $this->sendResponse('content',$gridData);
        }
        catch(Exception $e){
            $this->displayMessage($e->getMessage(),0);
            $this->sendResponse();
        }    
    }

    public function viewAction(){
        if(!$id = (int)$this->getRequest()->getRequest('id')){
            if(!key_exists('currentCategory',$_SESSION)){
                $id = 1;
            }
            else{
                $id = $_SESSION['currentCategory'];
            }
        }

        \Ccc::objectManager('\Model\Category',true)->load($id);
        $_SESSION['currentCategory'] = $id;
        
        $this->addElementBlock('productList','Block\Category\Index\Index\Product');
        $this->addIdentifier('#categories','remove','active');
        $this->addIdentifier('#category_'.$id,'add','active');
        $this->sendResponse();

    }
}

?>