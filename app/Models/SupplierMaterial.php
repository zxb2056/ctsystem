<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierMaterial extends Model
{
    //
    protected $guarded=['id'];
    public function linkcompany()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id','id');
    }
}
