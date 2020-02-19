<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use Core\View;
use App\Config;
use Core\Model;

class Categories extends \Core\Controller {

public function index(){
    View::renderTemplate('Admin\Manage_Category.html',[
        'categoryKey' => Category::getKeys(),
        'categoryList' => Category::displayCategories()
    ]);
}
public function add(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(Category::insertCategory($_POST,$_FILES)){
            Category::redirect("index");
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
        View::renderTemplate('Admin\AddCategory.html',[
            'title' => 'Add',
            'parentList' => Category::getParents()
        ]);
    }
}
public function edit(){
    if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){            
        View::renderTemplate('Admin\AddCategory.html',[
            'title' => 'Update',
            'data' => Category::getData($_GET['id'])[0],
            'parentList' => Category::getParents()
        ]);
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(Category::updateCategory($_POST,$_FILES) ){
            Category::redirect("index");
            View::showMessage('Category Updated...',1);
        }
        else{
            View::renderTemplate('Admin\AddCategory.html',[
                'title' => 'Update',
                'data' => $_POST,
                'parentList' => Category::getParents()
            ]);
            View::showMessage('Category Not Updated...',0);
        }    
    }
} 
public function delete(){
        if(Category::deleteData($_GET['id'])){
            View::showMessage('Category Deleted...',1);
            Category::redirect("index");
        }   
    }
}

?>