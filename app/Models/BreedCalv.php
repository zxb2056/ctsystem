<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedCalv extends Model
{
    //
    protected $guarded=['id'];
    public function linkcattle(){
        return $this->belongsTo('App\Models\Cattle','cow_id','id');
    }

}
