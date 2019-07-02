<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
    //
    protected $guarded = ['id'];
    public function breedVariety()
    {
        return $this->belongsTo('App\Models\CattleBreedVariety','whichBreed','id');
    }
    //牛号与牛舍属于多对一的关系。属于远层多对一的关系。因为两个表本来可以直接连接，但是为了减少cattle表的写次数，通过中间表来发动牛舍号。
    public function barns(){
        return $this->belongsTo('App\Models\CattleBarnMapIndividual','id','cattle_id');
    }
    // 链接产犊记录表,一对多,一头牛有多个产犊记录
    public function linkcalv(){
        return $this->hasMany('App\Models\BreedCalv','cow_id','id');
    }
    public function linkmaterecord(){
        return $this->hasMany('App\Models\BreedMateRecord','cow_id','id');
    }
    public function eligiblemate(){
        return $this->hasOne('App\Models\BreedMateRecord','cow_id','id');
    }
}
