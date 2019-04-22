<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posttype extends Model
{
    //
    protected $guarded=['id'];

    // public function posts(){
    //     return $this->hasMany('App\Post','id','posttype_id');
    // }
}
