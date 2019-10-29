<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class StoreController extends Controller
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
    public function storeCoin (Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'cardNum' => 'required | regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
            'CVV' => 'required | regex:/^\d{3}$/',
            'cardMonth' => 'in:01,02,03,04,05,06,07,08,09,10,11,12',
            'cardYear' => 'in:2019,2020,2021,2022,2023'
        ];
        $message = [
            'required' => '欄位不能為空',
            'regex' => '信用卡號或安全碼輸入錯誤',
            'in' => '請填寫信用卡到期日'
        ];
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user = DB::table('users')->where('id', $id)->first();
        $result = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'coins' => $user->coins + $request->coins,
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        } else {
            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '儲值',
                    'trading_coins' => $request->coins,
                    'balance_coins' => $user->coins + $request->coins
                ]
            ]);
            return response()->json(['status' => 0, 'message' => 'Success', 'money' => $request->coins, 
                                    'balance' => $user->coins + $request->coins,
                                    'result' => $request->all()]);
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
