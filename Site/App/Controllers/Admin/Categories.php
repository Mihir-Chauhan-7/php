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
            View::showMessage('Category Inserted..',1);                  
        }
        else{
            View::renderTemplate('Admin\AddCategory.html',[
                'title' => 'Add',
                'data' => $_POST
            ]);
            View::showMessage('Category Not Inserted...',0);
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
        if(Category::updateData($_POST) ){
            header("Location: " . Config::HOME . "admin/categories/index");
            View::showMessage('Category Updated...',1);
        }
        else{
            View::renderTemplate('Admin\AddCategory.html',[
                'title' => 'Update',
                'data' => $_POST,
                'parentList' => $parentList
            ]);
            View::showMessage('Category Not Updated...',0);
        }    
    }
} 
public function delete(){
        if(Category::deleteData($_GET['id'])){
            View::showMessage('Category Deleted...',1);
            header('Location: /Cybercom/php/Site/public/Admin/Categories/index');
                                  
        }   
    }
}

?>