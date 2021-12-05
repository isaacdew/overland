<?php
/**
 * Don't touch :D
 */
use Overland\Core\Config;
use Overland\Core\Router;

require_once 'vendor/autoload.php';

global $overland_config;
$overland_config = new Config();

add_action('rest_api_init', function() {
    Router::load('routes.php')
        ->register();
});
