<?php
/**
 * Add routes here
 * The $router instance is made available to you
 */


$router->get('wordpress-version', 'ExampleController@wordpress');


$router->middleware(['ExampleMiddleware'], [
    $router->get('test', 'ExampleController@test')
]);
