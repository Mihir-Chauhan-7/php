<?php

//require '../App/Controllers/Posts.php';
//require '../Core/Router.php';
use App\Controllers\Posts;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// spl_autoload_register(function ($class){
//     $root = dirname(__DIR__);
//     $file = $root.'/'.str_replace('\\','/',$class).'.php';
//     if(is_readable($file)){
//         require $root.'/'.str_replace('\\','/',$class).'.php';
//     }
// });

//$router = new Router();
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router(); 

//echo "URL : ".$_SERVER['QUERY_STRING'];


$router->add('',['controller' => 'Home','action' => 'index']);
$router->add('home',['controller' => 'Home','action' => 'index']);
//$router->add('home/login',['controller' => 'Home','action' => 'login']);
//$router->add('home/dashboard',['controller' => 'Home','action' => 'dashboard']);
// $router->add('posts/112/edit',['controller' => 'Posts','id' => 112,'action' => 'edit']);

$router->add('{controller}/{action}');
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
$router->add('admin/cms/{controller}/{action}',['namespace' => 'Admin\CMS']);
$router->add('{controller}/{id:\d+}/{action}');


// echo "<pre>";
// print_r($router->getRoutes());
// echo "</pre>";

// if($router->match($_SERVER['QUERY_STRING']))
// {
//   echo "<pre>";
//   print_r($router->getRoutes());
//   echo "</pre>";
// }
// else
// {
// 	echo "<br>No Path Found";
// }

$router->dispatch($_SERVER['QUERY_STRING']);
?>