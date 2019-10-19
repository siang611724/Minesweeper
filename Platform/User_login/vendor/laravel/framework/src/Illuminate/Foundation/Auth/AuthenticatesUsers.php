<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Log;
use Carbon\Traits\Timestamp;
use DB;
use Validator;
use Illuminate\Support\MessageBag;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('home');
        // return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            $user = Auth::user();
            // if ($user->name === 'Admin') {
            //     return view('admin');
            // };

            // 取得使用者最後登入時間
            $last_login_time = DB::table('users')->where('id', $user->id)->value('last_login_time');
            $last_login_daysofyear = date('z', strtotime($last_login_time));    // 一年中第幾天
            $last_login_year = date('Y', strtotime($last_login_time));  // 取得年份

            DB::table('logs')->insert([
                ['user_id' => $user->id, 'user_name' => $user->name ]
            ]);

            $id = DB::getPdo()->lastInsertId(); // 取得最近登入（插入）的那筆資料id
            // 取得最新登入的時間
            $login_time = DB::table('logs')->where('id', $id)->value('login_time');
            $login_daysofyear = date('z', strtotime($login_time));  // 取得一年中第幾天
            $login_year = date('Y', strtotime($login_time));    // 取得年份
            // 判斷是否上次登入時間不是今天(代表當日首次登入)
            if($login_daysofyear != $last_login_daysofyear || $login_year != $last_login_year) {
                $user->coins = $user->coins + 10;
                $user->save();

                DB::table('transaction_records')->insert([
                    [
                        'user_id' => $user->id, 'user_name' =>$user->name, 'trading_type' => '每日登入',
                        'trading_coins' => '10', 'balance_coins' => $user->coins
                    ]
                ]);

                return redirect('/dailyLogin');
            }

            // 最後才更新使用者最後登入時間為最新登入時間
            DB::table('users')->where('id', $user->id)->update(['last_login_time' => $login_time]);

            return $this->sendLoginResponse($request);
        }

        // $data = $request->all();
        // // dd($data);
        // $rules = [
        //     'email' => 'required | between:8, 20 | exists:users,email' ,
        //     'password' => 'required | between:8, 20'
        // ];
        // $message = [
        //     'required' => '請填寫此欄位',
        //     'between' => '密碼必須為8-20位之間',
        //     'exists' => '此用戶不存在'
        // ];
        // $validator = Validator::make($data, $rules, $message);
        // $email = $request->input('email');
        // $password = $request->input('password');
        // $userPassword = DB::table('users')->where('email', $email)->value('password');
        // $validator->after(function($validator) use ($userPassword, $password) {
        //     if(!\Hash::check($password, $userPassword)) {
        //         $validator->errors()->add('password', '密碼錯誤');
        //     }
        // });
        // if($validator->fails()) {
        //     // dd($validator->errors()->messages());
        //     return back()->withErrors($validator);
        // }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
