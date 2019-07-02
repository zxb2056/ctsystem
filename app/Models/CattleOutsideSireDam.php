<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleOutsideSireDam extends Model
{
    //
    protected $guarded=['id'];
    public function outsideSire(){
        return $this->hasOne('App\Models\CattleSireDepository','id','sire_id');
    }
    public function outsideDam(){
        return $this->hasOne('App\Models\CattleOutsideDamInfo','id','dam_id');
    }
}
