<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BreedMateRecord;
use App\Models\Cattle;
use App\Models\BreedFanzhiMonthPlan;
use DB;

class BreedMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breed:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description。生成月繁殖计划表';

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
        //
        try{

            $monthPlans=array();
            $monthPlans['year']=date('Y');
            $monthPlans['month']=date('m');
            $monthPlans['lastMonthMated']=BreedMateRecord::where('isLatest','latest')->whereBetween('mateDate',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
            $monthPlans['lastMonthPregCheck']=BreedMateRecord::where('isLatest','latest')->whereBetween('pregCheckDay',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->get()->count();
            $monthPlans['lastMonthPregCattleNum']=BreedMateRecord::where('isLatest','latest')->whereBetween('pregCheckDay',[date('Y-m-d',strtotime(date('Y-m').'-01 -1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->where('pregCheckResult','怀孕')->get()->count();
            // 孕检受胎率
            if($monthPlans['lastMonthPregCheck'] == '0'){
                $monthPlans['lastMonthPregRation'] = '0';
            }else{
                $monthPlans['lastMonthPregRation']=round($monthPlans['lastMonthPregCattleNum']/$monthPlans['lastMonthPregCheck']*100,2)."%";
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
                    $query->whereDate('calvDate','<',date('Y-m-d',strtotime(date('Y-m').'-01 +1 month -51 day')))->wherehas('linkcattle',function($query){
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
    }
    catch(\Exception $e){
        $errors= $e->getmessage();
        \Log::info('年繁殖计划表生成错误'.$e);
        }
    }
}
