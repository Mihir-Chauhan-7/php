<?php

namespace Controller\Core;

use Model\Core\Request;

class Front {
    
    public static function init(){
        $request = new Request();
        
        $controllerName = '\Controller\\'.ucfirst($request->getRequest('c'));
        $action = $request->getRequest('a').'Action';

        if(!class_exists($controllerName)){
            throw new \Exception('Class Does Not Exist.');
        }
                
        $controller = new $controllerName();
        
        if(!method_exists($controller,$action)){
            throw new \Exception('Action Does Not Exist.');
        }
        
        $controller->$action();
    } 
}

?>