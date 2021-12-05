<?php

namespace Overland\Core\Router;

use Overland\Core\Middleware;

class Router {
    protected $basePath;

    protected Routes $routes;
    protected Middleware $middlware;

    private function __construct()
    {
        global $overland_config;
        $this->basePath = $overland_config->get('app.basePath');
        $this->routes = new Routes();
    }

    public static function load($file) {
        $router = new static;

        require $file;

        $middleware = new Middleware($router->basePath);
        $middleware->guard($router->routes);

        return $router;
    }

    public function middleware(array $middleware, $routes) {
        foreach($routes as $route) {
            $route->middleware($middleware);
        }
    }

    public function get($path, $action) {
        return $this->route($path, $action, 'GET');
    }

    public function post($path, $action) {
        return $this->route($path, $action, 'POST');
    }

    protected function route($path, $action, $method) {
        $route = new Route($this->basePath, $path, $action, $method);
        $this->routes->add($route);
        return $route;
    }
}
