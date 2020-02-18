<?php

namespace Core;

class Router{

    public $routes = [];
    public $parameters = [];

    public function getRoutes()
    {
        return $this->routes;
    }
    public function getParams()
    {
        return $this->parameters;
    }

    public function add($route,$parameters=[])
    {
        $route = preg_replace('/\//','\\/',$route);
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-0-9_.]+)',$route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)',$route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $parameters;

    }

    public function match($url)
    {
        foreach($this->routes as $route => $params)
        {
            if(preg_match($route,$url,$matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
            
                    }
                }

                $this->parameters = $params;
                return true;
            }
        }
        return false;
    }

    public function dispatch($url)
    {
        
        $url = $this->removeQueryStringVariables($url);

        if($this->match($url)){    
            $controller = $this->parameters['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace().$controller;

            if(class_exists($controller)){
                $controller_object = new $controller($this->parameters);
                $action = $this->parameters['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object, $action])){
                    $controller_object->$action();
                }else{
                    //echo "<br>Method $action (in controller $controller) not found";
                    throw new \Exception("Method $action not Found in controller ".get_class($this));
                }
            }else{
                //echo "<br>Controller class $controller not found";
                throw new \Exception("Controller class $controller not found");
            }
        }else{
            //echo "<br>No Route matched";
            throw new \Exception("No Route Matched.",404);
        }
    }

    public function convertToStudlyCaps($string)
    {
        return str_replace(' ', '',ucwords(str_replace('-',' ',$string)));
    }
    public function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
    public function removeQueryStringVariables($url)
    {
        if($url != ''){
            $parts = explode('&', $url, 2);

            if(strpos($parts[0], '=') === false){
                $url = $parts[0];
            }else{
                $url = '';
            }
        }
        return $url;
    }
    public function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if(array_key_exists('namespace',$this->parameters)){
            $namespace .= $this->parameters['namespace'] . '\\';

        } 
        return $namespace;
    }
}

?>
