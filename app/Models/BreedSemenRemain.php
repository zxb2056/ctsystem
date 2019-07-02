<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedSemenRemain extends Model
{
    //
    protected $guarded=['id'];
    public function linksemen(){
        return $this->belongsTo('App\Models\SemenInfo','semen_id','id');
    }
}
