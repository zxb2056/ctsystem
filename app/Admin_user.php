<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Admin_user extends Authenticatable
{
    use SoftDeletes;
    //
    protected $guarded=['id'];
    //设置日期格式

    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','admin_user_id','role_id')->withPivot(['admin_user_id','role_id']);
    }
    //判断是有某个角色，某些角色
    public function isInRoles($roles)
    {
        //两个感叹号转换成bool类型
        //intersect,计算交集
        
        return !! $roles->intersect($this->roles)->count();
    }
    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }
    //取消用户分配的角色
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }
    //判断 用户是否有权限
    public function hasPermission($permission)
    {
        
        return $this->isInRoles($permission->roles);
    }
}
