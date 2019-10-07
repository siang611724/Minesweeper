<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        return view('home');
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

    public function test()
    {
        return view('test');
    }
}
