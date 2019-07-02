<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use DB;
use App\User;
use App\Post;
use App\Bulletin;
use App\Video;
use App\Tupian;
use App\Zan;
// use Illuminate\Support\Facades\Redis;



class ClientController extends Controller
{
    //
    public function index(){
        Redis::flushdb();
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
        Redis::setex('index:views',60*60*2,$indexView);
        return $indexView;
        }
    }
    public function about(){

        return view('client.about');
    }
    public function hire(){
        $posts=Post::orderby('id','desc')->where('posttype_id','=','4')->paginate(6);
        return view('client.hire',compact('posts'));
    }
    public function hireDetail(){
        return view('client.zp-01');
    }
    public function news(){
        if(Redis::exists('post:news')){
            $ctnews = Redis::get('post:news');
           return $ctnews;
        } else {
        $posts=Post::orderby('id','desc')->where('posttype_id','=','1')->paginate(10);
        $ctnews =view('client.news',compact('posts'));
        Redis::setex('post:news',60*60*2,$ctnews);
        return $ctnews; 
        }
    }
    public function djfp(){
        if(Redis::exists('post:djfp')){
            $ctdjfp = Redis::get('post:djfp');
           return $ctdjfp;
        } else {
        $posts=Post::orderby('id','desc')->where('posttype_id','=','3')->paginate(10);
        $ctdjfp=view('client.djfp',compact('posts'));
        Redis::setex('post:djfp',60*60*2,$ctdjfp);
        return $ctdjfp;
        }
    }
    public function tech(){
        if(Redis::exists('post:techs')){
            $cttechs = Redis::get('post:techs');
           return $cttechs;
        } else {
        $posts=Post::orderby('id','desc')->where('posttype_id','=','2')->paginate(10);
        $cttechs = view('client.tech',compact('posts'));
        Redis::setex('post:techs',60*60*2,$cttechs);
        return $cttechs;
        }
    }
    public function qyyx(){
        $photos=Tupian::orderby('id','desc')->paginate(10,['*'],'other_page');
        
        
        return view('client.qyyx',compact('photos'));
    }
    public function qyyxVideo(){
        $videos=Video::orderby('id','desc')->paginate(4,['*'],'videoPage');
        return view('client.qyyx2',compact('videos'));
    }
    public function postdetail(Request $request,$news,$id){
        if(Redis::exists('post:postdetail')){
            $ctpostdetail = Redis::get('post:postdetail');
           return $ctpostdetail;
        } else {
       $zans_count = Zan::where('post_id',$id)->count();
       $posts=Post::findorFail($id);
        visits($posts)->increment();
        $posts->load('comments');
        $ctpostdetail= view('client.postdetail',compact('posts','news','zans_count'));
        Redis::setex('post:postdetail',60*60*2,$ctpostdetail);
        return $ctpostdetail;
        }
    }
 }
