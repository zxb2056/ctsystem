<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeterAntiepidemic extends Model
{
    //
    protected $guarded=['id'];
    public function linkcattle()
    {
        return $this->hasOne('App\Models\Cattle','id','cattle_id');
    }
    public function epidemic_name()
    {
        return $this->hasOne('App\Models\VeterAntiepidemicType','id','epidemic_type');
    }
    public function drug_name()
    {
        return $this->hasOne('App\Models\MaterialDrugRepository','id','drug_id');
    }
}
