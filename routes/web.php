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
//Route::get('/stores', 'HomeController@stores');

//Route::get('/stores/{type}', 'HomeController@store')->where('type', 'magnum|small|anvar|dina');



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
    Route::post('/checks', 'Admin\ChecksController@store');
    Route::get('/profile', 'HomeController@profile');

    Route::get('/get-logout', 'Auth\LoginController@logout');
});



Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin', 'Admin\AdminController@index');
    Route::get('/admin/dashboard', 'Admin\AdminController@index');
    Route::get('/admin/settings', 'Admin\AdminController@settings');
    Route::post('/timezone', 'Admin\AdminController@timezone');
    Route::post('/date', 'Admin\AdminController@date');


    Route::get('/admin/users', 'Admin\UsersController@index');
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


//Route::get('mail', function () {
//    $question = new \App\Question();
//    $question->question = "test";
//    $question->name = "Yernat";
//    $question->email = "ernat.31.07.97@gmail.com";
//    $question->phone = "+77079682878";
//    $question->answer = "qweqwe";
//    return new App\Mail\QuestionCreated($question);
//});
//Route::get('/setTypes', function(){
//    $faqs = \App\Faq::all();
//
//    foreach ($faqs as $faq){
//        $faq->type = "magnum";
//        $faq->save();
//    }
//
//});
