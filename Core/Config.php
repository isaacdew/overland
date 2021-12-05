<?php

namespace Overland\Core;

class Config {
    protected $config;

    public function __construct()
    {
        $this->config = require_once plugin_dir_path(__DIR__) . 'config.php';
    }

    public function get($key) {
        $keys = explode('.', $key);
        $config = $this->config;
        foreach($keys as $key) {
            $config = $config[$key];
        }
        return $config;
    }
}
