<?php

namespace App\Controllers\Admin;
use Core\View;
use App\Config;
use App\Models\Service;

class Home extends \Core\Controller {

    public function index(){
        View::renderTemplate('User\Admin.html',[
            'serviceData' => Service::getAll()
        ]);
    }
    public function edit(){
        if(isset($_GET['id'])){
            $_SESSION['update_id'] = $_GET['id'];
            //print_r(Service::getData($_GET['id'])[0]);
            View::renderTemplate('User\service.html',[
                'title' => 'update',
                'serviceData' => Service::getData($_GET['id'])[0]
            ]); 
        }
    }
    public static function update(){
        if(Service::checkAvailablity($_POST['date'],$_POST['time_slot'],$_SESSION['update_id'])){
            View::renderTemplate('User\service.html',[
                'title' => 'update',
                'serviceData' => Service::getData($_SESSION['update_id'])[0]
            ]);
            if(Service::checkNo($_POST['vehicle_no'],$_POST['licence_no'],$_SESSION['update_id'])){
                echo "Vehicle No & Licence Already Registered..";
            }
            else{
                echo "Please Select Diffrent Time Slot";
            }
        }
        else{
            if(Service::updateData($_POST)){
                header('Location: /Cybercom/php/vehicleregistration/public/admin/home/index');
            }
        }
        

    }
    public static function updateAll(){
        print_r($_POST);
        if(isset($_POST['check'])){
            foreach($_POST['check'] as $value){
                $_SESSION['update_id'] = $value;
                Service::updateData(['status' => $_POST['status']]);
                header('Location: /Cybercom/php/vehicleregistration/public/admin/home/index');
            }
        }
        else{
            header('Location: /Cybercom/php/vehicleregistration/public/admin/home/index');
            echo "Please Select Atleast One Service..";
        }
        
    }
}

?>  