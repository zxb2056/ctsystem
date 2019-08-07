<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CattleToSlaughter extends Model
{
    //
    protected $guarded = ['id'];
    public function linkbatch()
    {
        return $this->belongsTo('App\Models\CattleSellBatchInfo','cattle_sell_batch_info_id','batchOrder');
    }
}
