<?php
namespace App\Controllers;

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
        print_r($_GET);
        Post::deleteData($_GET['id']);
        header('Location: /Cybercom/php/10th_Feb/public/posts/index');
    }
    private function new()
    {
        Post::insertData($_GET);
        header('Location: /Cybercom/php/10th_Feb/public/posts/index');
    }
    private function save()
    {
        print_r($_GET);
        Post::updateData($_GET);
        header('Location: /Cybercom/php/10th_Feb/public/posts/index');
    }
    private function edit()
    {
        echo "<br>Hello From Edit in Posts Controller";
        $userData=Post::getData($_GET['id']);
        View::renderTemplate('Posts/index.html',[
            'action' => 'save',
            'title' => 'Update',
            'user' => $userData[0]
        ]);

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