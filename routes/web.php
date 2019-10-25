<?php

use Illuminate\Support\Facades\Auth;
// use DB;
use Illuminate\Support\Facades\DB;
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
    return view('/welcome');
});
// auth指令自動新增以下
Auth::routes();
Route::get('/home', function (){
	$id = Auth::id();
    $tradingRecord = DB::table('transaction_records')->where('user_id', $id)->orderBy('trading_date', 'desc')->get();
    return view('home', compact('tradingRecord'));
});
// Route::post('/home', 'HomeController@coinPurchase');

Route::get('/dailyLogin', 'HomeController@dailyLogin')->name('dailyLogin');

Route::resource('/user', 'UserController');

//  管理員路由
Route::get('/adminLogin', 'admin\LoginController@showLoginForm')
->name('admin.login');

Route::get('/admin', function (){
    return view('admin');
});

// Route::post('/adminLogin', 'admin\LoginController@checkAccount');

// Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function() {
// 	Route::get('logout', 'Admin\LoginController@logout')
// 	->name('admin.logout');

// 	Route::get('/', 'Admin\HomeController@index')->name('admin');

// 	// other routes for admin ...

// });

Route::get('/game', 'GameController@showGamePage');
Route::get('wang/{tr}/{td}/{mineNum}','GameController@map');
Route::get('getMap/{MapX}/{MapY}','Play@MouseClickTd');
Route::resource('/wang','GameController');

Route::get('/1', function (){
    return view('index');
});

Route::get('/2', function (){
	$id = Auth::id();
    $tradingRecord = DB::table('transaction_records')->where('user_id', $id)->orderBy('trading_date', 'desc')->get();
    return view('game', compact('tradingRecord'));
});
Route::get('/newmoney','GameController@newmoney');
Route::get('/newmoneyeasy','GameController@newMoneyEasy');
Route::get('/newmoneymed','GameController@newMoneyMed');
Route::get('/newmoneyhard','GameController@newMoneyHard');

Route::get('/showmoney','GameController@showMoney');
Route::get('/getlastmoney','GameController@showMoney');


Route::get('/edit', function (){
    return view('user.edit');
});

