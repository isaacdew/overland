<?php
/**
 * Add routes here
 * The $router instance is made available to you
 */

use Overland\Core\Facades\Route;

Route::get('wordpress-version', 'ExampleController@wordpress');


Route::middleware(['ExampleMiddleware'], [
    Route::get('test', 'ExampleController@test')
]);
