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
        $user = Auth::user();
        $Gameid = DB::table('Map')->where('MemberID',$user)
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
        
        // $money = DB::table('money')->where('MemberID','jack')
        //         ->value('money');
        // DB::table('money')->update([
        //     'money'=>$money-5
        // ]);
        $user = Auth::user();

        DB::table('Map')->insert(
            [
                'MemberID'=>$user,
                'Info'=> serialize($Mine->area)
            ]
        );
            
        
        return $Mine->area;
        
    }
}
