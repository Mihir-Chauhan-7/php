<?php

namespace App\Controllers\Admin;
use Core\View;
use App\Config;
use App\Models\Cart;

class Home extends \Core\Controller {

    public function login(){
        if(isset($_POST['txtemail']) && isset($_POST['txtpassword'])){
            if(Config::ADMIN_EMAIL == $_POST['txtemail'] && 
                Config::ADMIN_PASSWORD == $_POST['txtpassword'])
            {
                    $_SESSION['loginStatus'] = true;
                    header('Location: /Cybercom/php/Site/public/admin/home/dashboard');                  
            }
            else{
                $_SESSION['userId'] = 1;
                echo isset($_SESSION['cartId']) ? Cart::saveCart() : "false";
                header('Location:'.Config::HOME);                  
                $_SESSION['loginStatus'] = false;
                View::renderTemplate('Admin\Login.html');                          
                View::showMessage('Invalid Details',0);
            }
        }
        else{
            View::renderTemplate('Admin\Login.html',[
                'name' => 'Mihir'
            ]);
        }
    }
    public function logout(){
        unset($_SESSION['loginStatus']);
        session_destroy();
        header('Location: /Cybercom/php/Site/public/admin/home/login');
        View::showMessage('Logout Successful',1);                      
    }
    public function dashboard(){
        Config::checkLogin(1)
        ? View::renderTemplate('base.html',[
                'name' => 'Mihir'
          ])
        : die("You Are Not Logged In");
    }
    
}

?>