<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
<<<<<<< HEAD:Platform/User_login/app/Http/Controllers/api/storeController.php
use DB;

class StoreController extends Controller
=======
use App\DB\LoginTime;

class LogController extends Controller
>>>>>>> ae8533631d3e4b48d7f4d2ef0655049663229b91:Platform/User_login/app/Http/Controllers/api/LogController.php
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLoginTime($id)
    {
        $log = LoginTime::find($id);
        return response()->json($log);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeCoin(Request $request, $id)
    {
<<<<<<< HEAD:Platform/User_login/app/Http/Controllers/api/storeController.php
        $user = DB::table('users')->where('id', $id)->first();
        $result = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'coins' => $user->coins + $request->radios,
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        }else {
            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '儲值',
                    'trading_coins' => $request->radios,
                    'balance_coins' => $user->coins + $request->radios
                ]
            ]);
            return redirect('/home');
        }
=======
        //
>>>>>>> ae8533631d3e4b48d7f4d2ef0655049663229b91:Platform/User_login/app/Http/Controllers/api/LogController.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
