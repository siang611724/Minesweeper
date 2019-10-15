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
Route::apiResource('/member', 'api\MemberController');
Route::apiResource('/announce', 'api\AnnounceController');
Route::get('/coin/{coin}', 'api\CoinController@update');
// Route::post('/member', 'api\MemberController@store');
// Route::get('/member/{member}', 'api\MemberController@update');
=======
// Route::apiResource('/member', 'api\MemberController');
Route::get('/announce', 'api\AnnounceController@annList');
Route::post('/announce', 'api\AnnounceController@newAnn');
Route::get('/announce/{announce}', 'api\AnnounceController@designAnn');
Route::put('/announce/{announce}', 'api\AnnounceController@updateAnn');
Route::delete('/announce/{announce}', 'api\AnnounceController@delAnn');

Route::get('/member', 'api\MemberController@memberList');
// Route::post('/member', 'api\MemberController@');
Route::get('/member/{member}', 'api\MemberController@designUser');
Route::put('/member/{member}', 'api\MemberController@updatePassword');
Route::delete('/member/{member}', 'api\MemberController@delUser');

Route::get('/coin/{coin}', 'api\CoinController@updateCoin');

Route::get('/trans/{trans}', 'api\TransactionController@userTransList');

Route::put('/ban/{ban}', 'api\StatusController@Ban');
>>>>>>> de53217ebeb0b6e343ef935c566a1e327851e8e5
