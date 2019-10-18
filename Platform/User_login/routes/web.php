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

// Route::get('/', 'MembersController@index');
// Route::resource('Members', 'MembersController');
Route::get('/', function () {
    return view('welcome');
});
// auth指令自動新增以下
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@coinPurchase');
<<<<<<< HEAD

Route::get('/dailyLogin', 'HomeController@dailyLogin')->name('dailyLogin');

=======
//  測試用路由
Route::get('/dailyLogin', 'HomeController@dailyLogin')->name('dailyLogin');
>>>>>>> a1cb7027d73d4fa55cc319630ff9286f206030ea
Route::resource('user', 'UserController');
