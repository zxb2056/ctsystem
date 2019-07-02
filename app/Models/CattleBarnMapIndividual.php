<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleBarnMapIndividual extends Model
{
    //
    protected $guarded = ['id'];
    public function cattles(){
        return $this->hasMany('App\Models\Cattle','cattle_id','id');
    }
    public function linkbarns(){
        return $this->belongsTo('App\Models\CattleBarn','barn_id','id');
    }
}
