<?php

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

        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)',$route);
        
        
        $route = '/^'.$route.'$/i';

        $this->routes[$route] = $parameters;
    }

    public function match($url)
    {
        foreach($this->routes as $route => $params)
        {
            if(preg_match($route,$url,$matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key]=$match;
                    }
                }

                $this->parameters=$params;
                return true;
            }
        }
        return false;
    }
}

?>
