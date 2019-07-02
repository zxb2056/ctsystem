<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedMateRecord extends Model
{
    //
    protected $guarded=['id'];
    public function linksemen(){
        return $this->belongsTo('App\Models\SemenInfo','semen_id','id');

    }
    public function linkcow(){
        return $this->belongsTo('App\Models\Cattle','cow_id','id');
    }
    public function linkcalv(){
        return $this->hasMany('App\Models\BreedCalv','cow_id','cow_id');
    }

}
