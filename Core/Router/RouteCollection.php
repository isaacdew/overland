<?php

namespace Overland\Core\Router;

class RouteCollection {
    protected $routes = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function add(Route $route) {
        $this->routes[] = $route;
    }

    public function findByName($name) {
        return reset(array_filter($this->routes, fn($route) => $route->getName() == $name)) ?? false;
    }

    public function find($path, $method) {
        return reset(array_filter($this->routes, function($route) use ($path, $method) {
            return $route->getPath() == $path && $route->getMethod() == $method;
        })) ?? false;
    }
}
