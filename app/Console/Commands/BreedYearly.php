<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cattle;
use App\Models\BreedPregnancyCheck;
use App\Models\BreedFanzhiYearlyPlan;
use DB;

class BreedYearly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breed:yearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description,生成年繁殖计划表';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
        DB::beginTransaction();
        //育成牛指6-18月龄牛。
        $lastyear=date('Y',strtotime('-1 year'));
        $lastyearAdult=array();
        $lastyearAdult['time']=date('Y');
        $lastyearAdult['type']=$lastyear.'-受胎成年母牛数';
        // 7月龄到18月龄，18月龄以上为成年母牛，以每月31日为基准。
        $lastyearAdult['January']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime('2018-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['February']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['March']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['April']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['May']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();

        $lastyearAdult['June']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['July']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['August']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['September']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['October']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['November']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearAdult['December']=Cattle::where('birthday','<',date('Y-m-d',strtotime($lastyear.'-01-01 -18 month')))->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        BreedFanzhiYearlyPlan::create($lastyearAdult);
        // echo "去年成母牛数据插入成功";
        $lastyearYouth=array();
        $lastyearYouth['time']=date('Y');
        $lastyearYouth['type']=$lastyear.'-受胎青年母牛数';
        $lastyearYouth['January']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-01-01',date('Y-m-d',strtotime($lastyear.'-01-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['February']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-02-01',date('Y-m-d',strtotime($lastyear.'-02-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['March']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-03-01',date('Y-m-d',strtotime($lastyear.'-03-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['April']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-04-01',date('Y-m-d',strtotime($lastyear.'-04-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['May']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-05-01',date('Y-m-d',strtotime($lastyear.'-05-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['June']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-06-01',date('Y-m-d',strtotime($lastyear.'-06-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['July']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-07-01',date('Y-m-d',strtotime($lastyear.'-07-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['August']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-08-01',date('Y-m-d',strtotime($lastyear.'-08-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['September']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-09-01',date('Y-m-d',strtotime($lastyear.'-09-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['October']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-10-01',date('Y-m-d',strtotime($lastyear.'-10-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['November']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-11-01',date('Y-m-d',strtotime($lastyear.'-11-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
        $lastyearYouth['December']=Cattle::where('birthday','>',[date('Y-m-d',strtotime($lastyear.'-01-01 -18 month'))])->wherehas('linkmaterecord',function($query) use($lastyear){
            $query->whereBetween('mateDate',[$lastyear.'-12-01',date('Y-m-d',strtotime($lastyear.'-12-01 +1 month -1 day'))])->where('pregCheckResult','怀孕');
            })->get()->count();
            BreedFanzhiYearlyPlan::create($lastyearYouth);
        // 受胎合计
        $lastYearPregSum=array();
        $lastYearPregSum['time']=date('Y');
        $lastYearPregSum['type']=$lastyear.'-受胎牛总数';
        $lastYearPregSum['January']=$lastyearAdult['January']+$lastyearYouth['January'];
        $lastYearPregSum['February']=$lastyearAdult['February']+$lastyearYouth['February'];
        $lastYearPregSum['March']=$lastyearAdult['March']+$lastyearYouth['March'];
        $lastYearPregSum['April']=$lastyearAdult['April']+$lastyearYouth['April'];
        $lastYearPregSum['May']=$lastyearAdult['May']+$lastyearYouth['May'];
        $lastYearPregSum['June']=$lastyearAdult['June']+$lastyearYouth['June'];
        $lastYearPregSum['July']=$lastyearAdult['July']+$lastyearYouth['July'];
        $lastYearPregSum['August']=$lastyearAdult['August']+$lastyearYouth['August'];
        $lastYearPregSum['September']=$lastyearAdult['September']+$lastyearYouth['September'];
        $lastYearPregSum['October']=$lastyearAdult['October']+$lastyearYouth['October'];
        $lastYearPregSum['November']=$lastyearAdult['November']+$lastyearYouth['November'];
        $lastYearPregSum['December']=$lastyearAdult['December']+$lastyearYouth['December'];
        BreedFanzhiYearlyPlan::create($lastyearYouth);
         // 本年产犊母牛数 成母牛，育成牛，合计
         $thisYearCalvAdults=array();
         $thisYearCalvAdults['time']=date('Y');
         $thisYearCalvAdults['type']=date('Y').'年-产犊成年母牛数';
         $thisYearCalvAdults['January']=Cattle::wherehas('linkmaterecord',function($query){
                     $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
                     })->get()->count();
         $thisYearCalvAdults['February']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['March']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['April']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['May']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['June']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['July']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['August']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['September']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['October']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvAdults['November']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();  
         $thisYearCalvAdults['December']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','>','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
             BreedFanzhiYearlyPlan::create($thisYearCalvAdults); 
                 //本年产犊青年牛数
         $thisYearCalvYouth=array();
         $thisYearCalvYouth['time']=date('Y');
         $thisYearCalvYouth['type']=date('Y').'年-产犊青年母牛数'; 
         $thisYearCalvYouth['January']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-01-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-01-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['February']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-02-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-02-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['March']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-03-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-03-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['April']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-04-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-04-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['May']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-05-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-05-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['June']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-06-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-06-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['July']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-07-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-07-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['August']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-08-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-08-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['September']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-09-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-09-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['October']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-10-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-10-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
         $thisYearCalvYouth['November']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-11-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-11-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();  
         $thisYearCalvYouth['December']=Cattle::wherehas('linkmaterecord',function($query){
             $query->where('mateAgeOfDay','<=','540')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y').'-12-01 -283 day')),date('Y-m-d',strtotime(date('Y').'-12-01 +1 month -284 day'))])->where('pregCheckResult','怀孕');
             })->get()->count();
             BreedFanzhiYearlyPlan::create($thisYearCalvYouth); 
             $thisYearCalvSum=array();
             $thisYearCalvSum['time']=date('Y');
             $thisYearCalvSum['type']=date('Y').'年-产犊牛总数';
             $thisYearCalvSum['January']=$thisYearCalvAdults['January']+$thisYearCalvYouth['January'];
             $thisYearCalvSum['February']=$thisYearCalvAdults['February']+$thisYearCalvYouth['February'];
             $thisYearCalvSum['March']=$thisYearCalvAdults['March']+$thisYearCalvYouth['March'];
             $thisYearCalvSum['April']=$thisYearCalvAdults['April']+$thisYearCalvYouth['April'];
             $thisYearCalvSum['May']=$thisYearCalvAdults['May']+$thisYearCalvYouth['May'];
             $thisYearCalvSum['June']=$thisYearCalvAdults['June']+$thisYearCalvYouth['June'];
             $thisYearCalvSum['July']=$thisYearCalvAdults['July']+$thisYearCalvYouth['July'];
             $thisYearCalvSum['August']=$thisYearCalvAdults['August']+$thisYearCalvYouth['August'];
             $thisYearCalvSum['September']=$thisYearCalvAdults['September']+$thisYearCalvYouth['September'];
             $thisYearCalvSum['October']=$thisYearCalvAdults['October']+$thisYearCalvYouth['October'];
             $thisYearCalvSum['November']=$thisYearCalvAdults['November']+$thisYearCalvYouth['November'];
             $thisYearCalvSum['December']=$thisYearCalvAdults['December']+$thisYearCalvYouth['December'];
             BreedFanzhiYearlyPlan::create($thisYearCalvSum);
             
        // 本年待配成年母牛数
        $AdultBeMatings=array();
        $AdultBeMatings['time']=date('Y');
        $AdultBeMatings['type']=date('Y').'-待配成年母牛数';
        $AdultBeMatings['January']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
        ->DoesntHave('linkmaterecord')
        ->orWhereHas('linkmaterecord',function($query) {
            // 增加isCalv字段，如果是done说明已经有产犊记录，如果是no，说明没有产犊。且母牛年龄大于540日龄。
            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->whereHas('linkcow',function($query){
                $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
            });
            })
        ->orWhereHas('linkmaterecord',function($query) {
            // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
            $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
        });
    })
    ->orWhereHas('linkcalv',function($query) {
        $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-01-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-01-01 +1 month -41 day"))]);
    })->get()->count();
    $AdultBeMatings['February']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
})
->orWhereHas('linkcalv',function($query) {
    $query->where('isLatest','latest')->whereBetween('calvDate',[date("Y-m-d",strtotime(date('Y')."-02-01 -40 day")),date("Y-m-d",strtotime(date('Y')."-02-01 +1 month -41 day"))]);
})->get()->count()+(round($AdultBeMatings['January']*0.4));
    $AdultBeMatings['March']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-03-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-03-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['February']*0.4));
    $AdultBeMatings['April']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
            ->WhereHas('linkmaterecord',function($query) {
                // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
                $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-04-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-04-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
                    $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
            });
            })
            ->get()->count()+(round($AdultBeMatings['March']*0.4));
    $AdultBeMatings['May']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-05-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-05-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['April']*0.4));
    $AdultBeMatings['June']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-06-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-06-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['May']*0.4));
    $AdultBeMatings['July']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-07-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-07-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['June']*0.4));
    $AdultBeMatings['August']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-08-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-08-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['July']*0.4));
    $AdultBeMatings['September']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-09-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-09-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['August']*0.4));
    $AdultBeMatings['October']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-10-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-10-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['September']*0.4));
    $AdultBeMatings['November']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-11-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-11-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['October']*0.4));
    $AdultBeMatings['December']=Cattle::whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')))->where('gender','=','母')
    ->WhereHas('linkmaterecord',function($query) {
        // 怀孕牛查看配种日期，距离本月是否是283+40=323天。
        $query->where('isLatest','latest')->where('pregCheckResult','=','怀孕')->whereBetween('mateDate',[date("Y-m-d",strtotime(date('Y')."-12-01 -323 day")),date("Y-m-d",strtotime(date('Y')."-12-01 +1 month -323 day"))])->whereHas('linkcow',function($query) {
            $query->whereDate('birthday','<',date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')));
    });
    })
    ->get()->count()+(round($AdultBeMatings['November']*0.4));
    BreedFanzhiYearlyPlan::create($AdultBeMatings);
    // 本年青年牛待配数
    $YouthBeMatings=array();
    $YouthBeMatings['time']=date('Y');
    $YouthBeMatings['type']=date('Y').'-待配青年母牛数';
    $YouthBeMatings['January']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01 -400 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -540 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -400 day'))]);
            });
    })->get()->count();
    $YouthBeMatings['February']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -399 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -370 day'))]);
            });
    })->get()->count()+(round($YouthBeMatings['January']*0.4));
    $YouthBeMatings['March']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-02-01  -340 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
            $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
                $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -369 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -340 day'))]);
    });
})->get()->count()+(round($YouthBeMatings['February']*0.4));
    $YouthBeMatings['April']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -339 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -310 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['March']*0.4));
