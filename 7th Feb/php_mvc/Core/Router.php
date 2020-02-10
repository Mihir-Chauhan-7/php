<?php
class Router{

    protected $routes=[];
    protected $path=[];

    public function addRoute($route,$path=[])
    {
        $route = preg_replace('/\//', '\\/', $route);

        echo $route;

        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        echo $route."<br>";

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        
        echo $route."<br>";

        $route = '/^' . $route . '$/i';

        echo $route."<br>";

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