<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattlePedigree extends Model
{
    //
    protected $guarded = ['id'];
    public function cattlesire(){
        return $this->hasOne('App\Models\CattleSireDepository','id','sire_id');
    }
    public function cattledam(){
        return $this->hasOne('App\Models\Cattle','id','dam_id');
    }

}
