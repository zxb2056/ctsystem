<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    //
    protected $guarded = ['id'];
    //赞的文章
    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
    //赞的用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
