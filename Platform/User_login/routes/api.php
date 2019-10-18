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

<<<<<<< HEAD
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('/member', 'api\MemberController');
=======
>>>>>>> a1cb7027d73d4fa55cc319630ff9286f206030ea
Route::get('/announce', 'api\AnnounceController@annList');
Route::post('/announce', 'api\AnnounceController@newAnn');
Route::get('/announce/{announce}', 'api\AnnounceController@designAnn');
Route::put('/announce/{announce}', 'api\AnnounceController@updateAnn');
Route::delete('/announce/{announce}', 'api\AnnounceController@delAnn');
<<<<<<< HEAD
Route::get('/member', 'api\MemberController@memberList');
// Route::post('/member', 'api\MemberController@');
Route::get('/member/{member}', 'api\MemberController@designUser');
Route::put('/member/{member}', 'api\MemberController@updatePassword');
Route::delete('/member/{member}', 'api\MemberController@delUser');
Route::get('/coin/{coin}', 'api\CoinController@updateCoin');
Route::get('/trans/{trans}', 'api\TransactionController@userTransList');
Route::put('/ban/{ban}', 'api\StatusController@Ban');

Route::put('store/{store}', 'api\StoreController@storeCoin');
=======

Route::get('/member', 'api\MemberController@memberList');
Route::post('/member', 'api\MemberController@store');
Route::get('/member/{member}', 'api\MemberController@designUser');
Route::put('/member/{member}', 'api\MemberController@updatePassword');
Route::delete('/member/{member}', 'api\MemberController@delUser');

Route::put('/coin/{coin}', 'api\CoinController@updateCoin');

Route::get('/trans/{trans}', 'api\TransactionController@userTransList');

Route::put('/ban/{ban}', 'api\StatusController@Ban');
<<<<<<< HEAD
>>>>>>> a1cb7027d73d4fa55cc319630ff9286f206030ea
=======

Route::get('/logs/{logs}', 'api\LogController@userLoginTime');
>>>>>>> ae8533631d3e4b48d7f4d2ef0655049663229b91
