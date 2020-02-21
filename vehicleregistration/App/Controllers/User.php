<?php

namespace App\Controllers;
use Core\View;
use App\Config;
use App\Models\User as userModel;
use App\Models\Address;
use App\Models\Service;

class user extends \Core\Controller {

    public function login(){
        
        if(isset($_POST['txtemail']) && isset($_POST['txtpassword'])){
            
            $user = userModel::executeSQL("SELECT * FROM users WHERE email 
                ="."'".$_POST['txtemail']."'")[0];
            
            if(!empty($_POST['txtemail']) && !empty($_POST['txtpassword']) 
                && $user['email'] == $_POST['txtemail'] && 
                    $user['password'] == $_POST['txtpassword'])
            {
                    $_SESSION['userId'] = $user['user_id'];
                    header('Location: user/dashboard');
            }
            else{           
                View::renderTemplate('User\Login.html');                          
                View::showMessage('Invalid Details',0);
            }
        }
        else{
            View::renderTemplate('User\Login.html',[
                'name' => 'Mihir'
            ]);
        }
    }
    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(userModel::insertData($_POST)){
                $_POST['user_id']=userModel::getLastId();
                if(Address::insertData($_POST)){
                    View::showMessage('Registration Success..',1); 
                    header('Location: /Cybercom/php/vehicleregistration/public/');
                }
                else{
                    userModel::deleteData($_POST['user_id']);
                }                            
            }
            else{
                View::renderTemplate('User\register.html',[
                    'user' => $_POST
                ]);
                View::showMessage('Registration Unsuccessful...',0);
            }  
        }
        else{
            View::renderTemplate('User\register.html');
        }
    }
    public function logout(){
        unset($_SESSION['loginStatus']);
        session_destroy();
        header('Location: /Cybercom/php/vehicleregistration/public/');
        View::showMessage('Logout Successful',1);                      
    }
    public function dashboard(){
        Config::checkLogin()
        ? View::renderTemplate('User\index.html',[
            'serviceData' => Service::getAll()
          ])
        : die("You Are Not Logged In");
    }
    
}

?>