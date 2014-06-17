<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Public routes
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Authentication routes
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::get('password/forgot', ['as' => 'forgotpassword', 'uses' => 'ProfilesController@forgotPassword']);
Route::post('password/request/{email}', ['as' => 'passwordresetrequest', 'uses' => 'ProfilesController@requestResetPassword']);
Route::patch('password/store/{user}/{token}', ['as' => 'passwordupdate', 'uses' => 'ProfilesController@updatePassword']);
Route::get('password/reset/{token}', ['as' => 'resetpassword', 'uses' => 'ProfilesController@resetPassword']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);


// Member routes
Route::group(array('before' => 'auth'), function()
{
    // Customers
    Route::resource('customers', 'CustomersController');

    // Suppliers
    Route::resource('suppliers', 'SuppliersController');

    // Categories
    Route::resource('categories', 'CategoriesController');

    // Attributes
    Route::resource('attributes', 'AttributesController'); 

    // Item Requests
    Route::get('item-requests/myrequests', ['as' => 'myrequests', 'uses' => 'UserItemRequestsController@getMyRequests']);
    Route::resource('item-requests', 'ItemRequestsController');
    Route::resource('{userId}/item-requests', 'UserItemRequestsController');

    // Quotations
    Route::resource('quotations', 'QuotationsController');
    Route::post( '/quotations/select', array(
        'as' => 'quotations.select',
        'uses' => 'QuotationsController@select'
    ));

    Route::get('/test', 'QuotationsController@test');


    //Settings: show form to create settings
    Route::get( '/settings/new', array(
        'as' => 'settings.new',
        'uses' => 'SettingsController@add'
    ) );

//Settings: create a new setting
    Route::post( '/settings', array(
        'as' => 'settings.create',
        'uses' => 'SettingsController@create'
    ) );


});



// Admin routes
Route::group(array('before' => 'auth|admin'), function()
{
	Route::resource('admin/users', 'UsersController');
	Route::resource('admin/files', 'FilesController');
});

//Route::patch('admin/users/{users}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);
// Route::resource('admin/users', 'UsersController');
// Route::resource('admin/files', 'FilesController');



Route::get('show', function()
{
	return View::make('quotations.show', array('title' => 'Quotes') );
});
