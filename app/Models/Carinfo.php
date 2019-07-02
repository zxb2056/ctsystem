<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carinfo extends Model
{
    //
    protected $guarded = ['id'];
    public function status()
    {
        return $this->hasOne('App\Models\Carstatus');
    }
}
