<?php

namespace Overland\Core;

use ArrayAccess;
use Overland\Core\Interfaces\ServiceProvider;

class App implements ArrayAccess
{
    protected $serviceProviders = [];
    protected $singletons = [];

    public function register($provider) {
        $this->serviceProviders[] = $provider;
    }

    public function boot() {
        foreach($this->serviceProviders as $provider) {
            $provider = new $provider($this);
            $provider->boot();
        }
    }

    public function singleton($name, $callback) {
        $this->singletons[$name] = $callback($this);
    }

    public function offsetExists($offset)
    {
        return isset($this->singletons[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->singletons[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->singletons[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->singletons[$offset]);
    }
}
