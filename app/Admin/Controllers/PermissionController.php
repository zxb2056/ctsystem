<?php

namespace App\Admin\controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminPermission;

class PermissionController extends Controller
{
    //权限列表页面
    public function index(){
        $permissions = \App\AdminPermission::paginate(10);
        return view('admin.permission.index',compact('permissions'));
    }
    //创建权限页面
    public function create(){
        //使用模态框，不再使用单独的页面
    }
    // 创建权限的行为
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ],[
            'name.min'=>'名称最少3个字符',
            'description'=>'描述不能为空',
        ]);
        AdminPermission::create(request(['name','description']));
         return redirect('/admin/permissions/index')->with('success','提交成功！');

    }
    public function update(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ],[
            'name.min'=>'名称最少3个字符',
            'description'=>'描述不能为空',
        ]);
        $permission=AdminPermission::find(request('id'));
        $data=Request()->all();
        $permission->update($data);
        return redirect()->back()->with('success','提交成功！');
    }

}
