<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // if (Auth::check()) {
        //     alert("ok");
        // }
    }

    /**
	 * 修改載入的 login 頁面.
	 */
    function showLoginForm() {
		return view('admin');
    }
    
    /**
	 * 修改驗證欄位
	 */
    function username() {
		return 'name';
    }
    
    /**
	 * 修改驗證時使用的 guard
	 */
    protected function guard() {
		return \Auth::guard('admin');
    }
    
    /**
	 * 修改登出後的轉址路徑
	 */
	public function logout(Request $request) {
		$this->guard()->logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/welcome');
	}
}
