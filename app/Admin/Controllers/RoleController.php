<?php
namespace App\Admin\controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminRole;

class RoleController extends Controller
{
    //角色列表页面
    public function index(){
        $roles = AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    //角色创建页面
    public function create(){

        return view('admin.role.add');
    }
    //创建角色行为
    public function store(){
       $this->validate(request(),[
           'name'=>'required|min:3',
           'description'=>'required',
       ],[
           'name.min'=>'名称最少3个字符',
           'description'=>'描述不能为空',
       ]);
       AdminRole::create(request(['name','description']));
        return redirect('/admin/roles/index')->with('success','提交成功！');
    }
    public function update(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ],[
            'name.min'=>'名称最少3个字符',
            'description'=>'描述不能为空',
        ]);
        $role=AdminRole::find(request('id'));
        $data=Request()->all();
        $role->update($data);
        return redirect()->back()->with('success','提交成功！');

    }
    public function deleterole($roleid){
        $adminUser = AdminRole::find($roleid);
        $adminUser->delete();
        return redirect()->back();
    }
    // 角色和权限的关系页面
    public function permission(AdminRole $role){
        //获取所有权限
        $permissions = \App\AdminPermission::all();

        //获取当前角色的权限
        $myPermissions = $role->permissions;
        return view('admin.role.permission',compact('permissions','myPermissions','role'));
    }
    //储存角色权限的行为
    public function storePermission(AdminRole $role){
        $this->validate(request(),[
            'permissions'=>'required|array',
        ],[
           'permissions.required'=>'最少选择一个权限',
        ]);
        $permissions = \App\AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        //要增加的
        $addPermissions = $permissions->diff($myPermissions);
        foreach($addPermissions as $permission)
        {
          $role->grantPermission($permission);  
        }
        //要删除的
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission){
            $role->deletePermission($permission);
        }
        return back()->with('success','提交成功！');
    }

}
