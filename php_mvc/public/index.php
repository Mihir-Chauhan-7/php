<?php
require '../Core/Router.php';
$router = new Router();
echo "URL : ".$_SERVER['QUERY_STRING'];

//echo get_class($router);

$router->addRoute('',['controller' => 'Home','action' => 'index']);
$router->addRoute('posts',['controller' => 'Posts','action' => 'index']);
$router->addRoute('posts/new',['controller' => 'Posts','action' => 'new']);

if($router->matchRoute($_SERVER['QUERY_STRING']))
{
	echo "<pre>";
    print_r($router->getPath());
	echo "</pre>";	
}
else
{
	echo "<br>No Path Found";
}

?>