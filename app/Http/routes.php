<?php

Route::auth();
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


Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/', 'HomeController@index');
    /*
     * ***************************
     * Show for Normal Admin
     * ***************************
     */

    Route::get('/packages/{id}/', 'packages\PackagesController@show')->where('id', '[0-9]+');
    Route::get('/consumers/{id}/', 'consumers\ConsumersController@show')->where('id', '[0-9]+');
    Route::get('/consumers/{id}/edit', 'consumers\ConsumersController@edit')->where('id', '[0-9]+');
    Route::patch('/consumers/{id}', 'consumers\ConsumersController@update')->where('id', '[0-9]+');
    Route::get('/consumers/{id}/print', 'consumers\ConsumersController@printCon')->where('id', '[0-9]+');
    Route::get('/consumers/printConsumers', 'consumers\ConsumersController@printConsumers');
    Route::get('/bills/{id}/', 'bills\BillsController@show')->where('id', '[0-9]+');
    Route::get('/payments/{id}/', 'payments\PaymentsController@show')->where('id', '[0-9]+');
    Route::get('/expences/{id}', 'expences\ExpencesController@show')->where('id', '[0-9]+');
    Route::get('/consumer_requests/{id}', 'request\Consumer_requestsController@show')->where('id', '[0-9]+');
    Route::get('/previous_consumers/{id}', 'consumers\PreviousConsumersController@show')->where('id', '[0-9]+');
    Route::get('/previous_consumers/{id}/edit', 'consumers\PreviousConsumersController@edit')->where('id', '[0-9]+');
    Route::patch('/previous_consumers/{id}', 'consumers\PreviousConsumersController@update')->where('id', '[0-9]+');

    /*
     * *********************************
     * For Super Admin
     * *********************************
     */
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::resource('/users', 'users\\UsersController');
        Route::resource('/packages', 'packages\\PackagesController');
        Route::resource('/consumers', 'consumers\\ConsumersController');
        Route::resource('/bills/generate_bills', 'bills\\Generate_billsController');
        Route::resource('/bills', 'bills\\BillsController');
        Route::resource('/payments', 'payments\\PaymentsController');
        Route::resource('/expences', 'expences\\ExpencesController');
        Route::get('/bills_report', 'report\reportController@bill');
        Route::get('/payments_report', 'report\reportController@payment');
        Route::get('/statement', 'report\reportController@statement');
        Route::get('/account_statement', 'report\reportController@account_statement');
        Route::resource('/consumer_requests', 'request\\Consumer_requestsController');
        Route::resource('/start_month', 'Start_monthController');
        Route::resource('/previous_consumers', 'consumers\\PreviousConsumersController');
    });

    /*
     * ***********************************
     * For Normal Admin
     * *********************************
     */
    Route::get('/packages', 'packages\PackagesController@index');


    Route::get('/consumers', 'consumers\ConsumersController@index');
    Route::get('/consumers/create', 'consumers\ConsumersController@create');
    Route::post('/consumers', 'consumers\ConsumersController@store');


    Route::get('/bills', 'bills\BillsController@index');

    Route::get('/payments', 'payments\PaymentsController@index');
    Route::get('/payments/create', 'payments\PaymentsController@create');
    Route::post('/payments', 'payments\PaymentsController@store');

    Route::get('/expences', 'expences\ExpencesController@index');
    Route::get('/expences/create', 'expences\ExpencesController@create');
    Route::post('/expences', 'expences\ExpencesController@store');

    Route::get('/consumer_requests', 'request\Consumer_requestsController@index');
    Route::get('/consumer_requests/create', 'request\Consumer_requestsController@create');
    Route::post('/consumer_requests', 'request\Consumer_requestsController@store');

    Route::get('/previous_consumers', 'consumers\PreviousConsumersController@index');


    /*
     * ************************************************
     * Ajax middlerware
     * *************************************************
     */
    Route::group(['middleware' => 'ajax'], function () {
        Route::get('/ajax/bills', 'ajaxController@showBill');
        Route::get('/ajax/billsUseID', 'ajaxController@showBillUseID');
    });


    /*
     * *********************************
     * View Own profile
     * ********************************
     */
    Route::get('/myprofile', 'users\UserProfile@index');
    Route::get('/myprofile/edit', 'users\UserProfile@edit');
    Route::patch('/myprofile/update', 'users\UserProfile@update');
});


