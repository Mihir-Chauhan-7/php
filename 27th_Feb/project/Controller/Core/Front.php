<?php
require_once 'Controller/Product.php';
require_once 'Model/Core/Request.php';

class Front {
    public static function init(){
        $request = new Request();

        $controllerName = ucfirst($request->getRequest('c'));
        $action = $request->getRequest('a');

        if(!class_exists($controllerName)){
            throw new Exception('Class Does Not Exist.');
        }

        $controller = new $controllerName();
        
        if(!method_exists($controller,$action)){
            throw new Exception('Action Does Not Exist.');
        }

        $controller->$action();
    } 
}

?>