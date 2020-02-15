<?php

namespace App\Controllers;

session_start();
use App\Models\Post;
use Core\View;
use App\Config;

class Posts extends \Core\Controller
{
    private function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html',[
            'action' => 'new',
            'title' => 'Add',
            'posts' => $posts
        ]);
    }
    private function delete(){
        if(Post::deleteData($_GET['id']) == 00000){
            $_SESSION['message']=[ 'className' => 'alert alert-success' ,
                    'message' => "Delete Successful"];
            header('Location: /Cybercom/php/10th_Feb/public/posts/index');
        }
        
    }
    private function new()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Post::insertData($_POST) == 00000){
                $_SESSION['message']=[ 'className' => 'alert alert-success' ,
                    'message' => "Insert Successful"];
                header('Location: /Cybercom/php/10th_Feb/public/posts/index');  
            }
            else{
                View::renderTemplate('Posts/index.html',[
                    'action' => 'new',
                    'title' => 'Add',
                    'user' => $_POST
                ]);
            }
        }

    }
    private function save()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(Post::updateData($_POST) == 00000){
                $_SESSION['message']=[ 'className' => 'alert alert-success' ,
                    'message' => "Update Successful"];
                header('Location: /Cybercom/php/10th_Feb/public/posts/index');        
            }
            else{
                
                View::renderTemplate('Posts/index.html',[
                     'action' => 'save',
                     'title' => 'Update',
                     'user' => $_POST
                 ]);
            }
        }
        //header('Location: /Cybercom/php/10th_Feb/public/posts/index');
    }
    private function edit()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $userData = Post::getData($_GET['id']);
            View::renderTemplate('Posts/index.html',[
                'action' => 'save',
                'title' => 'Update',
                'user' => $userData[0]
           ]);
        }
    }
    public function __call($name, $arguments){
        if(method_exists($this,$name)){
            if($this->before() !== false){
                call_user_func_array([$this,$name],$arguments);
                $this->after();
            }
        }else{
            throw new \Exception("Method $name not Found in controller " . get_class($this));
        }   
    }
    public function before()
    {
        echo "<br>Before";
    }
    public function after()
    {
        echo "<br>After";
    }
}
?>