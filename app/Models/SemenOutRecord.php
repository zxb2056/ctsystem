<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemenOutRecord extends Model
{
    //
    protected $guarded = ['id'];
    public function linksemen(){
        return $this->belongsTo('App\Models\SemenInfo','semen_id','id');
    }
    public function linkPIC(){
        return $this->belongsTo('App\Models\Staff','PIC','id');
    }
    public function linkuser(){
        return $this->belongsTo('App\Models\Staff','user','id');
    }
}
