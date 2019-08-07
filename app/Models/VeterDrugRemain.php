<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeterDrugRemain extends Model
{
    //
    protected $guarded=['id'];
    protected $casts = [
        //字段=>希望转换的类型
        'price' => 'float',
        'remain' => 'float',
    ];
    public function drugname()
    {
        return $this->belongsTo('App\Models\MaterialDrugRepository','drug_id','id');
    }
}
