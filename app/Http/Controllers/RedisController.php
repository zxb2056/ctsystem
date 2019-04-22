<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Post;
use DB;
use App\Bulletin;

class RedisController extends Controller
{
    //
    public function testRedis()
    {
        // Redis::FLUSHDB();
        // Redis::set('name', 'guwenjie');
        // $values = Redis::get('name');
        // dd($values);
        //输出："guwenjie"
        //加一个小例子比如网站首页某个人员或者某条新闻日访问量特别高，可以存储进redis，减轻内存压力
        // $userinfo = Member::find(1200);
        // Redis::set('user_key',$userinfo);
        // if(Redis::exists('user_key')){
        //     $values = Redis::get('user_key');
        // }else{
        //     $values = Member::find(1200);//此处为了测试你可以将id=1200改为另一个id
        //  }
        // dump($values);
        // if ($posts = Redis::get('posts.all')) {
        //     return view('client.index',compact('posts'));
        // }
        

        // get all post
        // if(Redis::exists('index:news')){
        //     $news=Redis::get('index:news');
        //     // return json_decode($news);
        // } else{
        //     $news=Post::orderby('id','desc')->where('posttype_id','=','1')->take(6)->get();
        //     Redis::setex('index:news',60 * 60 * 24,$news);
        // }
        // if(Redis::exists('index:techs')){
        //     $techs=Redis::get('index:techs');
        //     $techs=json_decode($techs);
            
        // } else {
        //     $techs=Post::orderby('id','desc')->where('posttype_id','=','2')->take(6)->get();
        //     Redis::setex('index:techs',60 * 60 * 24,$techs);
        // }
        
        // if(Redis::exists('index:partys')){
        //     $partys=Redis::get('index:partys');
        //     $partys = json_decode($partys);
            
        // } else {
        //     $partys=Post::orderby('id','desc')->where('posttype_id','=','3')->take(6)->get();
        //     Redis::setex('index:partys',60 * 60 * 24,$partys);
        // }
        // if(Redis::exists('index:lunbolinks')){
        //     $posts=Redis::get('index:lunbolinks');
        //     $posts = json_decode($posts);
        // } else {
        //     $posts = DB::select('select * from posts where lunboLink != ? order by id desc limit 3',[""]);
        //     Redis::setex('index:lunbolinks',60 * 60 * 24,serialize($posts));
        // }
        // if(Redis::exists('index:bulletins')){
        //     $bulletins = Redis::get('index:bulletins');
        //     $bulletins = json_decode($bulletins);
        // } else {
        //     $bulletins= Bulletin::orderby('id','desc')->take(1)->get();
        //     Redis::setex('index:bulletins',60 * 60 * 24,$bulletins);
        // }
        if(Redis::exists('index:views')){
                $indexView = Redis::get('index:views');
               return $indexView;
            } else {
                $news=Post::orderby('id','desc')->where('posttype_id','=','1')->take(6)->get();
                $techs=Post::orderby('id','desc')->where('posttype_id','=','2')->take(6)->get();
                $partys=Post::orderby('id','desc')->where('posttype_id','=','3')->take(6)->get();
                $posts = DB::select('select * from posts where lunboLink != ? order by id desc limit 3',[""]);
                $bulletins= Bulletin::orderby('id','desc')->take(1)->get();
                $indexView = view('client.index',compact('news','techs','partys','posts','bulletins'));
                Redis::setex('index:views',60*60*1,$indexView);
                return $indexView;
                
            }
        
    }


}
