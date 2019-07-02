<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleSireInfo extends Model
{
    //
    protected $guarded = ['id'];
    public function nation(){
        return $this->belongsTo('\App\Model\Nation','nation_id','id');
    }
}
