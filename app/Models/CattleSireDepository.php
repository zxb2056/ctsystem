<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleSireDepository extends Model
{
    //
    protected $guarded=['id'];
    
    public function nationmap(){
        return $this->belongsTo('\App\Model\Nation','nation','id');
    }
    public function breedVariety()
    {
        return $this->belongsTo('App\Models\CattleBreedVariety','breedType','id');
    }
    public function company(){
        return $this->belongsTo('App\Models\CompanyBreeding','belongToCompany','id');
    }
}
