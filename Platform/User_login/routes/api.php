<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/member', 'api\MemberController');
Route::apiResource('/announce', 'api\AnnounceController');
Route::get('/coin/{coin}', 'api\CoinController@update');
// Route::post('/member', 'api\MemberController@store');
// Route::get('/member/{member}', 'api\MemberController@update');
