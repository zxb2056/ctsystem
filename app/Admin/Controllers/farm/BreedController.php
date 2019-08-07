<?php

namespace App\Admin\controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CattleSireDepository;
use App\Models\BreedMateRecord;
use App\Models\SemenBrokeRecord;
use App\Models\Cattle;
use App\Models\BreedSemenRemain;
use App\Models\BreedPregnancyCheck;
use App\Models\BreedCalv;
use App\Models\CattlePedigree;
use DB;
use App\Models\BreedAftercare;
use App\Models\BreedDisease;
use App\Models\BreedFanzhiMonthPlan;
use App\Models\BreedFanzhiYearlyPlan;
use App\Models\BreedFanzhiMonthReport;
use App\Models\BreedFanzhiYearlyReport;

class BreedController extends Controller
{
    //
    public function mateInput(){
        $semens=BreedSemenRemain::where('remain','>','0')->orderBy('id','desc')->get();
        return view('admin.manager.breed.mateinput',compact('semens'));
    }

    public function yunjianinput(){
        return view('admin.manager.breed.yunjianinput');
    }
    public function chandu(){
        return view('admin.manager.breed.chandu');
    }
    public function aftercare(){
        return view('admin.manager.breed.aftercare');
    }
    public function mateplan(Request $request){
        $datas=array();
        $datas['year']=$request->input('year');
        $datas['month']=$request->input('month');
        $years=BreedFanzhiMonthPlan::orderBy('id','desc')->get(['year','month']);
        $grouped= $years->groupby('year');
        $grouped->toArray();
        // dd(empty($datas['year']));
        if(empty($datas['year']) || empty($datas['month'])){
             $plans=BreedFanzhiMonthPlan::orderBy('id','desc')->first();
        }
        else{
            $plans=BreedFanzhiMonthPlan::where('year',$datas['year'])->where('month',$datas['month'])->first();
        }
     return view('admin.manager.breed.mateplan',compact('grouped','plans'));
    }
    public function mateplan_yearly(Request $request){
        $reports['semenUseAmount']=BreedMateRecord::whereBetween('mateDate',[date('Y-m-01',strtotime('-1 month')),date('Y-m-d',strtotime(date('Y-m').'-01 -1 day'))])->sum('useAmount');
        dd($reports);
        $datas=array();
        $datas['year']=$request->input('year',date('Y'));
        $years=BreedFanzhiYearlyPlan::get(['time'])->groupBy('time');
        $yearPlans=BreedFanzhiYearlyPlan::where('time',$datas['year'])->get();
        if($yearPlans->isEmpty()){
            return view('admin.manager.breed.mateplan_yearly_error');
        }else{
            return view('admin.manager.breed.mateplan_yearly',compact('years','datas','yearPlans'));
        }
        
    }
    public function waitmate(Request $request){
        // 待配母牛 1、首先大于13月龄，尚未配种的母牛  同时体重大于350kg 生产性能测定表里有的话 2、产后40天以上，尚未配种的    
        //  3、孕检未孕的牛只   4、'所有已经有配种记录，且未孕检的，为待孕检牛只。
        //  4、流产，早产这些和产犊记录在一个表
        // 5、如果一直没有孕检的情况？一直显示待孕检。直到产犊，把待孕检状态调整为0.
        $needDate=date('Y-m-d',strtotime("-400 day"));
        $waitmates=Cattle::whereDate('birthday','<=',$needDate)->where('gender','=','母')
        ->DoesntHave('linkmaterecord')
        ->orWhereHas('linkmaterecord',function($query){
            // 增加isCalv字段，如果是done说明已经有产犊记录，如果是no，说明没有产犊。
            $query->where('isCalv','done')->whereHas('linkcalv',function($query){
                // 不管有几条配种记录，进行对应母牛号的产犊记录查询
                // 这个地方要查询最新一条产犊记录
                $query->where('isLatest','Latest')->where('calvDate','<=',date("Y-m-d",strtotime("-40 day")))->wherehas('linkcattle',function($query){
                    $query->whereDate('birthday','<=',date('Y-m-d',strtotime("-400 day")));
                });
            });
        })
        ->paginate(10);
        return view('admin.manager.breed.waitmate',compact('waitmates'));
    }
    public function fanzhidisease(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['cowID']=$request->input('cowID','');
        $datas['startDate']=$request->input('startDate','');
        $datas['stopDate']=$request->input('stopDate','');
        $fanzhiDiseases=BreedDisease::where('cowID','like','%'.$datas['cowID'].'%')
        ->where(function($query) use($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('dayOfOnset',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('dayOfOnset','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('dayOfOnset','<=', $stopdate); 
            }
            })    
            ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.breed.fanzhidisease',compact('fanzhiDiseases','datas'));
    }
    public function expected_birth(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['cowID']=$request->input('cowID','');
        $expectedCattle=BreedMateRecord::where('isLatest','latest')->where('isCalv','no')
        ->whereHas('linkcow',function($query) use($datas){
            if(!empty($datas['cowID'])){
                $query->where('cattleID','like','%'.$datas['cowID'].'%');
            }
        })
        ->paginate($request->input('showitem',10));
        return view('admin.manager.breed.expected_birth',compact('expectedCattle','datas'));
    }
    public function month_report(Request $request){
        $datas=array();
        $datas['year']=$request->input('year');
        $datas['month']=$request->input('month');
        $years=BreedFanzhiMonthReport::orderBy('id','desc')->get(['year','month']);
        $grouped= $years->groupby('year');
        $grouped->toArray();
        // dd($grouped);
        if(empty($datas['year']) || empty($datas['month'])){
            $reports=BreedFanzhiMonthReport::orderBy('id','desc')->first();
       }
       else{
           $reports=BreedFanzhiMonthReport::where('year',$datas['year'])->where('month',$datas['month'])->first();
       }
        return view('admin.manager.breed.fanzhibaobiao',compact('grouped','reports'));
    }
    public function yearly_report(Request $request){
        $datas=array();
        $datas['year']=$request->input('year');
        $years=BreedFanzhiYearlyReport::orderBy('id','desc')->get(['year']);
        $grouped= $years->groupby('year');
        $grouped->toArray();
        if(empty($datas['year'])){
            $reports=BreedFanzhiYearlyReport::orderBy('id','desc')->first();
       }
       else{
           $reports=BreedFanzhiYearlyReport::where('year',$datas['year'])->first();
       }
        return view('admin.manager.breed.breed_report_yearly',compact('grouped','reports'));
    }
    public function mateRecordStore(Request $request){
        $datas=array();
        // dd($request->all());
        //验证母牛号是否在群体表中
        $cow=$request->cowID;
        $hasCow=Cattle::where('cattleID','=',$cow)->where('gender','=','母')->first();
        
        if(empty($hasCow)){
            return redirect()->back()->withInput()->with('error','没有此牛号，原因是牛号错误或者牛号尚未存入系统，请核对。');
        }else{
            $mateDate=$request->mateDate;
            if(strtotime($mateDate)>strtotime(date('Y-m-d'))){
            return redirect()->back()->withInput()->with('error','配种日期必须在大于等于今天');
            }
            else{
                $whetherMateRepeat=BreedMateRecord::where('cow_id','=',$hasCow->id)->where('mateDate','=',$request->mateDate)->first();
                if(!empty($whetherMateRepeat)){
                    return redirect()->back()->with('error','该条配种记录已经存在，请核对');
                }
                try{
                    DB::beginTransaction();
                    $datas['cow_id']=$hasCow->id;
                    $datas['semen_id']=$request->semen_id;
                    $datas['useAmount']=$request->useAmount;
                    $datas['mateDate']=$request->mateDate;
                    $datas['mateTime']=$request->mateTime;
                    $datas['PIC']=$request->PIC;
                    $start  = date_create($hasCow->birthday);
                    $end 	= date_create(); // Current time and date
                    $diff  	= date_diff( $start, $end )->days;
                    $datas['mateAgeOfDay']=$diff;
                    // 配种次数
                    $mateOldorders=BreedMateRecord::where('cow_id',$hasCow->id)->where('isLatest','latest')->first();
                    if(empty($mateOldorders)){
                        $datas['mateOrder']='1';
                    }
                    else {
                        $datas['mateOrder']=$mateOldorders->mateOrder + 1;
                        $mateOldorders->isLatest='0';
                        $mateOldorders->save();
                    }
                    
                     // 验证冻精使用数量减库存是否大于0
                    $semens=BreedSemenRemain::where('semen_id',$datas['semen_id'])->first();
                //    dd($semens);
                    $minus=$semens->remain-$datas['useAmount'];
                    if($minus<0){
                        return redirect()->back()->withInput->with('error','冻精使用量超过库存量。');
                    }else{
                        // 同时繁育冻精库存表remain减去冻精数量
                        $semens->remain -= $datas['useAmount'];
                        $semens->save();
                    }
                    // dd($datas);       
                    BreedMateRecord::create($datas);
                     DB::commit();
                    return redirect()->back()->withInput()->with('success','配种记录提交成功');
                }catch(\Exception $e){
                    DB::rollback();
                    $errors= $e;
                    return view('exception.sqlerror',compact('errors'));
                }
                
            }
            }
    }
    public function semen_broke_record(Request $request){
        // dd($request->all());
        SemenBrokeRecord::create($request->all());
        return redirect()->back()->with('success','损坏信息提交成功!');

    }
    public function pregnancy_check_store(Request $request){
        // dd($request->all());
        // validate cowID is correct?
        $whetherExistCowID=Cattle::where('cattleID','=',$request->cowID)->where('gender','母')->first();
        if(empty($whetherExistCowID)){
            return redirect()->back()->withInput()->with('error','母牛号不存在，请核对');
        }else{
            try{
            DB::beginTransaction();
            $datas=array();
            $datas['cow_id']=$whetherExistCowID->id;
            $datas['cowID']=$request->cowID;
            $datas['checkDate']=$request->checkDate;
            $datas['checkResult']=$request->checkResult;
            $datas['related_disease']=$request->related_disease;
            $datas['note']=$request->note;
            $datas['checker']=$request->checker;
            BreedPregnancyCheck::create($datas);          
            $mateRecords=BreedMateRecord::where('cow_id','=',$whetherExistCowID->id)->where('isLatest','latest')->first();
            // dd($mateRecords);
            $mateRecords->pregCheckDay=$datas['checkDate'];
            $mateRecords->pregCheckResult=$datas['checkResult'];
            
            if($datas['checkResult'] == '怀孕'){
                // 本次配种日期减去上次产犊日期，需要查找上一条配种记录，且isCalv=done,获得其calvDate.
                $beforeMate = BreedMateRecord::where('cow_id','=',$whetherExistCowID->id)->where('mateDate','<',$mateRecords->mateDate)->where('isCalv','done')->orderBy('id','desc')->first();
                if(!empty($beforeMate)){
                    $start = date_create($mateRecords->mateDate);
                    $end= date_create($beforeMate->calvDate);
                    $datas['DayOpen'] = date_diff( $start, $end )->days;
                    $mateRecords->DayOpen= $datas['DayOpen'];
                    // dd($datas['DayOpen']);
                }
                
            }
            $mateRecords->save();
            DB::commit();
            return redirect()->back()->with('success','孕检信息保存成功');

            }
            catch(\Exception $e){
                DB::rollback();
                $errors= $e;
                return view('exception.sqlerror',compact('errors'));
            }
            
        }

    }
    public function calv_store(Request $request){
        // dd($request->all());
        //产犊的逻辑比较多
        // 1.产犊表插入；2.牛只信息表插入。3.母牛胎次增加1，4.系谱表里增加，犊牛号，父母号 
        // 5.还要加入初生重。存入生产性能测定表里。6.同时修改配种记录表里，对应的配种记录为done.
        $whetherExistCowID=Cattle::where('cattleID','=',$request->cowID)->where('gender','母')->first();
        //检测犊牛号是否重复
        $whetherExistCalv=Cattle::where('cattleID','=',$request->calvEarTag)->first();
        if(empty($whetherExistCowID)){
            return redirect()->back()->withInput()->with('error','母牛号不存在，请核对');
        }
        if(!empty($whetherExistCalv)){
            return redirect()->back()->with('error','犊牛耳号已经存在，请核对');
        }
            $mateinfos=BreedMateRecord::where('cow_id','=',$whetherExistCowID->id)->orderBy('id','desc')->first();
            if(empty($mateinfos->linksemen->breed)){
                return redirect()->back()->withInput()->with('error','此母牛尚没有配种记录，请先完善配种记录，再提交产犊记录');
            }
            $datas=array();
            $datas['cow_id']=$whetherExistCowID->id;
            $datas['cowID']=$request->cowID;
            $datas['calvDate']=$request->calvDate;
            $datas['calvStatus']=$request->calvStatus;
            if($request->calvStatus == '流产'){
                // 找到上一条流产犊牛编号 LC+0001
                $oldLCid=BreedCalv::where('calvStatus','=','流产')->max('id');
                if(!empty($oldLCid)){
                    $oldLC=BreedCalv::find($oldLCid);
                    $a=$oldLC->calvEarTag;
                    $b=explode('_',$a);
                    try{
                        $c='LC_'.sprintf('%04d',$b[1]+1);
                    }catch(\Exception $e){
                        $errors= '流产牛号解析错误'.$e->getMessage();
                    return view('exception.sqlerror',compact('errors'));
                    }
                   
                   $datas['calvEarTag']=$c; 
                }
                else{
                    $datas['calvEarTag']='LC_'.'0001';
                }
                // 如果是流产，胎次等于1.1，1.2等。如果没有产犊记录，记为0.1，0.2
                // 根据cow_id查找产犊表里是否有记录，如果没有则本次产犊胎次记为1，如果有获得上一次胎次，然后本次加1，存储
                $pregNum=BreedCalv::where('cow_id',$datas['cow_id'])->orderBy('id','desc')->first();
                if(empty($pregNum)){
                    $datas['pregnancyNum'] = '0.1';
                }
                    else {
                        $datas['pregnancyNum']= $pregNum->pregnancyNum + 0.1;
                    }
                    $datas['calvWeight']='';
                    $datas['calvGender']='';
                    $datas['Deliveryer']=$request->Deliveryer;
            }else{
                $datas['calvEarTag']=$request->calvEarTag;
                // 如果非流产牛
                $pregNum=BreedCalv::where('cow_id',$datas['cow_id'])->where('calvStatus','!=','流产')->orderBy('id','desc')->first();
                if(empty($pregNum)){
                    $datas['pregnancyNum'] = '1';
                } else {
                    $datas['pregnancyNum'] = $pregNum->pregnancyNum + 1;
                    // 计算产犊间隔
                    $thisdate = date_create($datas['calvDate']);
                    $beforecalvdate = date_create($pregNum->calvDate);
                    $datas['calvInterval'] = date_diff($thisdate,$beforecalvdate)->days;
                }

            $datas['calvWeight']=$request->calvWeight;
            $datas['calvGender']=$request->calvGender;
            $datas['Deliveryer']=$request->Deliveryer;

            }
            $cattleinfos=array();
            $cattleinfos['cattleID']=$request->calvEarTag;
            $cattleinfos['birthday']=$request->calvDate;
            $cattleinfos['birthWeight']=$request->calvWeight;
            $cattleinfos['gender']=$request->calvGender;
            $cattleinfos['whichBreed']=$mateinfos->linksemen->breed;
            $cattleinfos['whereComefrom']='自繁';
            $cattleinfos['pregnancyNum']=$datas['pregnancyNum'];
            $cattleinfos['status']='在群';
            try{
                // 产犊表
                $newCalv=BreedCalv::create($datas);
                // 配种记录表更新isCalv
                $mateinfos->isCalv='done';
                $mateinfos->calvDate = $datas['calvDate'];
                $mateinfos->pregnancyNum = $datas['pregnancyNum'];
                $mateinfos->save();
                // 同时之前的产犊记录，isLatest变为0
                $calvId=BreedCalv::where('cow_id','=',$newCalv->cow_id)->where('id','!=',$newCalv->id)->max('id');
                $updates=BreedCalv::find($calvId);
                if(!empty($updates)){
                    $updates->isLatest='0';
                    $updates->save();
                }

                // 母亲的胎次加1
                $whetherExistCowID->pregnancyNum =$datas['pregnancyNum'];
                $whetherExistCowID->save();
                // 如果是流产牛只,犊牛信息不添加到牛群信息表。
                if($newCalv->calvStatus == '流产'){
                    return redirect()->back()->with('success','流产信息保存成功');
                }
                else{
                        //非流产的情况下，插入牛只信息表
                        $cattles=Cattle::create($cattleinfos);
                         // 系谱表
                        $pedigrees=array();
                        $pedigrees['cattle_id']=$cattles->id;
                        $pedigrees['dam_id']=$datas['cow_id'];
                        $pedigrees['sire_id']=$mateinfos->semen_id;
                        CattlePedigree::create($pedigrees);
                        return redirect()->back()->with('success','产犊信息保存成功');
                }

            }catch(\Exception $e){
                $errors= $e;
                return view('exception.sqlerror',compact('errors'));
                }
    }

    public function after_care_store(Request $request){
        // dd($request->all());
        // 验证母牛号是否存在 
        $whetherExistCowID=Cattle::where('cattleID','=',$request->cowID)->where('gender','母')->first();
        if(empty($whetherExistCowID)){
            return redirect()->back()->withInput()->with('error','母牛号不存在，请核对');
        }
        $request['cow_id']=$whetherExistCowID->id;
        BreedAftercare::create($request->all());
        return redirect()->back()->with('success','产后护理信息保存成功');
    }
    public function breed_disease_store(Request $request){
        // dd($request->all());
        $whetherCowIn=Cattle::where('cattleID','=',$request->cowID)->where('gender','=','母')->first();
        if(empty($whetherCowIn)){
            return redirect()->back()->with('error','母牛号不存在，请核对');
        }
        else
        {
            $request['cow_id']=$whetherCowIn->id;
            BreedDisease::create($request->all());
            return redirect()->back()->with('success','疾病信息提交成功');
        }
    }
    public function breed_disease_update(Request $request){
        // dd($request->all());
        // 提交的值只有id,symptom,therapeutic,result几项。其它的不可修改
        $fanzhiDiseases=BreedDisease::findOrFail($request->id);
        $fanzhiDiseases->symptom = $request->symptom;
        $fanzhiDiseases->therapeutic = $request->therapeutic;
        $fanzhiDiseases->result = $request->result;
        $fanzhiDiseases->save();
        return redirect()->back()->with('success','疾病信息保存成功！');

    }
}
