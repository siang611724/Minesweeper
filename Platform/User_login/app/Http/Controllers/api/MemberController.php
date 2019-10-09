<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DB\Member;
use App\Http\Resources\MemberResource;
use App\Http\Resources\MemberResourceCollection;
use DB;
use Hash;
use App\TransactionRecord;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::all();
        return new MemberResourceCollection($member);
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
        $member = Member::find($id);
        return new MemberResource($member);
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
        $user = DB::table('users')->where('id',$id)->first();
        // dd($user->name);
        $result = DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'password' => Hash::make($request->password),
                        'coins' => $request->coins,
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        }else {
            
            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '官方補償',
                    'trading_coins' => $request->input('coins') - $user->coins,
                    'balance_coins' => $user->coins + ($request->input('coins') - $user->coins),
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
        $member = Member::find($id);
        if ($member != null){
            $member->delete();
            return response()->json(null,204);
        }else {
            return response()->json(['message' => 'Wrong ID']);
        }
    }
}
