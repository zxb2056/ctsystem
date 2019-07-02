<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BreedMateRecord;
use App\Models\Cattle;
use DB;
use App\Models\BreedPregnancyCheck;
use App\Models\BreedFanzhiYearlyPlan;
use App\Models\BreedFanzhiMonthPlan;
use App\Models\BreedCalv;
use App\models\BreedAftercare;
use App\Models\BreedFanzhiMonthReport;

class BreedReportMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breed:reportmonth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
                //初始化数组及基准时间，月份。
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
                }
                catch(\Exception $e){
                    $errors= $e->getMessage();
                    \Log::info('error:'.$errors);
                }
    }
}
