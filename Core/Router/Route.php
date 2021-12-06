<?php

namespace Overland\Core\Router;

class Route {
    protected $basePath;
    protected $path;
    protected $action;
    protected $method;
    protected $name = '';
    protected $middleware = [];

    public function __construct($basePath, $path, $action, $method)
    {
        $this->basePath = $basePath;
        $this->path = $path;
        $this->action = $action;
        $this->method = $method;

        register_rest_route( $this->basePath, $this->path, array(
            'methods' => $this->method,
            'callback' => $this->instantiateAction()
          ) );
    }

    public static function register($basePath, $path, $action, $method) {
        return new static($basePath, $path, $action, $method);
    }

    public function name($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return '/' . $this->basePath . '/' . $this->path;
    }

    public function getMethod() {
        return $this->method;
    }

    public function middleware(array $middleware) {
        $this->middleware = [...$this->middleware, ...$middleware];
    }

    public function getMiddleware() {
        return $this->middleware;
    }

    protected function instantiateAction() {
        if(is_string($this->action) && str_contains($this->action, '@')) {
            [$controller, $method] = explode('@', $this->action);
    
            $controller = "\Overland\App\Controllers\\{$controller}";
    
            return [new $controller, $method];
        }

        return $this->action;
    }

}
