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

Route::get('/dailyLogin', 'HomeController@dailyLogin')->name('dailyLogin');

Route::resource('user', 'UserController');

// Route::get('/login', function () {
//     return view('admin');
// });

//  管理員路由
Route::get('admin/login', 'Admin\LoginController@showLoginForm')
->name('admin.login');

Route::post('admin/login', 'Admin\LoginController@login');

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function() {
	Route::get('logout', 'Admin\LoginController@logout')
	->name('admin.logout');

	Route::get('/', 'Admin\HomeController@index')->name('admin');

	// other routes for admin ...

});
