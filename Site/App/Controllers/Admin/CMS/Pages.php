<?php

namespace App\Controllers\Admin\CMS;

use App\Models\Cms;
use Core\View;
use App\Config;

class Pages extends \Core\Controller {

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Cms::insertData($_POST)){
                header('Location: /Cybercom/php/Site/public/admin/cms/pages/index'); 
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
        //print_r(Cms::getAll());
        View::renderTemplate('Admin\Manage_Cms.html',[
            'cmsList' => Cms::getAll(),
            'cmsKeys' => Cms::getKeys()
        ]);
    }
    public function edit(){
        if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
            $pageData=Cms::getData($_GET['id']);
            View::renderTemplate('Admin\AddCMS.html',[
                'title' => 'Update',
                'data' => $pageData[0]
           ]);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Cms::updateData($_POST)){
                header("Location: " . Config::HOME . "admin/cms/pages/index");
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
            header('Location: /Cybercom/php/Site/public/Admin/Cms/pages/index');
            View::showMessage('Page Deleted...',0);                  
        }   
    }
}

?>