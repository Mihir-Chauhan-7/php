<?php
class Router{

    protected $routes=[];
    protected $path=[];

    public function addRoute($route,$path)
    {
        $this->routes[$route]=$path;
    }
	public function matchRoute($url)
	{
		foreach ($this->routes as $route => $path) {
			if($url == $route)
			{
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