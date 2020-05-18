<?php

namespace Router;

class Router {

    public $url;
    public $routes = [];
    
    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function get(string $path, string $action)
    {
        //push la route dans le GET
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function run()
    {

        //boucler sur les routes
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                $route->execute();
            }
        }

        return header('HTTP/1.0 404 Not Found');
    }
}