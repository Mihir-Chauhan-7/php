<?php

//require '../App/Controllers/Posts.php';
//require '../Core/Router.php';
spl_autoload_register(function ($class){
    $root = dirname(__DIR__);
    $file= $root.'/'.str_replace('\\','/',$class).'.php';
    if(is_readable($file)){
        require $root.'/'.str_replace('\\','/',$class).'.php';
    }
});

//$router = new Router();
$router = new Core\Router(); 

echo "URL : ".$_SERVER['QUERY_STRING'];


// $router->add('',['controller' => 'Home','action' => 'index']);
// $router->add('posts',['controller' => 'Posts','action' => 'index']);
// $router->add('posts/new',['controller' => 'Posts','action' => 'new']);
// $router->add('posts/112/edit',['controller' => 'Posts','id' => 112,'action' => 'edit']);

$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

// echo "<pre>";
// print_r($router->getRoutes());
// echo "</pre>";

// if($router->match($_SERVER['QUERY_STRING']))
// {
// 	echo "<pre>";
//     echo htmlspecialchars(print_r($router->getParams(),true));
// 	echo "</pre>";
// }
// else
// {
// 	echo "<br>No Path Found";
// }
$router->dispatch($_SERVER['QUERY_STRING'])


?>