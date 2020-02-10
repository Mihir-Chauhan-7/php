<?php
require '../Core/Router.php';
$router = new Router();
echo "URL : ".$_SERVER['QUERY_STRING'];

//echo get_class($router);

$router->addRoute('',['controller' => 'Home','action' => 'index']);
$router->addRoute('posts',['controller' => 'Posts','action' => 'index']);
$router->addRoute('posts/new',['controller' => 'Posts','action' => 'new']);
$router->addRoute('{controller}/{action}');
//$router->addRoute('{controller}/{id:\d+}/{action}');
$router->addRoute('admin{action}/{controller}');



if($router->matchRoute($_SERVER['QUERY_STRING']))
{
	echo "<pre>";
	print_r($router->getRoutes());
    echo htmlspecialchars(print_r($router->getPath(),true));
	echo "</pre>";
}
else
{
	echo "<br>No Path Found";
}

?>