<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    // protected $fillable = ['title','content','admin_user_id','posttype_id','lunboLink','lunboTitle','lunboCaption'];
    protected $guarded = ['id'];
    //关联用户
    public function user(){
        return $this->belongsTo('App\Admin_user','admin_user_id','id');
    }
    //评论模型
    public function comments(){
        return $this->hasMany('App\Comment','post_id','id')->orderBy('created_at','desc');
    }
    //和用户进行关联zan
    public function zan($user_id)
    {
        return $this->hasOne('\App\Zan','post_id','id')->where('user_id',$user_id);
    }
    //文章的所有赞
    public function zans()
    {
        return $this->hasMany('\App\Zan','post_id','id')->orderBy('created_at', 'desc');
    }
    //所属文章类型
    public function posttype()
    {
        return $this->belongsTo('\App\Posttype','posttype_id','id');
    }
}
