<?php
/**
 * Don't touch :D
 */

use Overland\Core\App;
use Overland\Core\Config;
use Overland\Core\Router\RouterServiceProvider;

require_once 'vendor/autoload.php';

$app = new App();

$app['config'] = new Config();
$app->register(RouterServiceProvider::class);
$app->boot();
