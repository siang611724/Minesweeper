<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Mine;
use App\Map;
use DB;
use Illuminate\Http\Request;
use App\User;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $userID = Auth::id();
        $id = DB::table('Map')->where('MemberID', $userID)
        ->orderBy('GameID','desc')->take(1)->value('GameID');
        
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        $money=$money+50;
        DB::table('users')->where('id',$userID)
        ->update(['coins'=>$money]);

       DB::table('history')->insert([
                'GameID'=>$id,
                'MemberID'=>$userID,
                'result'=>'win'
       ]);
       return $money;
                
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
        //
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
        //
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
    public function map($tr,$td,$mineNum){
        
        $Mine=new Mine($tr,$td,$mineNum);
        $userID = Auth::id();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
       
        
        DB::table('Map')->insert(
            [
                
                'MemberID'=>$userID,
                'Info'=> serialize($Mine->area)
            ]
        );
            
        
        return $Mine->area;
        
    }
    public function newmoney(){
        $userID = Auth::id();
        $user = DB::table('users')->where('id',$userID)->first();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
                $money=$money-5;
        if($money <= 0) {
            return $money;
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money
            ]);

            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '接關',
                    'trading_coins' => 5,
                    'balance_coins' => $user->coins - 5,
                ]
            ]);
        }
        return $money;
    }
    public function newMoneyEasy(){
        $userID = Auth::id();
        $user = DB::table('users')->where('id',$userID)->first();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        $money=$money-5;
        
        if($money <= 0) {
            return $money;
        } else{
            DB::table('users')->where('id',$userID)
            ->update(['coins'=>$money]);

            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '遊玩初級難度',
                    'trading_coins' => 5,
                    'balance_coins' => $user->coins - 5,
                ]
            ]);
        }
        return $money;
    }
    public function newMoneyMed(){
        $userID = Auth::id();
        $user = DB::table('users')->where('id',$userID)->first();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        $money=$money-10;
        if($money <= 0) {
            return $money;
        } else{
            DB::table('users')->where('id',$userID)
            ->update(['coins'=>$money]);

            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '遊玩中級難度',
                    'trading_coins' => 10,
                    'balance_coins' => $user->coins - 10,
                ]
            ]);
        }
        return $money;
    }
    public function newMoneyHard(){
        $userID = Auth::id();
        $user = DB::table('users')->where('id',$userID)->first();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        $money=$money-15;
        if($money <= 0) {
            return $money;
        } else{
            DB::table('users')->where('id',$userID)
            ->update(['coins'=>$money]);

            DB::table('transaction_records')->insert([
                [
                    'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '遊玩高級難度',
                    'trading_coins' => 15,
                    'balance_coins' => $user->coins - 15,
                ]
            ]);
        }
        return $money;
    }
    public function showMoney(){
        $userID = Auth::id();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
       
        return $money;
    }
    
}
