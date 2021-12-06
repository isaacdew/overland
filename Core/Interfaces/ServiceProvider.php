<?php

namespace Overland\Core\Interfaces;

use Overland\Core\App;

abstract class ServiceProvider {
    protected App $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function boot() {}
}
