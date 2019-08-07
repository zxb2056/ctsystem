<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Staff extends Model
{
    //
    use SoftDeletes;
    protected $guarded = ['id'];
    public function linkdepart(){
        return $this->belongsToMany('App\Models\Department','department_staff','staff_id','department_id');
    }
    public function wholedepartname()
    {
        return $this->hasMany('App\Models\DepartmentStaff','staff_id','id');
    }

}
