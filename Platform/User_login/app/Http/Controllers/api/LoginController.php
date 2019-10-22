<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use DB;

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
  function showLoginForm()
  {
    return view('adminLogin');
  }

  /**
   * 修改驗證欄位
   */
  function username()
  {
    return 'name';
  }

  /**
   * 修改驗證時使用的 guard
   */
  protected function guard()
  {
    return \Auth::guard('admin');
  }

  /**
   * 修改登出後的轉址路徑
   */
  public function logout(Request $request)
  {
    $this->guard()->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect('/welcome');
  }

  public function test(Request $request)
  {
    return response()->json([
      'account' => $request->account, 'password' => $request->password
    ]);
    // return redirect('admin');
  }

  public function checkAccount(Request $request)
  {
    $data = $request->all();
    $rules = [
      'account' => 'required | exists:managers,account',
      'password' => 'required | between:8, 20'
    ];
    $message = [
      'required' => '請填寫這個欄位',
      'between' => '密碼必須為8-20位之間',
      'exists' => '查無此管理員'
    ];
    $validator = Validator::make($data, $rules, $message);
    $password = $request->password;
    $adminPassword = DB::table('managers')->where('account', $request->account)->value('password');
    $validator->after(function ($validator) use ($adminPassword, $password) {
      if ($password != $adminPassword) {
        $validator->errors()->add('password', '密碼錯誤');
      }
    });
    if ($validator->fails()) {
      return response()->json(['message' => 'failed', 'errors' => $validator->errors()->messages()]);
      // dd($validator->errors()->messages());
      // return back()->withErrors($validator);
    } 
    else {
      return response()->json(['message' => 'ok', 'data' => $data]);
    }
  }
}
