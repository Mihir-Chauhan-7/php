<?php
namespace App\Controllers;

use App\Models\Post;
use Core\View;

class Posts extends \Core\Controller
{
    private function index()
    {
        // echo "<br>Hello From the index action in Posts Controller<br>";
        // echo "<pre>";
        // htmlspecialchars(print_r($_GET));
        // echo "</pre>";
        $posts= Post::getAll();
        View::renderTemplate('Posts/index.html',[
            'posts' => $posts
        ]);
    }
    private function addNew()
    {
        echo "<br>Hello From the addNew action in Posts Controller";
    }
    private function edit()
    {
        echo "<br>Hello From Edit in Posts Controller";
        echo "Route Parameters : <pre>";
        htmlspecialchars(print_r($_GET));
        echo "</pre>"; 

    }
    public function __call($name, $arguments){
        if(method_exists($this,$name)){
            if($this->before() !== false){
                call_user_func_array([$this,$name],$arguments);
                $this->after();
            }
        }else{
            throw new \Exception("Method $name not Found in controller ".get_class($this));
        }   
    }
    public function before()
    {
        echo "<br>Before";
    }
    public function after()
    {
        echo " After";
    }
}

?>