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

Route::get('/', function (){
    return view('index');
});

Route::get('wang/{tr}/{td}/{mineNum}','GameController@map');
Route::get('getMap/{MapX}/{MapY}','Play@MouseClickTd');
Route::resource('/wang','GameController');
