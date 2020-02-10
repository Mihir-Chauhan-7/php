<?php
namespace App\Controllers;

class Posts extends \Core\Controller
{
    public function index()
    {
        echo "<br>Hello From the index action in Posts Controller<br>";
        echo "<pre>";
        htmlspecialchars(print_r($_GET));
        echo "</pre>";
    }
    public function addNew()
    {
        echo "<br>Hello From the addNew action in Posts Controller";
    }
    public function edit()
    {
        echo "<br>Hello From Edit in Posts Controller";
        echo "Route Parameters : <pre>";
        htmlspecialchars(print_r($_GET));
        echo "</pre>"; 

    }
}

?>