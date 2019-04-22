<?php

namespace App\Admin\controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_user;
use App\AdminRole;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = Admin_user::paginate(10);
    return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request){
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
        $password=bcrypt($request->password);
        Admin_user::create(compact('username','mobilePhone','email','password'));
        return redirect('/admin/users/index')->with('success','提交成功！');

    }
    public function edit(Request $request,$userid)
    {
       $adminUsers = Admin_user::findOrFail($userid);
        return view('admin.user.update',compact('adminUsers'));
    }
    public function update(Request $request,$userid){
        $adminUser = Admin_user::find($userid);
        $username=$request->username;
        $mobilePhone=$request->mobilePhone;
        $email=$request->email;
        $password=bcrypt($request->password);
        $adminUser->update(compact('username','mobilePhone','email','password'));
        return redirect('/admin/users/index');

    }

    public function delete($userid){
        $adminUser = Admin_user::find($userid);
        $adminUser->delete();
        return redirect()->back();

    }
        //用户角色页面
        public function role(Admin_user $user){
           
            $roles = AdminRole::all();
            $myRoles = $user->roles;
            return view('admin.user.role',compact('roles','myRoles','user'));
        }
        public function storeRole(Admin_user $user)
        {
            $this->validate(request(),[
                'roles' =>'required|array',
            ]);
            $roles = AdminRole::findMany(request('roles'));
            $myRoles = $user->roles;
            //要增加的
            $addRoles = $roles->diff($myRoles);
            foreach($addRoles as $role)
            {
              $user->assignRole($role);  
            }
            //要删除的
            $deleteRoles = $myRoles->diff($roles);
            foreach ($deleteRoles as $role){
                $user->deleteRole($role);
            }
            return back()->with('success','提交成功！');
        }
}
