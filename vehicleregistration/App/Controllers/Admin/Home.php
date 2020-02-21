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
        if(Service::checkAvailablity($_POST['date'],$_POST['time_slot'])){
            View::renderTemplate('User\service.html',[
                'title' => 'update',
                'serviceData' => Service::getData($_SESSION['update_id'])[0]
            ]);
            echo "Please Select Diffrent Time Slot";
        }
        else{
            if(Service::updateData($_POST)){
                header('Location: /Cybercom/php/vehicleregistration/public/admin/home/index');
            }
        }
        

    }
}

?>