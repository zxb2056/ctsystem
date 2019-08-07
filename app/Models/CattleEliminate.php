<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleEliminate extends Model
{
    //
    protected $guarded = ['id'];
    public function linkbatch()
    {
        return $this->belongsTo('App\Models\CattleEliminateBatchInfo','cattle_eliminate_batch_info_id','elimiOrder');
    }
}
