<?php
/**
 * Change config settings here
 */

return [
    'app' => [
        'basePath' => 'myplugin/v1',
        'pluginRoot' => OVERLAND_PLUGIN_ROOT,
        'serviceProviders' => [
            \Overland\Core\Authentication\AuthServiceProvider::class
        ],
        'middleware' => [
            'auth' => \Overland\Core\Authentication\AuthMiddleware::class,
            'example' => \Overland\App\Middleware\ExampleMiddleware::class
        ]
    ]
];
