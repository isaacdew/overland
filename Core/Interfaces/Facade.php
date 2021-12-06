<?php

namespace Overland\Core\Interfaces;

use Overland\Core\App;

abstract class Facade {

    protected static App $app;

    public static function __callStatic($name, $arguments)
    {
        $root = static::getFacadeRoot();
        $instance = static::$app[$root];

        return $instance->$name(...$arguments);
    }

    public static function setApp(App $app) {
        static::$app = $app;
    }

    protected static function getFacadeRoot() {

    }
}
