<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin_user;


class AdminController extends Controller
{
    //

    public function index(){
        //如果文章类型表为空，则自动填充数据
        // $emp=DB::select('select 1 from `posttypes`');
        // if(empty($emp)){
        //     DB::insert('insert into posttypes (name) values ("新闻动态"),("专业技术"),("党建扶贫"), ("人才招聘")');
        // }
        // $emp=DB::select('select 1 from `cattle_breed_varieties`');
        // if(empty($emp)){
        //     DB::insert('insert into cattle_breed_varieties (name) values ("安格斯"),("西门塔尔"),("夏洛来"), ("利木赞"),("和牛"),("秦川牛"),("南阳牛"),("夏南牛"),("荷斯坦奶牛"),("西杂牛")');
        // }
        return view('admin.index');
    }
   
    public function loginview(){
        $emp=DB::select('select 1 from `admin_users`');
        if(empty($emp)){
            return view('admin.user.register');
        }
        else{
            return view('admin.user.login');
        }
   
    }
    
    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'is_remember'=>'integer',
        ]);
        $user =request(['username','password']);
        $is_remember = boolval(request('is_remember'));
        if(\Auth::guard('admin')->attempt($user,$is_remember)){
            return redirect('/admin');
         }
     //render
         return redirect()->back()->withErrors("用户名或密码有错误。");
    
       
    }
    public function register(Request $request){
        $this->validate($request,[
            'username'=>'required|string|max:15|min:2',
            'password'=>'required|string|min:6|confirmed',
        ],[
            'username.min'=>'名字最少2个字符',
            'password.min'=>'密码长度最少6位',
            'password.confirmed'=>'二次密码不一致',
        ]);
        $username=$request->username;
        $mobilePhone=$request->mobilePhone;
        $email=$request->email;
        $isSuperAdmin=1;
        $password=bcrypt($request->password);
        Admin_user::create(compact('username','mobilePhone','email','isSuperAdmin','password'));
        return redirect('/admin');

    }
    public function logout(){
        \Auth::logout();
        return redirect('/');
    }
    
}
