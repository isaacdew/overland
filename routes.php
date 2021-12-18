<?php
/**
 * Add routes here
 * The $router instance is made available to you
 */

use Overland\Core\Facades\Route;



Route::prefix('/testing')->middleware(['example', 'auth'])->group(function() {
    Route::get('test', 'ExampleController@test');
});
Route::get('wordpress-version', 'ExampleController@wordpress');

Route::post('login', 'ExampleController@authenticate');
