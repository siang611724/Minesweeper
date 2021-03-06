<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DB\Member;
use DB;
use Hash;
use App\TransactionRecord;
use Illuminate\Support\Facades\Auth;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function memberList()
    {
        $member = Member::all();
        return response()->json($member);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $register = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->reg_email,
            'password' => Hash::make($request->reg_password)
        ]);
        // $this->guard()->login($register);
        if (!$register) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        } else {
            return redirect('/home');
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function designUser($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {   
        // 驗證格式
        $validator = Validator::make($request->all(), [
            'password' => 'alpha_dash'
        ],
        [
            'alpha_dash' => '密碼僅能輸入數字、英文字母'
        ]);
        if($validator->fails()){
            return response()->json(['errorMsg' => 'numberOnly', 'error' => $validator->errors()->all()]);
        }
        
        $result = DB::table('users')
                    ->where('id',$id)
                    ->update([  
                        'password' => Hash::make($request->password),
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        }else {
            return response()->json(['status' => 0, 'message' => 'Success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delUser($id)
    {
        $member = Member::find($id);
        if ($member != null){
            $member->delete();
            return response()->json(null,204);
        } else {
            return response()->json(['message' => 'Wrong ID']);
        }
    }

}
