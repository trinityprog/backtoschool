<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', 'HomeController@index');
Route::get('sms', 'SMSController@index');


Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post("/question", "HomeController@question");
Route::get("/language/{locale}", "HomeController@language");
Route::get('/restricted', 'Admin\AdminController@restrict');
Route::get('/winners', 'HomeController@winners');

Route::post('/registration', 'Auth\RegisterController@registration');
Route::post('/authorization', 'Auth\LoginController@authorization');

Route::middleware(['auth'])->group(function() {
    Route::post('/check', 'Admin\ChecksController@store');

    Route::get('/get-logout', 'Auth\LoginController@logout');
});


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin', 'Admin\AdminController@index');
    Route::get('/admin/dashboard', 'Admin\AdminController@index');


    Route::get('/admin/users', 'Admin\UsersController@index');
    Route::delete('/admin/user/{id}', 'Admin\UsersController@destroy');
    Route::get('/admin/users/export', 'Admin\UsersController@export');

    Route::get('/admin/checks/export', 'Admin\ChecksController@export');
    Route::resource('/admin/checks', 'Admin\ChecksController');


    Route::resource('/admin/faqs', 'Admin\FaqsController');

    Route::post('/admin/winners/import', 'Admin\WinnersController@import');
    Route::get('/admin/winners/imported', 'Admin\WinnersController@imported');
    Route::post('/admin/winners/imported', 'Admin\WinnersController@imported');
    Route::resource('/admin/winners', 'Admin\WinnersController');



    Route::resource('/admin/questions', 'Admin\QuestionsController');
});


