<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as IlluminateValidator;
// use Illuminate\Support\Facades\Validator;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // $rules = [
        //     'name_reg' => 'required',
        //     'email_reg' => 'required | email | unique:users,email',
        //     'password_red' => 'required | between:8, 20 | confirmed',
        // ];

        // $message = [
        //     'required' => '請填寫此欄位',
        //     'email' => '請符合email格式',
        //     'unique' => '此信箱已被使用過',
        //     'between' => '密碼必須為8-20位之間',
        //     'confirmed' => '密碼與確認新密碼不匹配'
        // ];

        // $validator = Validator::make($data, $rules, $message);

        // $validator = Validator::make($data, [
        //     'name_reg' => ['required'],
        //     'email_reg' => ['required', 'email', 'unique:users,email'],
        //     'password_reg' => ['required', 'between:8, 20', 'confirmed'],
        // ]);

        // if($validator->fails()) {
        //     return back()->withErrors($validator);
        // };

        return Validator::make($data, [
            'name_reg' => ['required'],
            'email_reg' => ['required', 'email', 'unique:users,email'],
            'password_reg' => ['required', 'between:8, 20', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name_reg'],
            'email' => $data['email_reg'],
            'password' => Hash::make($data['password_reg']),
        ]);
    }
}
