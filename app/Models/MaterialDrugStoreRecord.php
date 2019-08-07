<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialDrugStoreRecord extends Model
{
    //
    protected $guarded=['id'];
    public function linkdrug()
    {
        return $this->belongsTo('App\Models\MaterialDrugRepository','drug_id','id');
    }
    public function linkremain()
    {
        return $this->hasOne('App\Models\MaterialDrugRemain','drug_store_id','id');
    }
}
