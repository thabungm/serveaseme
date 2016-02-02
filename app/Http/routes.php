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

//header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
//header('Access-Control-Allow-headers:Authorization');
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, Content-Type, Accept");

//header_remove('Access-Control-Allow-Origin');

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
    return view('welcome');
});



Route::group(['middleware' => ['web']], function () {
    Route::get('/auth/facebook', 'AuthenticateController@redirectToProviderFacebook');
    Route::get('/authenticate/callback/facebook', 'AuthenticateController@handlefbCallback');

});

Route::group(['prefix' => 'api'], function()
{
    //Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    
    Route::get('authenticate/facebook', 'AuthenticateController@redirectToProviderFacebook');
    Route::get('authenticate/callback/facebook', 'AuthenticateController@handleProviderCallback');
    
    
    Route::post('/items', 'ItemsController@create');
    Route::put('/items', 'ItemsController@update');
    Route::get('/items/{id}', 'ItemsController@read');
    Route::delete('/items/{id}', 'ItemsController@delete');
    Route::get('/category/{id}/items', 'ItemsController@getItemsByCategory');
    
    
    
    // Users routes
    Route::post('/authenticate', 'AuthenticateController@authenticate');
    Route::post('/users', 'UsersController@signup');
    Route::put('/users', 'UsersController@update');
    Route::get('/users/{id}', 'UsersController@read');
    Route::delete('/users/{id}', 'UsersController@delete');
    Route::put('/changepassword', 'UsersController@changePassword');
    
    // Order
    Route::post('/orders', 'OrdersController@create');
    Route::put('/orders', 'OrdersController@update');
    Route::get('/orders/{id}', 'OrdersController@read');
    Route::delete('/orders/{id}', 'OrdersController@delete');
    
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
