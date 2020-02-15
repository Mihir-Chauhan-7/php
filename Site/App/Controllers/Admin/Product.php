<?php

namespace App\Controllers\Admin;

use App\Models\Product as ProductModel;
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
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            ProductModel::saveImage($_FILES) ? $_POST['image'] = $_FILES['image']['name'] : "";
            if(ProductModel::insertData($_POST)){
                echo "True";
                header('Location: /Cybercom/php/Site/public/admin/product/index');                  
            }
            else{
                View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Add',
                    'data' => $_POST
                ]);
                echo "Product Not Inserted";
            }  

        }
        else{
            View::renderTemplate('Admin/AddProduct.html',[
                'title' => 'Add',
                'productList' => ProductModel::getProductList()
            ]);
        }


        
    }
    public function edit(){
        if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
            $productData=ProductModel::getData($_GET['id']);
            View::renderTemplate('Admin\AddProduct.html',[
                'title' => 'Update',
                'data' => $productData[0]
           ]);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            ProductModel::saveImage($_FILES) ? $_POST['image'] = $_FILES['image']['name'] : "";
            print_r($_POST);
            ProductModel::updateData($_POST) 
            ?   header("Location: " . Config::HOME . "admin/product/index")
            :   View::renderTemplate('Admin\AddProduct.html',[
                    'title' => 'Update',
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