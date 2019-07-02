<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemenInfo extends Model
{
    //
    protected $guarded = ['id'];
    public function linkcompany(){
        return $this->belongsTo('App\Models\CompanyBreeding','company','id');
    }
    public function linkBreedSemenRemain(){
        return $this->hasOne('App\Models\BreedSemenRemain','semen_id','id');
    }
    public function linkbreed(){
        return $this->belongsTo('App\Models\CattleBreedVariety','breed','id');
    }
}
