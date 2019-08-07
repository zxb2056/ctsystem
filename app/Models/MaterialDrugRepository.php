<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialDrugRepository extends Model
{
    //
    protected $guarded=['id'];
    public function type()
    {
        return $this->belongsTo('App\Models\MaterialDrugType','drugType','id');
    }
    // 查询兽医处的库存
    public function veter_remain()
    {
        return $this->hasMany('App\Models\VeterDrugRemain','drug_id','id');
    }
    // 查询公司所余的库存
    public function company_remain()
    {
        return $this->hasMany('App\Models\MaterialDrugRemain','drug_id','id');
    }
}
