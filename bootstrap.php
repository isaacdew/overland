<?php

use Overland\Core\Router;

require_once 'vendor/autoload.php';

add_action('rest_api_init', function() {
    Router::load('routes.php')
        ->register();
});
