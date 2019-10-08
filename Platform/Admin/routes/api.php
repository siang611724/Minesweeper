<?php

use Illuminate\Http\Request;
use App\Announce;
use App\Http\Resources\AnnounceResource;

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

Route::apiResource('/announce', 'api\AnnounceController');
// Route::get('/announce', 'api\AnnounceController@store');
