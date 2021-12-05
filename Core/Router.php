<?php

namespace Overland\Core;


class Router {
    protected $basePath;

    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    private function __construct()
    {
        global $overland_config;
        $this->basePath = $overland_config->get('app.basePath');
    }

    public static function load($file) {
        $router = new static;

        require plugin_dir_path(__DIR__) . $file;

        return $router;
    }

    public function get($path, $callback) {
        $this->routes['GET'][] = [
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function post($path, $callback) {
        $this->routes['POST'][] = [
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function register() {
        foreach($this->routes['GET'] as $route) {
            $this->registerARoute($route, 'GET');
        }
        foreach($this->routes['POST'] as $route) {
            $this->registerARoute($route, 'POST');
        }
    }

    protected function registerARoute($route, $method) {
        register_rest_route( $this->basePath, $route['path'], array(
            'methods' => $method,
            'callback' => $this->getAction($route['callback'])
          ) );
    }

    protected function getAction($callback) {
        if(is_string($callback) && str_contains($callback, '@')) {
            [$controller, $method] = explode('@', $callback);
    
            $controller = "\Overland\App\Controllers\\{$controller}";
    
            return [new $controller, $method];
        }

        return $callback;
    }
}
