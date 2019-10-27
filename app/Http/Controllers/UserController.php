<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tradingRecord = DB::table('transaction_records')->where('user_id', $id)->orderBy('id', 'desc')->get(); 
        return view('user.edit', compact('tradingRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'oldPass' => 'required | between:8, 20',
            'newPass' => 'required | between:8, 20 | confirmed'
        ];
        $message = [
            'required' => '密碼不能為空',
            'between' => '密碼必須為8-20位之間',
            'confirmed' => '新密碼與確認新密碼不匹配'
        ];
        $validator = Validator::make($data, $rules, $message);
        $tradingRecord = DB::table('transaction_records')->where('user_id', $id)->orderBy('id', 'desc')->get(); 
        $oldPassword = $request->input('oldPass');
        $newPassword = $request->input('newPass');
        $res = Auth::user()->password;
        // $res = DB::table('users')->where('id', $id)->select('password')->first();
        // dd($res->password);
        $validator->after(function($validator) use ($oldPassword, $res) {
            if(!\Hash::check($oldPassword, $res)){
                $validator->errors()->add('oldPass', '原密碼錯誤');
            } 
        });
        if($validator->fails()) {
            // dd($validator->errors()->messages()['oldPass'][0]);
            return back()->withErrors($validator);
        }
        
        DB::table('users')->where('id', $id)->update(['password' => bcrypt($newPassword)]);
        return redirect('/home')->with('alertPW', '密碼修改成功');
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
