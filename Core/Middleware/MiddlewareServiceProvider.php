<?php

namespace Overland\Core\Middleware;

use Overland\Core\Interfaces\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider {
    public function boot() {
        $middleware = new Middleware();
        $middleware->guard($this->app['router']->getRoutes()->whereHasMiddleware());
    }
}
