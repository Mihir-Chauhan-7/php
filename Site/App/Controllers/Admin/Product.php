<?php

namespace App\Controllers\Admin;

use App\Models\Product as ProductModel;
use App\Models\ProductCategory;
use Core\View;
use App\Config;

class Product extends \Core\Controller {

    public function index(){
        //echo "<pre>";
        //print_r(ProductModel::getAll());
        //print_r(ProductModel::getKeys());
        View::renderTemplate('Admin\Manage_Product.html',[
            'name' => 'Mihir',
            'productKey' => ProductModel::getKeys(),
            'productList' => ProductModel::getAll()
        ]);
    }
    public function add(){
        $categoryList=ProductModel::getCategoryList();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(ProductModel::insertProduct($_POST,$_FILES)){
                header('Location: /Cybercom/php/Site/public/admin/product/index');                  
            }
            else{
                View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Add',
                    'data' => $_POST,
                    'categoryList' => $categoryList
                ]);
                echo "Product Not Inserted";
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
            $productData=ProductModel::joinThree('LEFT',['*'],[],['cid','cname']
            ,'products_categories','categories',['pid','pid'],['cid','cid']
            ,"A.pid=".$_GET['id']);
            View::renderTemplate('Admin\AddProduct.html',[
                'title' => 'Update',
                'categoryList' => $categoryList,
                'data' => $productData[0]
                
           ]);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            ProductModel::saveImage($_FILES) ? $_POST['image'] = $_FILES['image']['name'] : "";
            ProductModel::updateProduct($_POST,$_FILES) 
            ?   header("Location: " . Config::HOME . "admin/product/index")
            :   View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Update',
                    'categoryList' => $categoryList,
                    'data' => $_POST
                ]);
        }
    }
    public function delete(){
        if(ProductModel::deleteData($_GET['id'])){
            $_SESSION['message']=[ 'className' => 'alert alert-success' ,
                'message' => "Delete Successful"];
            header('Location: /Cybercom/php/Site/public/Admin/Product/index');
        }   
    }
}

?>