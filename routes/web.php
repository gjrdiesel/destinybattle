<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fight', function () {
    return view('fight');
});

Route::get('/api/search/{console}/{name}', 'ApiController@searchPlayer');
Auth::routes();

Route::get('/home', 'HomeController@index');
