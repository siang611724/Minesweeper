<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DB\Member;
use DB;

class CoinController extends Controller
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
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCoin(Request $request, $id)
    {
        $user = DB::table('users')->where('id',$id)->first();
        // dd($user->name);
        $result = DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'coins' => ($request->coins+$user->coins),
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        }else {
            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '官方補償',
                    'trading_coins' => $request->coins,
                    'balance_coins' => $request->coins+$user->coins,
                ]
            ]);
            return response()->json(['status' => 0, 'message' => 'Success']);
        }
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
