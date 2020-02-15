<?php

namespace App\Controllers\Admin\CMS;

use App\Models\Cms;
use Core\View;
use App\Config;

class Pages extends \Core\Controller {

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print_r($_POST);
            if(Cms::insertData($_POST)){
                header('Location: /Cybercom/php/Site/public/admin/cms/pages/index');                  
            }
            else{
                View::renderTemplate('Admin\AddCMS.html',[
                    'title' => 'Add',
                    'data' => $_POST
                ]);
                echo "Page Not Inserted";
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
            Cms::updateData($_POST) 
            ?   header("Location: " . Config::HOME . "admin/cms/pages/index")
            :   View::renderTemplate('Admin\AddCMS.html',[
                    'title' => 'Update',
                    'data' => $_POST
                ]);
        }
    }
    public function delete(){
        if(Cms::deleteData($_GET['id'])){
            $_SESSION['message']=[ 'className' => 'alert alert-success' ,
                'message' => "Delete Successful"];
            header('Location: /Cybercom/php/Site/public/Admin/Cms/pages/index');
        }   
    }
}

?>