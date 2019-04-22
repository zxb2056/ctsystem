<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    protected $guarded=['id'];
    //评论所属文章
    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
    //评论所属用户
    public function user()
    {
        return $this->belongsTo('App\user','user_id','id');
    }
    //全局scope，对评论进行过滤
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('avalable',function(Builder $builder){
            $builder->whereIn('status',[0,1]);

        });
        
    }
}