$YouthBeMatings['May']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -309 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -280 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['April']*0.4));
$YouthBeMatings['June']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -279 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -250 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['May']*0.4));
$YouthBeMatings['July']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -220 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -249 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -210 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['June']*0.4));
$YouthBeMatings['August']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -209 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -180 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['July']*0.4));
$YouthBeMatings['September']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -179 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -150 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['August']*0.4));
$YouthBeMatings['October']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -149 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -120 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['September']*0.4));
$YouthBeMatings['November']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -119 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -90 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['October']*0.4));
$YouthBeMatings['December']=Cattle::whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))])->where('gender','=','母')
    ->DoesntHave('linkmaterecord')
    ->Orwherehas('linkmaterecord',function($query) {
       $query->where('isLatest','latest')->where('pregCheckResult','!=','怀孕')->wherehas('linkcow',function($query){
           $query->whereBetween('birthday',[date('Y-m-d',strtotime(date('Y').'-01-01 -89 day')),date('Y-m-d',strtotime(date('Y').'-01-01  -60 day'))]);
       });
})->get()->count()+(round($YouthBeMatings['November']*0.4));
BreedFanzhiYearlyPlan::create($YouthBeMatings);
             $thisYearBeMatingSum=array();
             $thisYearBeMatingSum['time']=date('Y');
             $thisYearBeMatingSum['type']=date('Y').'年-产犊牛总数';
             $thisYearBeMatingSum['January']=$AdultBeMatings['January']+$YouthBeMatings['January'];
             $thisYearBeMatingSum['February']=$AdultBeMatings['February']+$YouthBeMatings['February'];
             $thisYearBeMatingSum['March']=$AdultBeMatings['March']+$YouthBeMatings['March'];
             $thisYearBeMatingSum['April']=$AdultBeMatings['April']+$YouthBeMatings['April'];
             $thisYearBeMatingSum['May']=$AdultBeMatings['May']+$YouthBeMatings['May'];
             $thisYearBeMatingSum['June']=$AdultBeMatings['June']+$YouthBeMatings['June'];
             $thisYearBeMatingSum['July']=$AdultBeMatings['July']+$YouthBeMatings['July'];
             $thisYearBeMatingSum['August']=$AdultBeMatings['August']+$YouthBeMatings['August'];
             $thisYearBeMatingSum['September']=$AdultBeMatings['September']+$YouthBeMatings['September'];
             $thisYearBeMatingSum['October']=$AdultBeMatings['October']+$YouthBeMatings['October'];
             $thisYearBeMatingSum['November']=$AdultBeMatings['November']+$YouthBeMatings['November'];
             $thisYearBeMatingSum['December']=$AdultBeMatings['December']+$YouthBeMatings['December'];
             BreedFanzhiYearlyPlan::create($thisYearBeMatingSum);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            $errors= $e->getmessage();
            \Log::info('年繁殖计划表生成错误'.$e);
            }
    }
}
