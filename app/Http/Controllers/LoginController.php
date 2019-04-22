<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view('register.login');
    }
    //登陆行为
    public function login()
    {
        //validate
        $this->validate(request(),[
            'mobilePhone'=>'required',
            'password'=>'required',
            'is_remember'=>'integer',
        ]);
        //action
           $user =request(['mobilePhone','password']);
            $is_remember = boolval(request('is_remember'));
            if(\Auth::attempt($user,$is_remember)){
               return redirect('/user/me/setting');
            }
        //render
            return redirect()->back()->withErrors("手机密码不匹配。");
    }
    //登出行为
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
