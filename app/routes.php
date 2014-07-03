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


Event::listen('laravel.*', function($param)
{
    Log::info($param);
});



App::bind('SneadInterface', 'Snead');

// Test routes
Route::get('/test', function(){
    return Quotation::find(2)->itemRequests;
});
Route::get('zap', function(){
    $user = Sentry::findUserById(1);
    $resetCode = $user->getResetPasswordCode();

    // Update the user
    if ($user->save())

    if ($user->attemptResetPassword($resetCode, 'sc121212'))
    {
        return Redirect::to('login')->with('flash_message', 'Password updated!')->with('success', true);
    }
    else
    {
        return Redirect::back()->with('flash_message', 'Password not saved! Please try again.');
    }

});

Route::get('/reports' , 'HomeController@getReport');
Route::get('/service' , 'HomeController@testService');

// Public routes

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

// Authentication routes
Route::get('login', 'SessionsController@create');
Route::post('login/authenticate', 'SessionsController@authenticate');
Route::get('logout', 'SessionsController@destroy');
Route::get('password/forgot', ['as' => 'forgotpassword', 'uses' => 'ProfilesController@forgotPassword']);
Route::post('password/reset', 'ProfilesController@sendResetCode');
Route::post('password/request/{email}', ['as' => 'passwordresetrequest', 'uses' => 'ProfilesController@requestResetPassword']);
Route::patch('password/store/{user}/{token}', ['as' => 'passwordupdate', 'uses' => 'ProfilesController@updatePassword']);
Route::get('password/reset/{token}', ['as' => 'resetpassword', 'uses' => 'ProfilesController@resetPassword']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);


// Member routes
Route::group(array('before' => 'auth'), function()
{
    // Home page
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // User Profiles
    Route::group(array('before' => 'user'), function()
    {
        Route::get('profile/{user}/edit', ['as'=>'profile.edit', 'uses'=>'ProfilesController@edit']);
        Route::patch('profile/{user}', ['as'=>'profile.update', 'uses'=>'ProfilesController@update']);
    });

    // Customers
    Route::resource('customers', 'CustomersController');

    // Suppliers
    Route::resource('suppliers', 'SuppliersController');

    // Categories
    Route::resource('categories', 'CategoriesController');

    // Attributes
    Route::resource('attributes', 'AttributesController');

    // Portal Data
    Route::get('portal/contracts', ['as' => 'portal.contracts', 'uses' => 'PortalController@getContracts']);
    Route::get('portal/users', ['as' => 'portal.users', 'uses' => 'PortalController@getUsers']);

    // Item Requests
    Route::get('item-requests/myrequests', ['as' => 'myrequests', 'uses' => 'UserItemRequestsController@getMyRequests']);
    Route::resource('item-requests', 'ItemRequestsController');
    Route::resource('{userId}/item-requests', 'UserItemRequestsController');
    Route::patch('item-requests/attach/{item_request}/{quotation}', ['as' => 'attach-quotation', 'uses' => 'ItemRequestsController@attachRequest']);

    // Quotations
    Route::get('quotations/create/{item_request}', ['as' => 'quotations.createFromItemRequest', 'uses' => 'QuotationsController@create']);
    Route::resource('quotations', 'QuotationsController');
    Route::post( '/quotations/select', array(
        'as' => 'quotations.select',
        'uses' => 'QuotationsController@select'
    ));
    Route::patch('quotations/detach/{quotation}/{item_request}', ['as' => 'detach-request', 'uses' => 'QuotationsController@detachRequest']);
    Route::patch('quotations/attach/{quotation}', ['as' => 'attach-request', 'uses' => 'QuotationsController@attachRequest']);

    // Comments
    Route::put('comments/{type}/{id}', ['as'=>'comments.store', 'uses'=>'CommentsController@store']);


    // Dashboard
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@getDashboard']);




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


