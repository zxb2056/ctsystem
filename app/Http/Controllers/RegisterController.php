<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
        return view('register.index');

    }
    //注册行为
    public function register(){
        // dd(request()->input('password'));
        //验证
        $this->validate(request(),[
            'name'=>'required|min:3|unique:users,name',
            'mobilePhone'=>'required|unique:users,mobilePhone|min:11',
            'password'=>'required|min:5|max:10|confirmed',
        ],['name.min'=>'名字最少3个字','mobilePhone.unique'=>'手机号已经存在','password.confirmed'=>'密码二次输入不一致','password.min'=>'密码最小长度5位']);
        $name=request('name');
        $mobilePhone=request('mobilePhone');
        $password=bcrypt(request('password'));
        // dd($password);
        $user=User::create(compact('name','mobilePhone','password'));
        return redirect('/login.html');
        }
}
