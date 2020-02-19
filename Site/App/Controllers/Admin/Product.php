<?php

namespace App\Controllers\Admin;

use App\Models\Product as ProductModel;
use App\Models\ProductCategory;
use Core\View;
use App\Config;

class Product extends \Core\Controller {

    public function index(){
        View::renderTemplate('Admin\Manage_Product.html',[
            'productKey' => ProductModel::getKeys(),
            'productList' => ProductModel::getAll()
        ]);
    }
    public function add(){
        $categoryList=ProductModel::getCategoryList();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(ProductModel::insertProduct($_POST,$_FILES)){
                ProductModel::redirect('index');
                View::showMessage('Product Inserted...',1);                                    
            }
            else{
                View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Add',
                    'data' => $_POST,
                    'categoryList' => $categoryList
                ]);
                View::showMessage('Product Not Inserted..',0);                  
            }  
        }
        else{
            View::renderTemplate('Admin/AddProduct.html',[
                'title' => 'Add',
                'categoryList' => $categoryList
            ]);
        }  
    }
    public function edit(){
        $categoryList=ProductModel::getCategoryList();
        
        if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
            View::renderTemplate('Admin\AddProduct.html',[
                'title' => 'Update',
                'categoryList' => $categoryList,
                'data' =>  ProductModel::getProductData($_GET['id'])
                
           ]);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(ProductModel::updateProduct($_POST,$_FILES)){
                ProductModel::redirect('index');
                View::showMessage('Product Updated..',1);                  
            }
            else{
                View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Update',
                    'categoryList' => $categoryList,
                    'data' => $_POST
                ]);
                View::showMessage('Product Not Updated..',0);                  
            }   
        }
    }
    public function delete(){
        if(ProductModel::deleteData($_GET['id'])){
            ProductModel::redirect('index');
            View::showMessage('Product Deleted...',0);                  
        }   
    }
}

?>