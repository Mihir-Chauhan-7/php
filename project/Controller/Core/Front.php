<?php

namespace Controller\Core;

use Model\Core\Request;

class Front {
    
    public static function init(){
        $request = new Request();
    
        $controllerClassName = self::getControllerName();
        $action = $request->getRequest('a','grid').'Action';
        if(!class_exists($controllerClassName)){
            throw new \Exception('Class Does Not Exist.');
        }
                
        $controller = new $controllerClassName();
        
        if(!method_exists($controller,$action)){
            throw new \Exception('Action Does Not Exist.');
        }
        
        $controller->$action();
    }
    
    public static function getControllerName(){
        $request = new Request();
        $controllerClassName = str_replace(' ','\\',
            ucwords(str_replace('_',' ',$request->getRequest('c','index'))));
        return '\Controller\\'.$controllerClassName;
    }
}

?>