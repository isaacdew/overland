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
    }

    public function register() {
        register_rest_route( $this->basePath, $this->path, array(
            'methods' => $this->method,
            'callback' => $this->actionInstance()
          ) );
    }

    public function name($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return $this->path;
    }

    public function getFullPath() {
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

    public function setAttributes(array $attributes) {
        if(isset($attributes['middleware'])) {
            $this->middleware($attributes['middleware']);
        }

        if(isset($attributes['name'])) {
            $this->name($attributes['name']);
        }

        return $this;
    }

    public function prefix($prefix) {
        $this->path = trim($prefix, '/') . '/' . $this->path;

        return $this;
    }

    protected function actionInstance() {
        if(is_string($this->action) && str_contains($this->action, '@')) {
            [$controller, $method] = explode('@', $this->action);
    
            $controller = "\Overland\App\Controllers\\{$controller}";
    
            return [new $controller, $method];
        }

        return $this->action;
    }

}
