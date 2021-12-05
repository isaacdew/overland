<?php

namespace Overland\Core\Router;

class Routes {
    protected $routes = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function add(Route $route) {
        $this->routes[] = $route;
    }

    public function find($path, $method) {
        return reset(array_filter($this->routes, function($route) use ($path, $method) {
            $test = $route->getPath();
            $test2 = $route->getMethod();
            return $route->getPath() == $path && $route->getMethod() == $method;
        })) ?? false;
    }
}
