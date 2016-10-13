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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@update_avatar');

Route::get('/gallery', 'UserController@gallery');
Route::post('/gallery', 'UserController@update_gallery');


Route::get('/gallery/{id}', function ($id) {
    $gallery = App\images::first();
    echo $gallery->image;
});