<?php
class Router{

    protected $routes=[];
    protected $path=[];

    public function addRoute($route,$path=[])
    {
        $route = preg_replace('/\//', '\\/', $route);

        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        
        $route = '/^' . $route . '$/i';

        $this->routes[$route]=$path;
    }
	public function matchRoute($url)
	{
		foreach ($this->routes as $route => $path) {
            if(preg_match($route,$url,$matches))
            {
                foreach($matches as $key => $match){
                    if(is_string($key))
                    {
                        $path[$key]=$match;
                    }
                }
                $this->path=$path;
                return true;
            }
		}
		return false;
	}

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getPath()
    {
    	return $this->path;
    }
    
}
?>