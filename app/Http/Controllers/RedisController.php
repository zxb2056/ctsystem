<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Post;
use DB;
use App\Bulletin;
use Artisan;
use App\Models\Cattle;
use App\Models\BreedPregnancyCheck;
use App\Models\BreedFanzhiYearlyPlan;
use App\Models\BreedMateRecord;
use App\Models\BreedFanzhiMonthPlan;
use App\Models\BreedCalv;
use App\models\BreedAftercare;
use App\Models\BreedFanzhiMonthReport;

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
    public function artisan_list(){
        // Artisan::call('route:list');
        // dd(Artisan::output());
        echo (dirname(__FILE__)),"\n"; 
        echo "<br/>";
        echo dirname(dirname(dirname(__FILE__))); 
        $date=date('Y',strtotime('-1 year'));
        echo "<br/>";
        // dd(date('Y-m-d',strtotime($date.'-01-01 -18 month')));
        echo $date;
        // 先取出有配种日期在1月的牛只
        // DB::connection()->enableQueryLog();
            //     $lastAdult1=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-01-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-01-01','2018-01-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult2=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-02-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-02-01','2018-02-29'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult3=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-03-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-03-01','2018-03-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult4=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-04-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-04-01','2018-04-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult5=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-05-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-05-01','2018-05-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult6=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-06-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-06-01','2018-06-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult7=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-07-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-07-01','2018-07-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult8=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-08-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-08-01','2018-08-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult9=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-09-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-09-01','2018-09-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult10=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-10-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-10-01','2018-10-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult11=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-11-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-11-01','2018-11-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastAdult12=Cattle::where('birthday','<',date('Y-m-d',strtotime('2018-12-01 -18 month')))->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-12-01','2018-12-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count(); 
            // //     $logs = DB::getQueryLog();
            //     // dd($logs);
            //     echo "<pre>去年受胎情况</pre>";
            //     for($i=1;$i<13;$i++){
            //         echo ",";
            //         echo ${'lastAdult'.$i};
            //     }
            //     echo "<br/>";
            //     $youthdate=date('Y-m-d',strtotime('2018-02-01 -18 month'));
            //     // dd($youthdate);
            //     $lastYouth1=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-01-01 -18 month')),date('Y-m-d',strtotime('2018-01-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-01-01','2018-01-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth2=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-02-01 -18 month')),date('Y-m-d',strtotime('2018-02-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-02-01','2018-02-29'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth3=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-03-01 -18 month')),date('Y-m-d',strtotime('2018-03-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-03-01','2018-03-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth4=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-04-01 -18 month')),date('Y-m-d',strtotime('2018-04-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-04-01','2018-04-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth5=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-05-01 -18 month')),date('Y-m-d',strtotime('2018-05-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-05-01','2018-05-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth6=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-06-01 -18 month')),date('Y-m-d',strtotime('2018-06-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-06-01','2018-06-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth7=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-07-01 -18 month')),date('Y-m-d',strtotime('2018-07-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-07-01','2018-07-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth8=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-08-01 -18 month')),date('Y-m-d',strtotime('2018-08-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-08-01','2018-08-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth9=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-09-01 -18 month')),date('Y-m-d',strtotime('2018-09-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-09-01','2018-09-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth10=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-10-01 -18 month')),date('Y-m-d',strtotime('2018-10-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-10-01','2018-10-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth11=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-11-01 -18 month')),date('Y-m-d',strtotime('2018-11-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-11-01','2018-11-30'])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $lastYouth12=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2018-12-01 -18 month')),date('Y-m-d',strtotime('2018-12-01 -6 month'))])->wherehas('linkmaterecord',function($query){
            //         $query->whereBetween('mateDate',['2018-12-01','2018-12-31'])->where('pregCheckResult','怀孕');
            //         })->get()->count(); 
            //         for($i=1;$i<13;$i++){
            //             echo ",";
            //             echo ${'lastYouth'.$i};
            //         }   
            //         echo "<br/>";
            //         $lastSum1=$lastAdult1+$lastYouth1;
            //         $lastSum2=$lastAdult2+$lastYouth2;
            //         $lastSum3=$lastAdult3+$lastYouth3;
            //         $lastSum4=$lastAdult4+$lastYouth4;
            //         $lastSum5=$lastAdult5+$lastYouth5;
            //         $lastSum6=$lastAdult6+$lastYouth6;
            //         $lastSum7=$lastAdult7+$lastYouth7;
            //         $lastSum8=$lastAdult8+$lastYouth8;
            //         $lastSum9=$lastAdult9+$lastYouth9;
            //         $lastSum10=$lastAdult10+$lastYouth10;
            //         $lastSum11=$lastAdult11+$lastYouth11;
            //         $lastSum12=$lastAdult12+$lastYouth12;
            //         for($i=1;$i<13;$i++){
            //             echo ",";
            //             echo ${'lastSum'.$i};
            //         }  
            // // 根据结果的牛只id,查找孕检表中wherein,且牛只孕检日期大于这个日期的第一条数据, 且为怀孕状态,否则不符合条件.
            // // 考虑后来流产的情况,怎么办?有流产情况自己减少相应数量 ,并且数据库中有专门的流产表.
        
            // // $result=BreedPregnancyCheck::whereIn('cow_id',$cattleids)->where('checkDate','>','2019-01-31')->where('checkResult','有');
            //     // 没办法,操作太麻烦.在孕检结果的时候,同时在配种表里插入孕检日期和孕检结果.配种是latest,
            //     // 今年产犊数预计
            //     // 根据配种记录，预产期在某个月的牛只数。
            //     $thisMonthCalvAdults1=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-01-01 -283 day')),date('Y-m-d',strtotime('2019-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults2=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-02-01 -283 day')),date('Y-m-d',strtotime('2019-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults3=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-03-01 -283 day')),date('Y-m-d',strtotime('2019-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults4=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-04-01 -283 day')),date('Y-m-d',strtotime('2019-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults5=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-05-01 -283 day')),date('Y-m-d',strtotime('2019-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults6=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-06-01 -283 day')),date('Y-m-d',strtotime('2019-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults7=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-07-01 -283 day')),date('Y-m-d',strtotime('2019-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults8=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-08-01 -283 day')),date('Y-m-d',strtotime('2019-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults9=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-09-01 -283 day')),date('Y-m-d',strtotime('2019-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults10=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-10-01 -283 day')),date('Y-m-d',strtotime('2019-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults11=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-11-01 -283 day')),date('Y-m-d',strtotime('2019-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();
            //     $thisMonthCalvAdults12=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-12-01 -283 day')),date('Y-m-d',strtotime('2019-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //         })->get()->count();

                
            //     $thisMothCalvYouth1=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-01-01 -283 day')),date('Y-m-d',strtotime('2019-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth2=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-02-01 -283 day')),date('Y-m-d',strtotime('2019-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth3=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-03-01 -283 day')),date('Y-m-d',strtotime('2019-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth4=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-04-01 -283 day')),date('Y-m-d',strtotime('2019-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth5=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-05-01 -283 day')),date('Y-m-d',strtotime('2019-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth6=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-06-01 -283 day')),date('Y-m-d',strtotime('2019-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth7=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-07-01 -283 day')),date('Y-m-d',strtotime('2019-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth8=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-08-01 -283 day')),date('Y-m-d',strtotime('2019-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth9=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-09-01 -283 day')),date('Y-m-d',strtotime('2019-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth10=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-10-01 -283 day')),date('Y-m-d',strtotime('2019-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth11=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-11-01 -283 day')),date('Y-m-d',strtotime('2019-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();
            //     $thisMothCalvYouth12=Cattle::wherehas('linkmaterecord',function($query){
            //         $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime('2019-12-01 -283 day')),date('Y-m-d',strtotime('2019-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
            //     })->get()->count();

            //         $start  = date_create('2018-03-18');
            //         $end 	= date_create('2019-01-01'); // Current time and date
            //         $diff  	= date_diff( $start, $end )->days;
            //         echo $diff;
            //         echo "<hr>";
            //         echo "<pre>本年产犊成年牛</pre>";
            //         for($i=1;$i<13;$i++){
            //             echo ",";
            //             echo ${'thisMonthCalvAdults'.$i};
            //         }
            //         echo "<br/>";
            //         echo "<pre>本年产犊育成牛</pre>";
            //         for($i=1;$i<13;$i++){
            //             echo ",";
            //             echo ${'thisMothCalvYouth'.$i};
            //         }
            //         echo "<pre>本年产犊合计</pre>";
            //         for($i=1;$i<13;$i++){
            //             echo ",";
            //             echo ${'thisMothCalvYouth'.$i}+${'thisMonthCalvAdults'.$i};
            // }
            // 预期情期受胎率，取消不算。实际意义不大。
            //本年配种母牛数
            // 一月份查找所有没有配种，或产后40天以上的成母牛，二月份按照60%情期受胎率，加上本月达到产后40天的母牛，以此类推。
                //     echo "<br>本年配种母牛数";
                //     echo "1月起始出生日期：".date('Y-m-d',strtotime('2019-01-01 -540 day'));
                //     $AdultBeMatings1=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->orWhereHas('linkmaterecord',function($query){
                //         // 增加isCalv字段，如果是done说明已经有产犊记录，如果是no，说明没有产犊。且母牛年龄大于540日龄。
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //         });
                //         })
                //     ->orWhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-01-01 -323 day")),date("Y-m-d",strtotime("2019-01-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                // })
                // ->orWhereHas('linkcalv',function($query){
                //     $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime("2019-01-01 -40 day")),date("Y-m-d",strtotime("2019-01-01 +1 month -41 day"))]);
                // })->get()->count();
                // echo "<br>1月".$AdultBeMatings1;
                //     // dd($AdultBeMatings1);
                //     $AdultBeMatings2=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-02-01 -323 day")),date("Y-m-d",strtotime("2019-02-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                // })
                // ->orWhereHas('linkcalv',function($query){
                //     $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime("2019-02-01 -40 day")),date("Y-m-d",strtotime("2019-02-01 +1 month -41 day"))]);
                // })->get()->count()+(round($AdultBeMatings1*0.4));
                // echo "<br>2月".$AdultBeMatings2;
                //         // dd(date("Y-m-d",strtotime("2019-02-01 +1 month -323 day")));
                //         // dd($AdultBeMatings2);
                //     $AdultBeMatings3=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-03-01 -323 day")),date("Y-m-d",strtotime("2019-03-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings2*0.4));
                //     // dd($AdultBeMatings3);
                //     echo "<br>3月".$AdultBeMatings3;
                //     $AdultBeMatings4=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-04-01 -323 day")),date("Y-m-d",strtotime("2019-04-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings3*0.4));

                //     echo "<br>4月".$AdultBeMatings4;
                //     $AdultBeMatings5=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-05-01 -323 day")),date("Y-m-d",strtotime("2019-05-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings4*0.4));
                //     echo "<br>5月".$AdultBeMatings5;
                //     $AdultBeMatings6=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-06-01 -323 day")),date("Y-m-d",strtotime("2019-06-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings5*0.4));
                //     echo "<br>6月".$AdultBeMatings6;
                //     $AdultBeMatings7=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-07-01 -323 day")),date("Y-m-d",strtotime("2019-07-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings6*0.4));
                //     echo "<br>7月".$AdultBeMatings7;
                //     $AdultBeMatings8=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-08-01 -323 day")),date("Y-m-d",strtotime("2019-08-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings7*0.4));
                //     echo "<br>8月".$AdultBeMatings8;
                //     $AdultBeMatings9=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-09-01 -323 day")),date("Y-m-d",strtotime("2019-09-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings8*0.4));
                //     echo "<br>9月".$AdultBeMatings9;
                //     $AdultBeMatings10=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-10-01 -323 day")),date("Y-m-d",strtotime("2019-10-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings9*0.4));
                //     echo "<br>10月".$AdultBeMatings10;
                //     $AdultBeMatings11=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-11-01 -323 day")),date("Y-m-d",strtotime("2019-11-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings10*0.4));
                //     echo "<br>11月".$AdultBeMatings11;
                //     $AdultBeMatings12=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')))->where('gender','=','母')
                //     ->WhereHas('linkmaterecord',function($query){
                //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime("2019-12-01 -323 day")),date("Y-m-d",strtotime("2019-12-01 +1 month -323 day"))])->whereHas('linkcow',function($query){
                //             $query->whereDate('birthday','<',date('Y-m-d',strtotime('2019-01-01 -540 day')));
                //     });
                //     })
                //     ->get()->count()+(round($AdultBeMatings11*0.4));
                //     echo "<br>12月".$AdultBeMatings12;

                //     // 青年待配牛--13到18月龄
                //     echo "<hr>";
                //     echo '起始日期是：'.date('Y-m-d',strtotime('2019-01-01 -540 day'));
                //     echo '<br/>';
                //     echo '结束日期是：'.date('Y-m-d',strtotime('2019-01-01 -400 day'));
                //     echo "<br>";
                //     echo "2月开始日期是：".date('Y-m-d',strtotime('2019-01-01 -399 day'));
                //     echo "，2月结束日期是".date('Y-m-d',strtotime('2019-01-01  -370 day'));
                //     $YouthBeMatings1=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -540 day')),date('Y-m-d',strtotime('2019-01-01 -400 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //             $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                 $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -540 day')),date('Y-m-d',strtotime('2019-01-01  -400 day'))]);
                //             });
                //     })->get()->count();
                //     // 二月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings2=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -399 day')),date('Y-m-d',strtotime('2019-01-01  -370 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //             $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                 $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -399 day')),date('Y-m-d',strtotime('2019-01-01  -370 day'))]);
                //             });
                //     })->get()->count()+(round($YouthBeMatings1*0.4));
                //     // dd($YouthBeMatings2);
                //     // 三月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings3=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -369 day')),date('Y-m-d',strtotime('2019-02-01  -340 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //             $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                 $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -369 day')),date('Y-m-d',strtotime('2019-01-01  -340 day'))]);
                //     });
                // })->get()->count()+(round($YouthBeMatings2*0.4));
                //      // 四月份新增加刚刚达到13月龄的牛只。
                //      $YouthBeMatings4=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -339 day')),date('Y-m-d',strtotime('2019-01-01  -310 day'))])->where('gender','=','母')
                //      ->DoesntHave('linkmaterecord')
                //      ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -339 day')),date('Y-m-d',strtotime('2019-01-01  -310 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings3*0.4));
                //       // 五月份新增加刚刚达到13月龄的牛只。
                //       $YouthBeMatings5=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -309 day')),date('Y-m-d',strtotime('2019-01-01  -280 day'))])->where('gender','=','母')
                //       ->DoesntHave('linkmaterecord')
                //       ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -309 day')),date('Y-m-d',strtotime('2019-01-01  -280 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings4*0.4));
                //        // 六月份新增加刚刚达到13月龄的牛只。
                //        $YouthBeMatings6=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -279 day')),date('Y-m-d',strtotime('2019-01-01  -250 day'))])->where('gender','=','母')
                //        ->DoesntHave('linkmaterecord')
                //        ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -279 day')),date('Y-m-d',strtotime('2019-01-01  -250 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings5*0.4));
                //     // 七月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings7=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -249 day')),date('Y-m-d',strtotime('2019-01-01  -220 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -249 day')),date('Y-m-d',strtotime('2019-01-01  -220 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings6*0.4));
                //     // 八月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings8=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -219 day')),date('Y-m-d',strtotime('2019-01-01  -190 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -219 day')),date('Y-m-d',strtotime('2019-01-01  -190 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings7*0.4));
                //      // 九月份新增加刚刚达到13月龄的牛只。
                //      $YouthBeMatings9=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -189 day')),date('Y-m-d',strtotime('2019-01-01  -160 day'))])->where('gender','=','母')
                //      ->DoesntHave('linkmaterecord')
                //      ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -189 day')),date('Y-m-d',strtotime('2019-01-01  -160 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings8*0.4));
                //       // 十月份新增加刚刚达到13月龄的牛只。
                //       $YouthBeMatings10=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -159 day')),date('Y-m-d',strtotime('2019-01-01  -130 day'))])->where('gender','=','母')
                //       ->DoesntHave('linkmaterecord')
                //       ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -159 day')),date('Y-m-d',strtotime('2019-01-01  -130 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings9*0.4));
                //     // 十一月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings11=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -129 day')),date('Y-m-d',strtotime('2019-01-01  -100 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -129 day')),date('Y-m-d',strtotime('2019-01-01  -100 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings10*0.4));
                //     // 十二月份新增加刚刚达到13月龄的牛只。
                //     $YouthBeMatings12=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -99 day')),date('Y-m-d',strtotime('2019-01-01  -70 day'))])->where('gender','=','母')
                //     ->DoesntHave('linkmaterecord')
                //     ->Orwherehas('linkmaterecord',function($query){
                //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //             $query->whereBetween('birthday',[date('Y-m-d',strtotime('2019-01-01 -99 day')),date('Y-m-d',strtotime('2019-01-01  -70 day'))]);
                //         });
                // })->get()->count()+(round($YouthBeMatings11*0.4));
                //     echo "<pre>本年青年牛配种数</pre>";
                //     for($i=1;$i<13;$i++){
                //         echo ",";
                //         echo ${'YouthBeMatings'.$i};
                //     }

                //     echo "<pre>本年总计配种数</pre>";
                //     for($i=1;$i<13;$i++){
                //         echo ",";
                //         echo ${'YouthBeMatings'.$i}+${'AdultBeMatings'.$i};
                //     }
                //         $lastyear=date('Y',strtotime('-1 year'));
                //         $lastyearAdult=array();
                //         $lastyearAdult['time']=date('Y');
                //         $lastyearAdult['type']=$lastyear.'-受胎成年母牛数';
                //         // 7月龄到18月龄，18月龄以上为成年母牛，以每月31日为基准。
                //         $lastyearAdult['January']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime('2018-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['February']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['March']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['April']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['May']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();

                //         $lastyearAdult['June']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['July']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['August']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['September']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['October']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['November']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearAdult['December']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         BreedFanzhiYearlyPlan::create($lastyearAdult);
                //         echo "去年成母牛数据插入成功";
                //         $lastyearYouth=array();
                //         $lastyearYouth['time']=date('Y');
                //         $lastyearYouth['type']=$lastyear.'年-受胎青年母牛数';
                //         $lastyearYouth['January']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime($lastyear.'-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['February']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['March']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['April']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['May']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['June']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['July']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['August']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['September']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['October']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['November']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //         $lastyearYouth['December']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                //             $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //             })->get()->count();
                //             BreedFanzhiYearlyPlan::create($lastyearYouth);
                //         $lastYearPregSum=array();
                //         $lastYearPregSum['time']=date('Y');
                //         $lastYearPregSum['type']=$lastyear.'年-受胎牛总数';
                //         $lastYearPregSum['January']=$lastyearAdult['January']+$lastyearYouth['January'];
                //         $lastYearPregSum['February']=$lastyearAdult['February']+$lastyearYouth['February'];
                //         $lastYearPregSum['March']=$lastyearAdult['March']+$lastyearYouth['March'];
                //         $lastYearPregSum['April']=$lastyearAdult['April']+$lastyearYouth['April'];
                //         $lastYearPregSum['May']=$lastyearAdult['May']+$lastyearYouth['May'];
                //         $lastYearPregSum['June']=$lastyearAdult['June']+$lastyearYouth['June'];
                //         $lastYearPregSum['July']=$lastyearAdult['July']+$lastyearYouth['July'];
                //         $lastYearPregSum['August']=$lastyearAdult['August']+$lastyearYouth['August'];
                //         $lastYearPregSum['September']=$lastyearAdult['September']+$lastyearYouth['September'];
                //         $lastYearPregSum['October']=$lastyearAdult['October']+$lastyearYouth['October'];
                //         $lastYearPregSum['November']=$lastyearAdult['November']+$lastyearYouth['November'];
                //         $lastYearPregSum['December']=$lastyearAdult['December']+$lastyearYouth['December'];
                //         BreedFanzhiYearlyPlan::create($lastYearPregSum);
                //         // 本年产犊母牛数 成母牛，育成牛，合计
                //             $thisYearCalvAdults=array();
                //             $thisYearCalvAdults['time']=date('Y');
                //             $thisYearCalvAdults['type']=date('Y').'年-产犊成年母牛数';
                //             $thisYearCalvAdults['January']=Cattle::wherehas('linkmaterecord',function($query){
                //                         $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                         })->get()->count();
                //             $thisYearCalvAdults['February']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['March']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['April']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['May']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['June']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['July']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['August']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['September']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['October']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvAdults['November']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();  
                //             $thisYearCalvAdults['December']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //                 BreedFanzhiYearlyPlan::create($thisYearCalvAdults); 
                //                     //本年产犊青年牛数
                //             $thisYearCalvYouth=array();
                //             $thisYearCalvYouth['time']=date('Y');
                //             $thisYearCalvYouth['type']=date('Y').'年-产犊青年母牛数'; 
                //             $thisYearCalvYouth['January']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['February']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['March']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['April']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['May']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['June']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['July']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['August']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['September']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['October']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //             $thisYearCalvYouth['November']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();  
                //             $thisYearCalvYouth['December']=Cattle::wherehas('linkmaterecord',function($query){
                //                 $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                //                 })->get()->count();
                //                 BreedFanzhiYearlyPlan::create($thisYearCalvYouth); 
                //                 $thisYearCalvSum=array();
                //                 $thisYearCalvSum['time']=date('Y');
                //                 $thisYearCalvSum['type']=date('Y').'年-产犊牛总数';
                //                 $thisYearCalvSum['January']=$thisYearCalvAdults['January']+$thisYearCalvYouth['January'];
                //                 $thisYearCalvSum['February']=$thisYearCalvAdults['February']+$thisYearCalvYouth['February'];
                //                 $thisYearCalvSum['March']=$thisYearCalvAdults['March']+$thisYearCalvYouth['March'];
                //                 $thisYearCalvSum['April']=$thisYearCalvAdults['April']+$thisYearCalvYouth['April'];
                //                 $thisYearCalvSum['May']=$thisYearCalvAdults['May']+$thisYearCalvYouth['May'];
                //                 $thisYearCalvSum['June']=$thisYearCalvAdults['June']+$thisYearCalvYouth['June'];
                //                 $thisYearCalvSum['July']=$thisYearCalvAdults['July']+$thisYearCalvYouth['July'];
                //                 $thisYearCalvSum['August']=$thisYearCalvAdults['August']+$thisYearCalvYouth['August'];
                //                 $thisYearCalvSum['September']=$thisYearCalvAdults['September']+$thisYearCalvYouth['September'];
                //                 $thisYearCalvSum['October']=$thisYearCalvAdults['October']+$thisYearCalvYouth['October'];
                //                 $thisYearCalvSum['November']=$thisYearCalvAdults['November']+$thisYearCalvYouth['November'];
                //                 $thisYearCalvSum['December']=$thisYearCalvAdults['December']+$thisYearCalvYouth['December'];
                //                 BreedFanzhiYearlyPlan::create($thisYearCalvSum);
                        
                //        // 本年待配成年母牛数
                //        $AdultBeMatings=array();
                //        $AdultBeMatings['time']=date('Y');
                //        $AdultBeMatings['type']=date('Y').'年-待配成年母牛数';
                //        $AdultBeMatings['January']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //        ->DoesntHave('linkmaterecord')
                //        ->orWhereHas('linkmaterecord',function($query) {
                //            // 增加isCalv字段，如果是done说明已经有产犊记录，如果是no，说明没有产犊。且母牛年龄大于540日龄。
                //            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->whereHas('linkcow',function($query){
                //                $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //            });
                //            })
                //        ->orWhereHas('linkmaterecord',function($query) {
                //            // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //            $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //                $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //        });
                //    })
                //    ->orWhereHas('linkcalv',function($query) {
                //        $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -41 day"))]);
                //    })->get()->count();
                //     $AdultBeMatings['February']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                // })
                // ->orWhereHas('linkcalv',function($query) {
                //    $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -41 day"))]);
                // })->get()->count()+(round($AdultBeMatings['January']*0.4));
                //    $AdultBeMatings['March']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-03-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-03-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['February']*0.4));
                //    $AdultBeMatings['April']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //            ->WhereHas('linkmaterecord',function($query) {
                //                // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //                $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-04-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-04-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //                    $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //            });
                //            })
                //            ->get()->count()+(round($AdultBeMatings['March']*0.4));
                //    $AdultBeMatings['May']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-05-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-05-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['April']*0.4));
                //    $AdultBeMatings['June']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-06-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-06-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['May']*0.4));
                //    $AdultBeMatings['July']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-07-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-07-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['June']*0.4));
                //    $AdultBeMatings['August']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-08-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-08-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['July']*0.4));
                //    $AdultBeMatings['September']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-09-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-09-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['August']*0.4));
                //    $AdultBeMatings['October']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-10-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-10-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['September']*0.4));
                //    $AdultBeMatings['November']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-11-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-11-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['October']*0.4));
                //    $AdultBeMatings['December']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                //    ->WhereHas('linkmaterecord',function($query) {
                //        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                //        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-12-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-12-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                //            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                //    });
                //    })
                //    ->get()->count()+(round($AdultBeMatings['November']*0.4));
                //    BreedFanzhiYearlyPlan::create($AdultBeMatings);
                //    // 本年青年牛待配数
                //    $YouthBeMatings=array();
                //    $YouthBeMatings['time']=date('Y');
                //    $YouthBeMatings['type']=date('Y').'年-待配青年母牛数';
                //    $YouthBeMatings['January']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01 -400 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -400 day'))]);
                //            });
                //    })->get()->count();
                //    $YouthBeMatings['February']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))]);
                //            });
                //    })->get()->count()+(round($YouthBeMatings['January']*0.4));
                //    $YouthBeMatings['March']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-02-01  -340 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -340 day'))]);
                //    });
                // })->get()->count()+(round($YouthBeMatings['February']*0.4));
                //    $YouthBeMatings['April']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['March']*0.4));
                // $YouthBeMatings['May']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['April']*0.4));
                // $YouthBeMatings['June']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['May']*0.4));
                // $YouthBeMatings['July']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -220 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -210 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['June']*0.4));
                // $YouthBeMatings['August']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['July']*0.4));
                // $YouthBeMatings['September']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['August']*0.4));
                // $YouthBeMatings['October']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['September']*0.4));
                // $YouthBeMatings['November']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['October']*0.4));
                // $YouthBeMatings['December']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))])->where('gender','=','母')
                //    ->DoesntHave('linkmaterecord')
                //    ->Orwherehas('linkmaterecord',function($query) {
                //       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                //           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))]);
                //       });
                // })->get()->count()+(round($YouthBeMatings['November']*0.4));
                // BreedFanzhiYearlyPlan::create($YouthBeMatings);
                // $thisYearBeMating=array();
                // $thisYearBeMating['time']=date('Y');
                // $thisYearBeMating['type']=date('Y').'年-待配牛总数';
                // $thisYearBeMating['January']=$AdultBeMatings['January']+$YouthBeMatings['January'];
                // $thisYearBeMating['February']=$AdultBeMatings['February']+$YouthBeMatings['February'];
                // $thisYearBeMating['March']=$AdultBeMatings['March']+$YouthBeMatings['March'];
                // $thisYearBeMating['April']=$AdultBeMatings['April']+$YouthBeMatings['April'];
                // $thisYearBeMating['May']=$AdultBeMatings['May']+$YouthBeMatings['May'];
                // $thisYearBeMating['June']=$AdultBeMatings['June']+$YouthBeMatings['June'];
                // $thisYearBeMating['July']=$AdultBeMatings['July']+$YouthBeMatings['July'];
                // $thisYearBeMating['August']=$AdultBeMatings['August']+$YouthBeMatings['August'];
                // $thisYearBeMating['September']=$AdultBeMatings['September']+$YouthBeMatings['September'];
                // $thisYearBeMating['October']=$AdultBeMatings['October']+$YouthBeMatings['October'];
                // $thisYearBeMating['November']=$AdultBeMatings['November']+$YouthBeMatings['November'];
                // $thisYearBeMating['December']=$AdultBeMatings['December']+$YouthBeMatings['December'];
                // BreedFanzhiYearlyPlan::create($thisYearBeMating);

        try{
                DB::beginTransaction();
                //育成牛指6-18月龄牛。
                // $lastyear=date('Y',strtotime('-1 year'));
                // $lastyearAdult=array();
                // $lastyearAdult['time']=date('Y');
                // $lastyearAdult['type']=$lastyear.'-受胎成年母牛数';
                // // 7月龄到18月龄，18月龄以上为成年母牛，以每月31日为基准。
                // $lastyearAdult['January']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime('2018-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['February']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['March']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['April']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['May']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();

                // $lastyearAdult['June']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['July']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['August']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['September']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['October']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['November']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                // $lastyearAdult['December']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
                //     $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                //     })->get()->count();
                //         BreedFanzhiYearlyPlan::create($lastyearAdult);
                // echo "去年成母牛数据插入成功";
                    //     $lastyearYouth=array();
                    //     $lastyearYouth['time']=date('Y');
                    //     $lastyearYouth['type']=$lastyear.'-受胎青年母牛数';
                    //     $lastyearYouth['January']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime($lastyear.'-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['February']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['March']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['April']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['May']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['June']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['July']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['August']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['September']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['October']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['November']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //     $lastyearYouth['December']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
                    //         $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
                    //         })->get()->count();
                    //         BreedFanzhiYearlyPlan::create($lastyearYouth);
                    //     // 受胎合计
                    //     $lastYearPregSum=array();
                    //     $lastYearPregSum['time']=date('Y');
                    //     $lastYearPregSum['type']=$lastyear.'-受胎牛总数';
                    //     $lastYearPregSum['January']=$lastyearAdult['January']+$lastyearYouth['January'];
                    //     $lastYearPregSum['February']=$lastyearAdult['February']+$lastyearYouth['February'];
                    //     $lastYearPregSum['March']=$lastyearAdult['March']+$lastyearYouth['March'];
                    //     $lastYearPregSum['April']=$lastyearAdult['April']+$lastyearYouth['April'];
                    //     $lastYearPregSum['May']=$lastyearAdult['May']+$lastyearYouth['May'];
                    //     $lastYearPregSum['June']=$lastyearAdult['June']+$lastyearYouth['June'];
                    //     $lastYearPregSum['July']=$lastyearAdult['July']+$lastyearYouth['July'];
                    //     $lastYearPregSum['August']=$lastyearAdult['August']+$lastyearYouth['August'];
                    //     $lastYearPregSum['September']=$lastyearAdult['September']+$lastyearYouth['September'];
                    //     $lastYearPregSum['October']=$lastyearAdult['October']+$lastyearYouth['October'];
                    //     $lastYearPregSum['November']=$lastyearAdult['November']+$lastyearYouth['November'];
                    //     $lastYearPregSum['December']=$lastyearAdult['December']+$lastyearYouth['December'];
                    //     BreedFanzhiYearlyPlan::create($lastyearYouth);
                    //      // 本年产犊母牛数 成母牛，育成牛，合计
                    //      $thisYearCalvAdults=array();
                    //      $thisYearCalvAdults['time']=date('Y');
                    //      $thisYearCalvAdults['type']=date('Y').'年-产犊成年母牛数';
                    //      $thisYearCalvAdults['January']=Cattle::wherehas('linkmaterecord',function($query){
                    //                  $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //                  })->get()->count();
                    //      $thisYearCalvAdults['February']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['March']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['April']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['May']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['June']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['July']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['August']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['September']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['October']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvAdults['November']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();  
                    //      $thisYearCalvAdults['December']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //          BreedFanzhiYearlyPlan::create($thisYearCalvAdults); 
                    //              //本年产犊青年牛数
                    //      $thisYearCalvYouth=array();
                    //      $thisYearCalvYouth['time']=date('Y');
                    //      $thisYearCalvYouth['type']=date('Y').'年-产犊青年母牛数'; 
                    //      $thisYearCalvYouth['January']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['February']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['March']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['April']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['May']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['June']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['July']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['August']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['September']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['October']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //      $thisYearCalvYouth['November']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();  
                    //      $thisYearCalvYouth['December']=Cattle::wherehas('linkmaterecord',function($query){
                    //          $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                    //          })->get()->count();
                    //          BreedFanzhiYearlyPlan::create($thisYearCalvYouth); 
                    //          $thisYearCalvSum=array();
                    //          $thisYearCalvSum['time']=date('Y');
                    //          $thisYearCalvSum['type']=date('Y').'年-产犊牛总数';
                    //          $thisYearCalvSum['January']=$thisYearCalvAdults['January']+$thisYearCalvYouth['January'];
                    //          $thisYearCalvSum['February']=$thisYearCalvAdults['February']+$thisYearCalvYouth['February'];
                    //          $thisYearCalvSum['March']=$thisYearCalvAdults['March']+$thisYearCalvYouth['March'];
                    //          $thisYearCalvSum['April']=$thisYearCalvAdults['April']+$thisYearCalvYouth['April'];
                    //          $thisYearCalvSum['May']=$thisYearCalvAdults['May']+$thisYearCalvYouth['May'];
                    //          $thisYearCalvSum['June']=$thisYearCalvAdults['June']+$thisYearCalvYouth['June'];
                    //          $thisYearCalvSum['July']=$thisYearCalvAdults['July']+$thisYearCalvYouth['July'];
                    //          $thisYearCalvSum['August']=$thisYearCalvAdults['August']+$thisYearCalvYouth['August'];
                    //          $thisYearCalvSum['September']=$thisYearCalvAdults['September']+$thisYearCalvYouth['September'];
                    //          $thisYearCalvSum['October']=$thisYearCalvAdults['October']+$thisYearCalvYouth['October'];
                    //          $thisYearCalvSum['November']=$thisYearCalvAdults['November']+$thisYearCalvYouth['November'];
                    //          $thisYearCalvSum['December']=$thisYearCalvAdults['December']+$thisYearCalvYouth['December'];
                    //          BreedFanzhiYearlyPlan::create($thisYearCalvSum);
                            
                    //     // 本年待配成年母牛数
                    //     $AdultBeMatings=array();
                    //     $AdultBeMatings['time']=date('Y');
                    //     $AdultBeMatings['type']=date('Y').'-待配成年母牛数';
                    //     $AdultBeMatings['January']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    //     ->DoesntHave('linkmaterecord')
                    //     ->orWhereHas('linkmaterecord',function($query) {
                    //         // 增加isCalv字段，如果是done说明已经有产犊记录，如果是no，说明没有产犊。且母牛年龄大于540日龄。
                    //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->whereHas('linkcow',function($query){
                    //             $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    //         });
                    //         })
                    //     ->orWhereHas('linkmaterecord',function($query) {
                    //         // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //         $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //             $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    //     });
                    // })
                    // ->orWhereHas('linkcalv',function($query) {
                    //     $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -41 day"))]);
                    // })->get()->count();
                    // $AdultBeMatings['February']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->orWhereHas('linkcalv',function($query) {
                    // $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -41 day"))]);
                    // })->get()->count()+(round($AdultBeMatings['January']*0.4));
                    // $AdultBeMatings['March']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-03-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-03-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['February']*0.4));
                    // $AdultBeMatings['April']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    //         ->WhereHas('linkmaterecord',function($query) {
                    //             // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //             $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-04-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-04-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //                 $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    //         });
                    //         })
                    //         ->get()->count()+(round($AdultBeMatings['March']*0.4));
                    // $AdultBeMatings['May']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-05-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-05-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['April']*0.4));
                    // $AdultBeMatings['June']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-06-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-06-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['May']*0.4));
                    // $AdultBeMatings['July']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-07-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-07-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['June']*0.4));
                    // $AdultBeMatings['August']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-08-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-08-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['July']*0.4));
                    // $AdultBeMatings['September']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-09-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-09-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['August']*0.4));
                    // $AdultBeMatings['October']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-10-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-10-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['September']*0.4));
                    // $AdultBeMatings['November']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-11-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-11-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['October']*0.4));
                    // $AdultBeMatings['December']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
                    // ->WhereHas('linkmaterecord',function($query) {
                    //     // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                    //     $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-12-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-12-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    //         $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
                    // });
                    // })
                    // ->get()->count()+(round($AdultBeMatings['November']*0.4));
                    // BreedFanzhiYearlyPlan::create($AdultBeMatings);
                    // // 本年青年牛待配数
                    // $YouthBeMatings=array();
                    // $YouthBeMatings['time']=date('Y');
                    // $YouthBeMatings['type']=date('Y').'-待配青年母牛数';
                    // $YouthBeMatings['january']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01 -400 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //             $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -400 day'))]);
                    //         });
                    // })->get()->count();
                    // $YouthBeMatings['February']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //             $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))]);
                    //         });
                    // })->get()->count()+(round($YouthBeMatings['january']*0.4));
                    // $YouthBeMatings['March']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-02-01  -340 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //         $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //             $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -340 day'))]);
                    // });
                    // })->get()->count()+(round($YouthBeMatings['February']*0.4));
                    // $YouthBeMatings['April']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['March']*0.4));
                    // $YouthBeMatings['May']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['April']*0.4));
                    // $YouthBeMatings['June']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['May']*0.4));
                    // $YouthBeMatings['July']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -220 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -210 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['June']*0.4));
                    // $YouthBeMatings['August']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['July']*0.4));
                    // $YouthBeMatings['September']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['August']*0.4));
                    // $YouthBeMatings['October']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['September']*0.4));
                    // $YouthBeMatings['November']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['October']*0.4));
                    // $YouthBeMatings['December']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))])->where('gender','=','母')
                    // ->DoesntHave('linkmaterecord')
                    // ->Orwherehas('linkmaterecord',function($query) {
                    //    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                    //        $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))]);
                    //    });
                    // })->get()->count()+(round($YouthBeMatings['November']*0.4));
                    //         BreedFanzhiYearlyPlan::create($YouthBeMatings);

                    /****
                     * 生成月计划表
                     * 
                     */
                    $monthPlans=array();

                    $monthPlans['time']=date('Y-m');

                    $monthPlans['lastMonthMated']=BreedMateRecord::where('isLatest','latest')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();

                    $monthPlans['lastMonthPregCheck']=BreedMateRecord::where('isLatest','latest')->whereBetween('pregCheckDay',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();

                    $monthPlans['lastMonthPregCattleNum']=BreedMateRecord::where('isLatest','latest')->whereBetween('pregCheckDay',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->where('pregCheckResult','怀孕')->get()->count();

                    // 孕检受胎率
                    if($monthPlans['lastMonthPregCheck'] == '0'){
                        $monthPlans['lastMonthPregRation'] = '0';
                    }else{
                        $monthPlans['lastMonthPregRation']=round($monthPlans['lastMonthPregCattleNum']/$monthPlans['lastMonthPregCheck'],2)."%";
                    }

                    // dd($monthPlans);
                    // 本月预计配种牛头数
                    $monthPlans['thisMonthMating']=Cattle::where('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -13 month')))->where('gender','=','母')->DoesntHave('linkmaterecord')->OrWhereHas('linkmaterecord',function($query){
                        // 13月龄以上的母牛
                        $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                                $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -13 month')));
                        });
                    })->OrWhereHas('linkmaterecord',function($query){
                        // 产犊日期大于40天的
                        $query->where('isLatest','latest')->where('isCalv','done')->whereHas('linkcalv',function($query){
                            $query->whereDate('calvDate','<',date('Y-m-d',strtotime(date('Y-m').'-01 +1 month -41 day')))->wherehas('linkcattle',function($query){
                                $query->where('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -13 month')));
                            });
                        });
                    })
                    ->get()->count();

                    // 本月需要定胎牛头数,有配种记录，且没有产犊，没有定胎记录的牛。
                    $monthPlans['thisMonthPregCheck']=BreedMateRecord::where('isLatest','latest')->where('isCalv','no')->where('pregCheckDay',null)->get()->count();
                    // dd($monthPlans);
                    // 本月产犊牛数
                    $monthPlans['thisMonthCalv']=Cattle::wherehas('linkmaterecord',function($query){
                                $query->where('isLatest','latest')->where('isCalv','no')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y-m').'-01 -283 day')),date('Y-m-d',strtotime(date('Y-m').'-01 +1 month -284 day'))]);
                                })->get()->count();

                    // 本月冻精预计使用量,等于配种牛数
                    $monthPlans['thisMonthSemenUse']=$monthPlans['thisMonthMating'];
                    // dd($monthPlans);

                    BreedFanzhiMonthPlan::create($monthPlans);
                    DB::commit();
        }
        catch(\Exception $e){
                DB::rollback();
                $errors= $e->getmessage();
                \Log::info('年繁殖计划表生成错误'.$e);
        }

    }
    public function month_report()
        {
        // 测试左连接按id倒序排列
        // $leftjoin=DB::table('cattle')
        // ->Join('breed_mate_records as mate',function($join){
        //         $join->on('mate.cow_id','=','cattle.id')->where('mateDate','<','2018-03-02');
        // })
        // ->get();
        $leftjoin=DB::select('
                            select MAX(breed_mate_records.id) 
                             FROM
                                breed_mate_records
                             Join cattle ON cattle.id = breed_mate_records.cow_id
                             
                             GROUP BY cow_id
                          
                            ');   
        $lastmate=DB::select('
                    select count("id") as total
                    FROM
                        cattle
                    join breed_mate_records as mate ON mate.cow_id = cattle.id
                    where mate.id IN (
                        select MAX(breed_mate_records.id) 
                             FROM
                                breed_mate_records
                             Join cattle ON cattle.id = breed_mate_records.cow_id
                             where breed_mate_records.mateDate < "2018-03-01" and cattle.birthday < "2015-06-01"
                             GROUP BY cow_id
                    )
                    
        ');
        // dd($lastmate[0]->total);
        // $days=date_diff(date_create(date('Y-m-01',strtotime('-1 day'))), date_create(date('Y-m-01',strtotime('-1 month'))))->days;
        // dd($days);
        $minMateDay=BreedMateRecord::whereBetween('pregCheckDay',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->orderBy('mateDate')->get();

        // dd($minMateDay->last()->mateDate);
        //上月配种牛头数
            $reports=array();
            $reports['year']=date('Y');
            $reports['month']=date('m',strtotime('-1 month'));
        // 上月适配牛数
        $reports['eligibleBreed']=Cattle::where('gender','母')->where('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -14 month')))
        ->DoesntHave('linkmaterecord')->OrWhereHas('linkmaterecord',function($query){
                    // 13月龄以上的母牛
                    $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -14 month')));
                    });
                    })->OrWhereHas('linkmaterecord',function($query){
                    // 产犊日期大于40天的
                    $query->where('isLatest','latest')->where('isCalv','done')->whereHas('linkcalv',function($query){
                        $query->whereDate('calvDate','<',date('Y-m-d',strtotime(date('Y-m').'-01  -51 day')))->wherehas('linkcattle',function($query){
                            $query->where('birthday','<',date('Y-m-d',strtotime(date('Y-m').'-01 -14 month')));
                        });
                    });
                    })
                    ->get()->count();
        // 配种牛数
            $reports['matedCowNum']=Cattle::wherehas('linkmaterecord',function($query){
                $query->where('isLatest','latest')->whereBetween('mateDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))]);
                })->get()->count();
        // 总配种次数
            $reports['totalMateNum']=BreedMateRecord::whereBetween('mateDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
        // 使用冻精数
            $reports['semenUseAmount']=BreedMateRecord::whereBetween('mateDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->sum('useAmount');
        // 孕检牛头数
            $reports['pregCheckNum']=BreedMateRecord::whereBetween('pregCheckDay',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
        // 确定怀孕牛头数
            $reports['confirmPregNum']=BreedMateRecord::whereBetween('pregCheckDay',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->where('pregCheckResult','怀孕')->get()->count();
        // 孕检受胎率
            $reports['lastMonthPregRation']=round($reports['matedCowNum']/$reports['pregCheckNum'],2);
        // 21天配种率
            $reports['HDR']=round($reports['confirmPregNum']/(($reports['eligibleBreed']*(date_diff(date_create(date('Y-m-01',strtotime('-1 day'))), date_create(date('Y-m-01',strtotime('-1 month'))))->days))/21),2);

            // dd($reports['HDR']);
        // 孕检21天情期受胎率--以现在的怀孕数，比上配种时的应配牛数。
                // 首先获得本月孕检牛的最早配种日期,最大配种日期
                    $qMateDay=BreedMateRecord::whereBetween('pregCheckDay',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->orderBy('mateDate')->get();
                    $minDate=$qMateDay->first()->mateDate;
                    $maxDate=$qMateDay->last()->mateDate;
                    $birthday=date('Y-m-01',strtotime('-14 month'));
                    $minCalvDate= date('Y-m-d',strtotime($minDate.'-50 day'));
                    $maxCalvDate= date('Y-m-d',strtotime($maxDate.'-50 day'));
                    // dd($maxCalvDate);
                // 查询breed_mate_records表中,配种日期在最大配种日期之前，且isLatest,为no;的最大id.
                        $waitmates=DB::select('
                                select MAX(breed_mate_records.id) 
                                FROM
                                    breed_mate_records
                                Join cattle ON cattle.id = breed_mate_records.cow_id
                                where breed_mate_records.mateDate < "'."$minDate".'" and cattle.birthday < "'."$birthday".'"
                                GROUP BY cow_id                
                        ');
                        // dd($waitmates);
                        $waitmates=array_column($waitmates,"MAX(breed_mate_records.id)");
                        
                        $waitmates=implode(',',$waitmates);
                        // dd($waitmates);
                // 应配牛数 在群牛，大于13月龄，1 ==> 无配种记录的，2 ==> 有配种记录，产犊为none,最近孕检结果为未孕，怀孕和没有数据的都视为怀孕，3 ==>有配种记录，产犊为done,距现在50天以上的。
                    $eligibleCow_nomate=Cattle::where('birthday','<',date('Y-m-01',strtotime('-14 month')))->where('gender','母')->where('status','在群')->DoesntHave('linkmaterecord')->get()->count();
                    // dd($eligibleCow_nomate);
                    DB::connection()->enableQueryLog();
                    $eligibleCow_nopreg=DB::select('select count(*) as total 
                                            FROM 
                                            cattle
                                            Join breed_mate_records as mate ON cattle.id = mate.cow_id 
                                            where mate.isCalv = "no" and mate.pregCheckResult = "未孕" and mate.id IN ('.$waitmates.')
                    ');
                    // dd($eligibleCow_nopreg[0]->total);
                    $eligibleCow_isCalv=DB::select('
                                            select count(*) as total 
                                            FROM 
                                            cattle
                                            Join breed_mate_records as mate ON cattle.id = mate.cow_id 
                                            Join breed_calvs as calvs ON mate.cow_id = calvs.cow_id
                                            where mate.isCalv = "done" and mate.id IN ('.$waitmates.') 
                                            and (calvs.calvDate BETWEEN "'."$minCalvDate".'" and "'."$maxCalvDate".'" ) 
                    ');
                    // dd($eligibleCow_isCalv[0]->total);
                    $eligibleCow_total=$eligibleCow_nomate + $eligibleCow_nopreg[0]->total + $eligibleCow_isCalv[0]->total;
                    // dd($eligibleCow_total);
                // 本批孕检牛21天情期受胎率，等于本批孕检怀孕牛数除以适配牛数。
                    $reports['estrusConceptionRate']=round($reports['confirmPregNum']/($eligibleCow_total),2);
                // 产犊数--如果是双胞胎，提交两次产犊记录
                    $reports['calvNum']=BreedCalv::whereBetween('calvDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                    // dd($reports['calvNum']);
                    $reports['MaleCalfNum']=BreedCalv::where('calvGender','公')->whereBetween('calvDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                    $reports['FemaleCalfNum']=BreedCalv::where('calvGender','母')->whereBetween('calvDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                    $reports['abortionNum']=BreedCalv::where('calvStatus','流产')->whereBetween('calvDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                    $reports['nonNormalCalv']=BreedCalv::where('calvStatus','!=','正常')->whereBetween('calvDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                    $reports['retainedAfterBirthNum']=BreedAftercare::where('Retention','是')->whereBetween('careDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
                BreedFanzhiMonthReport::create($reports);
                    return view('report_month');
        }
    public function year_report()
        {
            // 年情期受胎率
            // 采用公式 PR = 21/(DO-VMP+11) VMP设定为50
            // 首选计算在群母牛的平均空怀天数，不包括青年牛。
            // 首先在cattle 查找最高胎次牛，max（pregnancyNum）,例如是5，然后查看5胎牛的全部牛号，计算4胎牛产犊日期到配种且怀孕的天数，
            // 依此类推。       4胎牛产犊日期需要在产犊表里，where('胎次'，’4‘，)->(cow_id,$cattle)->get();->calvDate,然后到配种表里查询，对应牛号。
            // 简单的修改，在mate_records表里增加calvDate,然后孕检的时候，确定怀孕，则计算空怀天数（配种日期-产犊日期）
            // 以孕检日期在今年为基准，计算空怀天数
            // 如果一次孕检计算DO后,发生流产，再配，再检，再产生新DO,原先的DO也参与计算，反映的是配种水平。
            // 计算两个值剔除流产牛的空怀天数，和
                $yearreports=array();
                $yearreports['year']=date('Y',strtotime(date('Y').'-01-01 -1 year'));
                $yearreports['DO']=BreedMateRecord::whereBetween('pregCheckDay',[date('Y-m-d',strtotime(date('Y').'-01-01 -1 year')),date('Y-m-d',strtotime(date('Y').'-01-01 -1 day'))])->avg('DayOpen');
                $yearreports['yearlyEstrusConceptionRate'] = 21/($yearreports['DO']-50+11);
                    // dd($yearreports['yearlyEstrusConceptionRate']);
                    // 年一次受胎率
                    // 去年总孕检牛数
                    $start = date('Y-m-d',strtotime(date('Y').'-01-01 -1 year'));
                    $end = date('Y-m-d',strtotime(date('Y').'-01-01 -1 day'));
                    $totalPregCheck=BreedMateRecord::where('pregCheckDay','!=','')->whereBetween('pregCheckDay',[$start,$end])->get();
                    print_r('2018年总孕检牛数'.$totalPregCheck->count()."<br>");
                        $i=0;
                        $pregCowIds=array();
                    // 通过foreach循环,找到怀孕牛id,并组成数组,为下步IN查询做准备
                    $totalConfirmPreg=$totalPregCheck->toArray();
                    foreach($totalConfirmPreg as $k=>$preg){
                        if($preg['pregCheckResult'] == '怀孕'){
                            $pregCowIds[$i]['cow_id']=$preg['cow_id'];
                            $pregCowIds[$i]['mateOrder'] = $preg['mateOrder'];
                            $i++;
                        }
                    }
                    // 总配种受孕率
                    $yearreports['totalConceptionRate']=round($i/$totalPregCheck->count(),4);
                    print_r($pregCowIds);
                    // 一次配种受孕率,是一次配种就怀孕的牛头数除以总孕检头数
                    // 去年一次孕检怀孕牛,查找上次配种记录,mateOrder-1;如果isCalv是done,证明是一次受孕
                    $j=0;
                    foreach($pregCowIds as $pregcow){
                        
                        if($pregcow['mateOrder'] > 1){
                            $onceMates=BreedMateRecord::where('mateOrder',$pregcow['mateOrder']-1)->where('cow_id',$pregcow['cow_id'])->first();
                           if(!empty($onceMates) && $onceMates->isCalv =='done'){
                               $j++;
                           }
                        }
                        
                    }
                    $yearreports['yearlyOnceConception']= round($j/$totalPregCheck->count(),4);
                        //  dd($yearreports['yearlyOnceConception']);
                // 青年牛统计平均首配日龄，平均第一胎产犊月龄->天，日龄。18月龄以下
                $yearreports['youngfirstMateAge']=BreedMateRecord::whereBetween('mateDate',[$start,$end])->where('mateOrder','1')->whereHas('linkcow',function($query) use($start,$end){
                        $query->whereBetween('birthday',[date('Y-m-d',strtotime($start.'-18 month')),date('Y-m-d',strtotime($end.'-18 month'))]);
                    })->avg('mateAgeOfDay');
                    // dd($yearreports['aveYoungfirstMate']);
                    // 产犊率是今年产犊数/(产犊+流产数)
                    $calvTotalNum = BreedCalv::whereBetween('calvDate',[$start,$end])->count();
                    $calvNormal = BreedCalv::whereBetween('calvDate',[$start,$end])->where('calvStatus','!=','流产')->count();
                    $yearreports['totalCalvRate'] = round($calvNormal/$calvTotalNum,2);
                    // dd($yearreports['totalCalvRate']);
                    // 不正产率=(难产+早产)/非流产牛数
                    $calvHard = BreedCalv::whereBetween('calvDate',[$start,$end])->where('calvStatus','=','难产')->orWhere('calvStatus','早产')->count();
                    $yearreports['notNormalCalvRate'] = round($calvHard/$calvNormal,2);
                    // dd($yearreports['notNormalCalvRate']);
                    // 流产率=流产数/全产产犊母牛数
                    $abortions=BreedCalv::whereBetween('calvDate',[$start,$end])->where('calvStatus','=','流产')->count();
                    $yearreports['aborationRate'] = round($abortions/$calvTotalNum,2);
                    // dd( $yearreports['aborationRate']);
                    // 年空怀率,这一指标换成青年牛首配日龄
                    // 平均胎间距
                    $yearreports['AveSpace']=BreedCalv::whereBetween('calvDate',[$start,$end])->avg('calvInterval');
                    dd($yearreports['AveSpace']);
                    // 犊牛死亡率--这个属于新建表,牛只淘汰表,6月以下牛只死亡数/6月龄以下牛只总数--(日期从每年1月1日开始,即出生日期提前6个月的都算.)



            // 产犊间隔，在产犊表里增加clavInterval,当胎次大于等于2的时候，查找上一胎次产犊时间，计算两者相差的天数
            // 流产牛不计算，造成产犊间隔加大，这也提醒养殖场注意防范流产。
            
            dd('test');

        }
        public function digui($cow_id,$pregNum)
        {
            if($pregNum > 1 ){
                $beforeCalv=BreedCalv::where('cow_id',$cow_id)->where('pregnancyNum',$pregNum-1)->first();
                if($beforeCalv->calvStatus != '流产'){
                    return $beforeCalv->calvDate;
                }elseif($beforeCalv->calvStatus == '流产'){
                    $date=$this->digui($cow_id,$pregNum-1);
                    // dd($date);
                    return $date;
                }
            }
            
            
    
            
        }
        public function find_last_calv(){
            $calvDate=$this->digui(15,3);
            dd($calvDate);
        }


    }
 
