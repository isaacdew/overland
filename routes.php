<?php
/**
 * Add routes here
 * The $router instance is made available to you
 */

use Overland\Core\Facades\Route;

Route::get('wordpress-version', 'ExampleController@wordpress');


Route::middleware(['example', 'auth'])->group('testing/', [
    Route::get('test', 'ExampleController@test')
]);

Route::post('login', 'ExampleController@authenticate');
