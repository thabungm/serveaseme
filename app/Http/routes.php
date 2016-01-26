<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




//Address
Route::get('/', function () {
    return view('welcome');
});

Route::get('/address', function () {
    
});
Route::post('/address', function () {
    return view('welcome');
});
Route::put('/address', function () {
    return view('welcome');
});
Route::delete('/address', function () {
    return view('welcome');
});

// Items

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function()
{
    //Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('/items', 'ItemsController@create');
    Route::put('/items', 'ItemsController@update');
    Route::get('/items/{id}', 'ItemsController@read');
    Route::delete('/items/{id}', 'ItemsController@delete');
    Route::get('/category/items/{id}', 'ItemsController@getItemsByCategory');
    
    // Users routes
    Route::post('/users', 'UsersController@signup');
    Route::put('/users', 'UsersController@update');
    Route::get('/users/{id}', 'UsersController@read');
    Route::delete('/users/{id}', 'UsersController@delete');
    
});








Route::delete('/address/{id}', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
