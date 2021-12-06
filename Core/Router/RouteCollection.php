<?php

namespace Overland\Core\Router;

use Overland\Core\Interfaces\Collection;

class RouteCollection extends Collection {

    public function add(Route $route) {
        $this->items[] = $route;
    }

    public function findByName($name) {
        return reset(array_filter($this->items, fn($route) => $route->getName() == $name)) ?? false;
    }

    public function whereHasMiddleware() {
        return new static(array_filter($this->items, fn($route) => count($route->getMiddleware())));
    }

    public function find($path, $method) {
        return reset(array_filter($this->items, function($route) use ($path, $method) {
            return $route->getFullPath() == $path && $route->getMethod() == $method;
        })) ?? false;
    }
}
