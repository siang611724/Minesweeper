<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/announce', 'api\AnnounceController@annList');
Route::post('/announce', 'api\AnnounceController@newAnn');
Route::get('/announce/{announce}', 'api\AnnounceController@designAnn');
Route::put('/announce/{announce}', 'api\AnnounceController@updateAnn');
Route::delete('/announce/{announce}', 'api\AnnounceController@delAnn');

Route::get('/member', 'api\MemberController@memberList');
Route::post('/member', 'api\MemberController@store');
Route::get('/member/{member}', 'api\MemberController@designUser');
Route::put('/member/{member}', 'api\MemberController@updatePassword');
Route::delete('/member/{member}', 'api\MemberController@delUser');

Route::put('/coin/{coin}', 'api\CoinController@updateCoin');

Route::get('/trans/{trans}', 'api\TransactionController@userTransList');

Route::put('/ban/{ban}', 'api\StatusController@Ban');

Route::get('/logs/{logs}', 'api\LogController@userLoginTime');

Route::put('store/{store}', 'api\StoreController@storeCoin');

Route::post('/adminLogin', 'api\LoginController@checkAccount');
