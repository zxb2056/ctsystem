<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleBarn extends Model
{
    //
    protected $guarded = ['id'];
    public function pic()
    {
        return $this->hasOne('App\Models\Staff','id','PIC');
    }
    public function cattles(){
        return $this->hasMany('App\Models\Cattle','barn_id','id');
    }
    // 牛舍一对多个牛号。远层一对多。
    public function cattleTerminal(){
        return $this->hasManyThrough('App\Models\Cattle',
        'App\Models\CattleBarnMapIndividual',
        'barn_id',
        'cattle_id',
        'barnID',
        'id');
    }
}
