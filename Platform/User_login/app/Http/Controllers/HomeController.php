<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TransactionRecord;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        // $tradingRecord = TransactionRecord::all();
        $tradingRecord = DB::table('transaction_records')->where('user_id', $id)->orderBy('id', 'desc')->get();
        // dd($tradingRecord);
        return view('home', compact('tradingRecord'));
    }

    public function coinPurchase (Request $request) {
        // dd($request->input());
        $id = Auth::id(); // 取得登入者id
        $user = Auth::user();
        $user->coins = $user->coins + $request->input('radios');
        // // dd($user->coins);
        $user->save();

        DB::table('transaction_records')->insert([
            [
                'user_id' => $id, 'user_name' => $user->name, 'trading_type' => '儲值',
                'trading_coins' => $request->input('radios'), 
                'balance_coins' => $user->coins
            ]
        ]);

        return redirect("/home");
    }

    public function dailyLogin()
    {
        $user = Auth::user();
        // 取得最後一筆logs表資料，利用id取得登入紀錄並更新到users表`最後登入時間`
        $lastLogin = DB::table('logs')->orderBy('id', 'desc')->first();
        // dd($lastLogin);
        $login_time = DB::table('logs')->where('id', $lastLogin->id)->value('login_time');
        DB::table('users')->where('id', $user->id)->update(['last_login_time' => $login_time]);
        return view('dailyLogin');
    }
}
