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
        
       DB::table('history')->where('GameID',$Gameid)
       ->orderBy('time','desc')->take(1)->update([
        'result'=>'win'
       ]);
       return 'ok';
                
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
        if($money == 0) {
            echo '請儲值';
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money-5
            ]);
        }
        
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
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        if($money == 0) {
            return $money;
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money-5
            ]);
        }
        return $money;
    }
    public function newMoneyEasy(){
        $userID = Auth::id();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        if($money == 0) {
            return $money;
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money-5
            ]);
        }
        return $money;
    }
    public function newMoneyMed(){
        $userID = Auth::id();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        if($money == 0) {
            return $money;
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money-10
            ]);
        }
        return $money;
    }
    public function newMoneyHard(){
        $userID = Auth::id();
        $money = DB::table('users')->where('id',$userID)
                ->value('coins');
        if($money == 0) {
            return $money;
        } else {
            DB::table('users')->where('id',$userID)
            ->update([
                'coins'=>$money-20
            ]);
        }
        return $money;
    }
}
