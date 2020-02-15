<?php

namespace App\Controllers\Admin;

use App\Models\Product as ProductModel;
use Core\View;
use App\Config;

class Home extends \Core\Controller {

    public function login(){
        if(isset($_POST['txtemail']) && isset($_POST['txtpassword'])){
            if(Config::ADMIN_EMAIL==$_POST['txtemail'] &&
                 Config::ADMIN_PASSWORD==$_POST['txtpassword']){
                    header('Location: /Cybercom/php/Site/public/admin/home/dashboard');                  
            }
            else{
                View::renderTemplate('Admin\Login.html');
                echo "Invalid Details";    
            }
        }
        else{
            View::renderTemplate('Admin\Login.html',[
                'name' => 'Mihir',
                'productList' => ProductModel::getProductList()
            ]);
        }
        
        //echo 

        //echo "Login Action"; 
    }
    public function dashboard(){
        View::renderTemplate('base.html',[
            'name' => 'Mihir',
            'productList' => ProductModel::getProductList()
        ]);
    }
    
}

?>