<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $registerUser = Auth::user();

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        date_default_timezone_set('Asia/Taipei');
        $datetime = date('Y-m-d H:i:s');

        $user->coins = $user->coins + 10;
        $user->save();

        DB::table('users')->where('id', $user->id)->update([
            'last_login_time' => $datetime
        ]);

        DB::table('logs')->insert(['user_id' => $user->id, 'user_name' => $user->name]);

        DB::table('transaction_records')->insert([
            [
                'user_id' => $user->id, 'user_name' => $user->name, 'trading_type' => '每日登入',
                'trading_coins' => '10', 'balance_coins' => $user->coins
            ]
        ]);

        return redirect('/dailyLogin');
    }
}
