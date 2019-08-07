<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleChangeBarnHistory extends Model
{
    //
    protected $guarded=['id'];
    public function linkcattle()
    {
        return $this->belongsTo('App\Models\Cattle','cattle_id','id');
    }
}
