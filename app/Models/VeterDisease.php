<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeterDisease extends Model
{
    //
    protected $guarded=['id'];
    public function linkcattle()
    {
        return $this->belongsTo('App\Models\Cattle','cattleID','cattleID');
    }
    
}
