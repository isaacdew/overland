<?php

namespace Overland\Core;

use Overland\Core\Router\Routes;
use WP_REST_Request;

class Middleware {
    protected WP_REST_Request $request;

    protected Routes $routes;

    public function __construct()
    {
        add_filter( 'rest_pre_dispatch', [$this, 'filterRequest'], 0, 3);
    }

    public function guard(Routes $routes) {
        $this->routes = $routes;
        return $this;
    }


    public function filterRequest($result, $server, $request) {
        $this->request = $request;
        $route = $this->routeMatch();
        if($route) {
            foreach($route->getMiddleware() as $middleware) {
                $middleware = "\Overland\App\Middleware\\{$middleware}";
                (new $middleware)->handle();
            }
        }
    }

    protected function routeMatch() {
        $route = $this->request->get_route();
        $method = $this->request->get_method();
        return $this->routes->find($route, $method);
    }
}

