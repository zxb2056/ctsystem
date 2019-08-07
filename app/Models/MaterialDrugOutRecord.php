<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialDrugOutRecord extends Model
{
    //
    protected $guarded=['id'];
    public function linkdrug()
    {
        return $this->belongsTo('App\Models\MaterialDrugRepository','drug_id','id');
    }
}
