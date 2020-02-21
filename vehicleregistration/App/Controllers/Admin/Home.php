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
            print_r(Service::getData($_GET['id'])[0]);
            View::renderTemplate('User\service.html',[
                'title' => 'Update',
                'serviceData' => Service::getAll()[0]
            ]); 
        }
    }
}

?>