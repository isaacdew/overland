<?php

namespace Overland\Core\Router;

use Overland\Core\App;
use Overland\Core\Middleware;

class Router {
    protected $basePath;

    protected App $app;
    protected RouteCollection $routes;
    protected Middleware $middlware;

    public function __construct($app)
    {
        $this->app = $app;
        $this->basePath = $app['config']->get('app.basePath');
        $this->routes = new RouteCollection();
    }

    public function middleware(array $middleware, $routes) {
        foreach($routes as $route) {
            $route->middleware($middleware);
        }
    }

    public function get($path, $action) {
        return $this->addRoute($path, $action, 'GET');
    }

    public function post($path, $action) {
        return $this->addRoute($path, $action, 'POST');
    }

    protected function addRoute($path, $action, $method) {
        $route = new Route($this->basePath, $path, $action, $method);
        $this->routes->add($route);
        return $route;
    }
}
