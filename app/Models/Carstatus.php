<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carstatus extends Model
{
    //
    protected $guarded = ['id'];
    public function carinfo(){
        return $this->belongsTo('App\Models\Carinfo');
    }
}
