<?php
header('Access-Control-Allow-Origin: *');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Auth
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//Pagina info
Route::get('/', 'Admin\homeController@info');
Route::get('/info', 'Admin\homeController@info');



Route::get("home",function(){
        return "ok";
});

Route::group(['middleware' => 'auth'], function()
{

    Route::get('dashboard','Admin\homeController@index');

    // Settings
    // Users Management
    Route::resource('settings/users','Admin\Settings\UserController');
    Route::controller('settings/users/data','Admin\Settings\UserController');
    // Groups Management
    Route::resource('settings/groups','Admin\Settings\GroupController');
    Route::controller('settings/groups/data','Admin\Settings\GroupController');
    // Config Management
    Route::resource('settings/config','Admin\Settings\ConfigController');
    Route::controller('settings/config/data','Admin\Settings\ConfigController');

    // Reports Managment
    Route::resource('analisi/reports','Admin\ReportsController');

    Route::get('/test', 'Admin\ReportsController@test');


    //Tickets
    Route::get('/ticket/create', 'TicketsController@create');
    Route::post('/contact', 'TicketsController@store');
    Route::post('/ticket/create', 'TicketsController@store');


    Route::get('/tickets', 'TicketsController@myIindex');


    Route::get('/ticket/{slug?}', 'TicketsController@show');
    Route::get('/ticket/{slug?}/edit','TicketsController@edit');
    Route::post('/ticket/{slug?}/edit','TicketsController@update');
    Route::post('/ticket/{slug?}/delete','TicketsController@destroy');

    // Comments Ticket
    Route::post('/comment', 'CommentsController@newComment');







});










