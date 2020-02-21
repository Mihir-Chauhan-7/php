<?php

namespace App\Controllers;
use Core\View;
use App\Config;
use App\Models\Service as ModelsService;

class Service extends \Core\Controller {
    public function index(){
        View::renderTemplate('User\index.html',[
            'serviceData' => ModelsService::getAll()
        ]);
    }
    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST['user_id'] = $_SESSION['userId'];
            if(ModelsService::checkAvailablity($_POST['date'],$_POST['time_slot'])){
                View::renderTemplate('User\service.html',[
                    'title' => 'register',
                    'data' => $_POST
                ]);    
                echo "Time Slot Already Full";

            }
            else{
                if(ModelsService::checkNo($_POST['vehicle_no'],$_POST['licence_no'])){
                    View::renderTemplate('User\service.html',[
                        'title' => 'register',
                        'data' => $_POST
                    ]);
                    echo "Licence And Vehicle No Already Registered";
                }
                else{
                    if(ModelsService::insertData($_POST)){
                        //echo "true";
                        header('Location: /Cybercom/php/vehicleregistration/public/service/index');
                    }
                    else{
                        //echo "false";
                    }
                }
                
            }
            
        }
        else{
            View::renderTemplate('User\service.html',[
                'title' => 'register',
                'data' => $_POST
            ]);
        }
    }
    
}

?>