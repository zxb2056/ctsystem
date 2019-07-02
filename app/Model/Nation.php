<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    //
    public function sireNation(){
        return $this->hasMany('\App\Models\CattleSireInfo','id','nation_id');
    }
    public function localSireNation(){
        return $this->hasMany('\App\Models\CattleSireDepository','id','nation');
    }
}
