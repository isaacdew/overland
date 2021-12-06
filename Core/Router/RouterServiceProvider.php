<?php

namespace Overland\Core\Router;

use Overland\Core\Facades\Route;
use Overland\Core\Interfaces\ServiceProvider;

class RouterServiceProvider extends ServiceProvider {
    public function boot() {
        // Register router
        $this->registerRouter();
    }

    protected function registerRouter() {
        $this->app->singleton('router', function ($app) {
            return new Router($app);
        });
        Route::setApp($this->app);
        require_once $this->app['config']->get('app.pluginRoot') . 'routes.php';

        $this->app['router']->registerRoutes();
    }
}
