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


Route::group(['prefix' => 'api/admin'], function()
{
    
//    Route::post('authenticate', 'AuthenticateController@authenticate');
    // Items admin routes
    Route::post('/items', 'AdminController@createItem');
    Route::post('/child', 'AdminController@createChild');
    Route::post('/items-root', 'AdminController@createRootItem');
    Route::put('/items', 'AdminController@update');
    Route::post('/item-children', 'AdminController@getItemChildren');
    Route::delete('/items/{id}', 'AdminController@delete');


    
});



Route::group(['prefix' => 'api'], function()
{
    //Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('user-by-token', 'AuthenticateController@getUserByToken');
    
    Route::get('authenticate/facebook', 'AuthenticateController@redirectToProviderFacebook');
    Route::get('authenticate/callback/facebook', 'AuthenticateController@handleProviderCallback');
    
    // Item children
    Route::get('/children/{parentId}', 'ItemsController@getChildren');
    Route::get('/items/{id}', 'ItemsController@read');
    Route::get('/category/{id}/items', 'ItemsController@getItemsByCategory');
    Route::get('/category', 'ItemsController@getCategory');
    Route::get('has-children/{parentId}', 'ItemsController@hasChildren');
    Route::get('decendants/{parentId}', 'ItemsController@getDecendants');

    
    
    // Users routes
    Route::post('/authenticate', 'AuthenticateController@authenticate');
    Route::post('/users', 'UsersController@signup');
    Route::put('/users', 'UsersController@update');
    Route::get('/users/{id}', 'UsersController@read');
    Route::delete('/users/{id}', 'UsersController@delete');
    Route::put('/changepassword', 'UsersController@changePassword');
    Route::post('/forgotpassword', 'UsersController@forgotPassword');
    Route::get('/resetpassword/:hash', 'UsersController@resetPassword');
    Route::post('/resetpassword', 'UsersController@sendResetPasswordLink');
    Route::get('/me', 'UsersController@getMe');
    
    // Order
    Route::post('/orders', 'OrdersController@create');
    Route::put('/orders', 'OrdersController@update');
    Route::get('/orders/{id}', 'OrdersController@read');
    Route::delete('/orders/{id}', 'OrdersController@delete');
    Route::get('/orders-history', 'OrdersController@getOrderByUserId');
    // Enquiry
    Route::post('/enquiry', 'EnquiryController@create');
//    Route::post('/p', 'EnquiryController@create');
    
    
    // address
    Route::post('/address', 'AddressController@create');
    Route::put('/address', 'AddressController@update');
    Route::get('/address/{id}', 'AddressController@read');
    Route::get('/address/user/{id}', 'AddressController@getAddressByUser');
    Route::post('/address/remove', 'AddressController@delete');
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
