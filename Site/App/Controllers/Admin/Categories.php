<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use Core\View;
use App\Config;

class Categories extends \Core\Controller {

public function index(){
    $categoryData = Category::join('LEFT',['cid','cname','url','image','status'
        ,'description','created_at'],['cname AS parent_name'],'categories'
        ,'parent_id','cid');
    View::renderTemplate('Admin\Manage_Category.html',[
        'categoryKey' => Category::getKeys(),
        'categoryList' => $categoryData
    ]);
}
public function add(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        Category::saveImage($_FILES) ? $_POST['image'] = $_FILES['image']['name'] : "";
        if(Category::insertData($_POST)){
            header('Location: /Cybercom/php/Site/public/admin/categories/index');                  
        }
        else{
            View::renderTemplate('Admin\AddCategory.html',[
                'title' => 'Add',
                'data' => $_POST
            ]);
            echo "Category Not Inserted";
        }  

    }
    else{
        $parentList=Category::getAll();
        View::renderTemplate('Admin\AddCategory.html',[
            'title' => 'Add',
            'parentList' => $parentList
        ]);
    }
        
}
public function edit(){
    $parentList=Category::getAll();
    if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
        $categoryData=Category::getData($_GET['id']);
            
        View::renderTemplate('Admin\AddCategory.html',[
            'title' => 'Update',
            'data' => $categoryData[0],
            'parentList' => $parentList
        ]);
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        Category::saveImage($_FILES) ? $_POST['image'] = $_FILES['image']['name'] : "";
        Category::updateData($_POST) 
        ?   header("Location: " . Config::HOME . "admin/categories/index")
        :   View::renderTemplate('Admin\AddCategory.html',[
                'title' => 'Update',
                'data' => $_POST,
                'parentList' => $parentList
            ]);
    }
} 
public function delete(){
    if(Category::deleteData($_GET['id'])){
        $_SESSION['message']=[ 'className' => 'alert alert-success' ,
            'message' => "Delete Successful"];
            header('Location: /Cybercom/php/Site/public/Admin/Categories/index');
        }   
    }
}

?>