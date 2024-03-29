<?php

namespace App\Controllers\Admin\CMS;

use App\Models\Cms;
use Core\View;
use App\Config;
class Pages extends \Core\Controller {


    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Cms::insertData($_POST)){
                Cms::redirect('index');
                View::showMessage('Page Inserted...',1);                                   
            }
            else{
                View::renderTemplate('Admin\AddCMS.html',[
                    'title' => 'Add',
                    'data' => $_POST
                ]);
                View::showMessage('Page Not Inserted...',0);                  
            }  

        }
        else{
            View::renderTemplate('Admin\AddCMS.html',[
                'title' => 'Add',
            ]);
        } 
}
    public function index(){
        View::renderTemplate('Admin\Manage_Cms.html',[
            'cmsList' => Cms::getAll(),
            'cmsKeys' => Cms::getKeys()
        ]);
    }

    public function edit(){
        if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
            View::renderTemplate('Admin\AddCMS.html',[
                'title' => 'Update',
                'data' => Cms::getData($_GET['id'])[0]
           ]);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Cms::updateData($_POST)){
                Cms::redirect('index');
                View::showMessage('Page Updated...',1);                  
            } 
            else{
                View::renderTemplate('Admin\AddCMS.html',[
                    'title' => 'Update',
                    'data' => $_POST
                ]);
                View::showMessage('Page Not Updated...',0);                  
            }
        }
    }
    public function delete(){
        if(Cms::deleteData($_GET['id'])){
            Cms::redirect('index');
            View::showMessage('Page Deleted...',0);                  
        }   
    }
}

?>