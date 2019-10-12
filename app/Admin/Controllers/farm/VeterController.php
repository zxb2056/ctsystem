<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cattle;
use App\Models\CattleBarn;
use App\Models\VeterDisease;
use App\Models\VeterDailyTreat;
use App\Models\VeterDrugRemain;
use App\Models\VeterDailyDrugUse;
use App\Models\VeterAntiepidemicType;
use App\Models\CattleBarnMapIndividual;
use App\Models\VeterAntiepidemic;
use DB;
use App\Models\VeterQuarantine;
use App\Models\VeterTrimHoof;
use App\Models\VeterTrimHoofDailyTreat;
use App\Models\VeterTrimHoofDailyDrugUse;

class VeterController extends Controller
{
    //
    public function disease_input(){
        return view('admin.manager.Veterinary.disease_input');
    }
    public function disease_input_store(Request $request)
    {
        // dd($request->all());
        // 验证牛号是否存在，如不存在返回
        $whetherExist = Cattle::where('cattleID',$request->cattleID)->get();
        if(empty($whetherExist->first())){
            $errors = '牛号不存在';
            return view('exception.sqlerror',compact('errors'));
        }elseif($whetherExist->count()>1){
            $errors = '此牛号系统中有重复，请先去重。';
            return view('exception.sqlerror',compact('errors'));
        }
        // 如果该牛此前有诊疗记录，没有结束，提示进行原先的更新，而不是重新开始新记录。
        $ifdoneDisease = VeterDisease::where('cattleID',$request->cattleID)->get()->last();
        if(!empty($ifdoneDisease))
        {
            if($ifdoneDisease->status == 'ing')
            {
                return redirect()->back()->with('error','该牛的上次疾病还没有结束，请结束之后再提交。或者进行更新');
            }
        }
        // 如果验证通过，把数据插入数据库,疾病表
        $disease = array();
        $disease['cattle_id'] = $whetherExist->first()->id;
        $disease['cattleID'] = $request->cattleID;
        $disease['dateOfOnset'] = $request->dateOfOnset;
        $disease['nameOfDisease'] = $request->nameOfDisease;
        $disease['symptom'] = $request->symptom;
        $disease['outcome'] = $request->outcome;
        $disease['PIC'] = $request->PIC;
        $disease['firstTherapeutic'] = $request->startTreatdate;
        $disease['status'] = $request->status;
        if($request->status == 'done'){
            $disease['endTherapeutic'] = $request->startTreatdate;
        }
        $newdisease = VeterDisease::create($disease);
        // 每日处理记录表
        $daily_treat = array();
        $daily_treat['disease_id'] = $newdisease->id;
        $daily_treat['cattle_id'] = $newdisease->cattle_id;
        $daily_treat['cattleID'] = $newdisease->cattleID;
        $daily_treat['treat_date'] = $request->startTreatdate;
        $daily_treat['symptom'] =$request->symptom;
        $daily_treat['therapeuticWay'] = implode(",",$request->therapeuticway);
        $daily_treat['note'] = $request->note;
        $daily_treat['PIC'] = $request->PIC;
        $daily_treat['status'] = $request->status;
        $day_treat = VeterDailyTreat::create($daily_treat);
        // 治疗方法专门建一个表利用id对应
        // 插入治疗药物表

        // 把drugid，由字符串转为数组，同时储存药名drug_use，按顺序对应
        $drug_id = $request->drug_id;
        $model = 'VeterDailyDrugUse';
        $this->daily_drug_use($drug_id,$day_treat->id,$request,$model);
        return redirect()->back()->with('success','诊疗信息保存成功');

  
    }
    public function diseasing_list()
    {        
        // 小于6月龄的日期
        $diseased_cattle = VeterDisease::where('status','ing');
        $counts =  $diseased_cattle->get()->count();
        $calfs = $diseased_cattle ->whereHas('linkcattle',function($query){
            $query->where('birthday','>',date('Y-m-d',strtotime("-6 month")));
        })->count();
        $diseasing = VeterDisease::where('status','ing')->paginate(10);
        return view('admin.manager.Veterinary.diseasing_list',compact('diseasing','counts','calfs'));
    }
    public function diseasing_daily_update($id)
    {
        // 此外id是传过来的疾病id
        $disease_info = VeterDisease::where('id',$id)->first();
        return view('admin.manager.Veterinary.diseasing_daily_update',compact('disease_info'));
    }
    public function diseasing_daily_store(Request $request,$id)
    {
        $original_diseases = VeterDisease::where('id',$id)->first();
        // dd($request->all());
        // 储存到每日治疗表
        $daily_treats = array();
        $daily_treats['disease_id'] = $id;
        $daily_treats['cattle_id'] = $original_diseases->cattle_id;
        $daily_treats['cattleID'] = $original_diseases->cattleID;
        $daily_treats['treat_date'] =  $request->treate_date;
        $daily_treats['symptom'] =  $request->symptom;
        $daily_treats['therapeuticWay'] =implode(",",$request->therapeuticway);
        $daily_treats['note'] = $request->note;
        $daily_treats['PIC'] = $request->PIC;
        $daily_treats['status'] = $request->status;
        if($request->new_disease_name1 == '0'){
            $daily_treats['rename_disease'] = '0';
        }else {
            $daily_treats['rename_disease']= $request->newd_name;
        }
        $new_day_treat = VeterDailyTreat::create($daily_treats);
        //  储存到每日药品表
        $daily_drug = array();
        $daily_drug['daily_treat_id'] = $new_day_treat->id;
        $drug_id = $request->drug_id;
        $model = 'VeterDailyDrugUse';
        $this->daily_drug_use($drug_id,$new_day_treat->id,$request,$model);
        // 返回前端，提示信息保存成功
        return redirect()->back()->with('success','诊疗信息保存成功');
    }
    public function antiepidemic_batch(){
        $barns = CattleBarn::get();
        $epidemics = VeterAntiepidemicType::get();
        return view('admin.manager.Veterinary.antiepidemic_batch',compact('epidemics','barns'));
    }
    public function antiepidemic_single(){
        $epidemics = VeterAntiepidemicType::get();
        return view('admin.manager.Veterinary.antiepidemic_single',compact('epidemics'));
    }
    public function antiepidemic_store(Request $request){
        // dd($request->all());
        $antis = array();
        $antis['anti_day'] =$request->anti_day;
        $antis['epidemic_type'] =$request->epidemic_type;
        $antis['drug_id'] =$request->drug_id;
        $antis['use_amount'] =$request->use_amount;
        $antis['pic'] =$request->pic;
        // 如果有牛舍号，说明是整舍
        if(!empty($request->barn_id))
            {
                // 注意减去库存
                $antis['barnId'] =$request->barn_id;
                $antis['barnOrSingle'] = '0';
                $cattles = CattleBarnMapIndividual::where('barn_id',$request->barn_id)->get();
                if($cattles->count() == 0){
                    return redirect()->back()->with('danger','牛舍为空，请重新选择');
                }elseif($cattles->count() == 1){
                    $antis['cattle_id'] = $cattles->first()->cattle_id;
                    // 防疫日龄-出生日期
                    $birthday=Cattle::where('id',$antis['cattle_id'])->first()->birthday;
                    $anti_day=date_create($antis['anti_day']);
                    $birthday=date_create($birthday);
                    $antis['ageOfDay'] = date_diff($anti_day,$birthday)->days;
                    $use_amount = $antis['use_amount'];
                    $antis['money']= $this->minus_remain($antis['drug_id'],$use_amount);
                    VeterAntiepidemic::create($antis);
                    return redirect()->back()->with('success','防疫信息保存成功');
                }else{
                    
                    $drug_remains =  VeterDrugRemain::where('drug_id',$antis['drug_id'])->where('remain','>',0)->get();
                    if($drug_remains->count() == 1){
                        $remains = $drug_remains->first()->remain;
                    }elseif($drug_remains->count() > 1){
                        
                        $remains = 0;
                        foreach($drug_remains as $r){
                            $remains += $r->remain;
                        }
                    }
                    
                    if($remains < ( $antis['use_amount']*$cattles->count())){
                        return redirect()->back()->with('error','兽药库存数量不足，请减少牛头数，或由仓库取');
                    }
                    foreach($cattles as $cattle){
                            $antis['cattle_id'] = $cattle->cattle_id;
                         // 防疫日龄-出生日期
                            $birthday=Cattle::where('id',$antis['cattle_id'])->first()->birthday;
                            $anti_day=date_create($antis['anti_day']);
                            $birthday=date_create($birthday);
                            $antis['ageOfDay'] = date_diff($anti_day,$birthday)->days;
                            $use_amount = $antis['use_amount'];
                            $antis['money']= &$this->minus_remain($antis['drug_id'],$use_amount);
                            VeterAntiepidemic::create($antis); 
                            $antis['money'] = null;
                            
                    }
                }
                return redirect()->back()->with('success','防疫信息保存成功');
            }
            else
            {
                $drug_remains =  VeterDrugRemain::where('drug_id',$antis['drug_id'])->where('remain','>',0)->get();
                if($drug_remains->count() == 1){
                    $remains = $drug_remains->first()->remain;
                }elseif($drug_remains->count() > 1){
                    
                    $remains = 0;
                    foreach($drug_remains as $r){
                        $remains += $r->remain;
                    }
                }
                if($remains < $antis['use_amount']){
                    return redirect()->back()->with('error','兽药库存数量不足，或由仓库取');
                }
                // 如果只有一头牛
                // dd($request->all());
                $cattle = Cattle::where('cattleID',$request->cattleID)->first();
                if(empty($cattle)){
                    return redirect()->back()->with('error','牛号不存在');
                }
                $antis['cattle_id'] =$cattle->id;
                $antis['barnId'] = CattleBarnMapIndividual::where('cattle_id',$antis['cattle_id'])->first()->barn_id;
                $antis['barnOrSingle'] = '1';
                $birthday= $cattle->birthday;
                $anti_day=date_create($antis['anti_day']);
                $birthday=date_create($birthday);
                $antis['ageOfDay'] = date_diff($anti_day,$birthday)->days;
                $use_amount = $antis['use_amount'];
                $antis['money']= $this->minus_remain($antis['drug_id'],$use_amount);
                VeterAntiepidemic::create($antis);
                return redirect()->back()->with('success','防疫信息保存成功');
            }
    }
    // &地址引用，方便foreach的时候销毁原数据。
    public function &minus_remain($drug_id,$use_amount)
    {
        static $money = 0;
            $drug_remains =  VeterDrugRemain::where('drug_id',$drug_id)->where('remain','>',0)->get();
            // dd($drug_remains->count());
            $antis['use_amount']=$use_amount;
            // dd($use_amount);
            if($drug_remains->count() == 1)
                {
                    $money += $drug_remains->first()->price * $antis['use_amount'];
                    // dd($antis['money']);
                    $drug_remains->first()->remain = $drug_remains->first()->remain - $antis['use_amount'];
                    $drug_remains->first()->save();
                }elseif($drug_remains->count() > 1)
                {
                    $c=0;
                    if($drug_remains[$c]->remain >=$antis['use_amount'] ){
                        // dd('1个好呀');
                        $drug_remains[$c]->remain = $drug_remains[$c]->remain -$antis['use_amount'];
                        $money += $drug_remains[$c]->price * $antis['use_amount'];
                        $drug_remains[$c]->save();
                    }else{
                        // dd('2个好呀');
                            $money += $drug_remains[$c]->remain * $drug_remains[$c]->price;
                            $use_amount = $antis['use_amount'] - $drug_remains[$c]->remain;
                            $drug_remains[$c]->remain = 0;
                            $drug_remains[$c]->save();
                            $this->minus_remain($drug_id,$use_amount);
 
                    }
                }
                return $money;

 
    }
    public function antiepidemic_history(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['cattleID']=$request->input('cattleID','');
        $datas['startdate']=$request->input('startdate','');
        $datas['stopdate']=$request->input('stopdate','');
        $datas['epidemic_type']=$request->input('epidemic_type','');
        $epidemics_history = VeterAntiepidemic::whereHas('linkcattle',function($query) use($datas){
            if(!empty($datas['cattleID'])){
                $query->where('cattleID','like','%'.$datas['cattleID'].'%');
            }
        })
        ->where(function($query) use($datas){
            $startdate=$datas['startdate'];
            $stopdate=$datas['stopdate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('anti_day',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('anti_day','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('anti_day','<=', $stopdate); 
            }
            })
        ->where(function($query) use($datas){
            if(!empty($datas['epidemic_type'])){
                $query->whereHas('epidemic_name',function($query) use($datas){
                    $query->where('name','like','%'.$datas['epidemic_type'].'%');
                });
            }
        })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.Veterinary.antiepidemic_history',compact('epidemics_history','datas'));
    }
    public function Quarantine_input(){
        $epidemics = VeterAntiepidemicType::get();
        return view('admin.manager.Veterinary.Quarantine_input',compact('epidemics'));
    }
    public function Quarantine_store(Request $request)
    {
        // dd($request->all());
        $request['cattle_id'] = Cattle::where('cattleID',$request->cattleID)->first()->id;
        VeterQuarantine::create($request->all());
        return redirect()->back()->with('success','检疫信息保存成功！');

    }
    public function Quarantine_history(Request $request){
        $datas=array();
        $datas['showitem']= $request->input('showitem',10);
        $datas['startDate']= $request->input('startDate','');
        $datas['stopDate']= $request->input('stopDate','');
        $datas['cattleID']= $request->input('cattleID','');
        $qua_history = VeterQuarantine::where(function($q) use($datas){
            if(!empty($datas['cattleID'])){
                $q->where('cattleID','like','%'.$datas['cattleID'].'%');
            }
        })
        ->where(function($query) use($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('quarantine_day',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('quarantine_day','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('quarantine_day','<=', $stopdate); 
            }
            })
            ->paginate($request->input('showitem',10));
        return view('admin.manager.Veterinary.Quarantine_history',compact('datas','qua_history'));
    }
    public function plus_epidemic_type(Request $request)
    {
        // 验证唯一性
        $this->validate(request(),[
            'name'=>'required|unique:veter_antiepidemic_types',

        ],['name.unique'=>'该疫病已经存在，请不要重复添加',]);
        DB::table('veter_antiepidemic_types')->insert(array('name'=>$request->name));
        return redirect()->back();
    }
    public function trim_hoof_input(){
        return view('admin.manager.Veterinary.trim_hoof_input');
    }
    public function trim_hoof_history(Request $request){
        $trims = VeterTrimHoof::orderBy('id','desc')->paginate(10);
        return view('admin.manager.Veterinary.trim_hoof_history',compact('trims'));
    }
    public function trim_hoof_detail($id){
        $trims = VeterTrimHoof::where('id',$id)->first();
        $details = VeterTrimHoofDailyTreat::where('veter_trim_id',$id)->orderby('which_hoof','asc')->get();
        return view('admin.manager.Veterinary.trim_hoof_detail',compact('trims','details'));
        // 还有用药怎么显示？
        // 决定在新打开页面，以诊疗卡片形式显示
    }
    public function trim_drug_use()
    {
        dd('以卡片形式展示');
    }
    public function trim_hoof_store(Request $request)
    {
        $if_exist = VeterTrimHoof::where('cattleID',$request->cattleID)->where('trim_date',$request->trim_day)->first();
        if(!empty($if_exist)){
            return redirect()->back()->with('warn','牛号'.$request->cattleID.'在当前日期'.$request->trim_day.'已经有记录，请核对');
        }
        
        //第一种情况，普修，需要把普修之后的所有input设置为disabled,即不往后台传数据。
        // 同时后台，不直接使用create,而是采用数据赋值，以面对js失效的时候，后续数据传过来。
        if($request->diseaseOrCare == '0'){
            // dd('普修');首先验证当天日期该牛号是否已经有记录，有则提醒已经存在。
            // 建立数组
            $puxiu = array();
            $cattle = Cattle::where('cattleID','=',$request->cattleID)->first();
            if(empty($cattle)){
                return redirect()->back()->with('warn','牛号不存在，请核对是否已经不在群');
            }
            $puxiu['cattle_id'] = $cattle->id;
            $puxiu['cattleID'] = $request->cattleID;
            $puxiu['trim_date'] = $request->trim_day;
            $puxiu['diseaseOrCare'] = $request->diseaseOrCare;
            $puxiu['trim_num'] = count($request->hoof);
            $puxiu['which_hoof'] = implode(",",$request->hoof);
            $puxiu['pic'] = $request->pic;
            $puxiu['end_day'] = $request->trim_day;
            $puxiu['outcome'] = '普修';
            VeterTrimHoof::create($puxiu);
            return redirect()->back()->with('success','修蹄信息保存成功');
        }
        if($request->diseaseOrCare == '1'){
            //    先判断药品用量是否为空，避免插入日数据
            if(!empty($request->drug_id)){
                foreach($request->dosage as $dosage){
                    if(empty($dosage)){
                        return redirect()->back()->with('error','有药品用量为空，请重新提交');
                    }
                }
            }
            if(!empty($request->RF_drug_id)){
                foreach($request->RF_dosage as $dosage){
                    if(empty($dosage)){
                        return redirect()->back()->with('error','有药品用量为空，请重新提交');
                    }
                }
            }
            $BT = array();
            $cattle = Cattle::where('cattleID','=',$request->cattleID)->first();
            if(empty($cattle)){
                return redirect()->back()->with('warn','牛号不存在，请核对是否已经不在群');
            }
            $BT['cattle_id'] = $cattle->id;
            $BT['cattleID'] = $request->cattleID;
            $BT['trim_date'] = $request->trim_day;
            $BT['diseaseOrCare'] = $request->diseaseOrCare;
            $BT['trim_num'] = count($request->hoof);
            $BT['which_hoof'] = implode(",",$request->hoof);
            $BT['pic'] = $request->pic;
            // 结束日期要看当天是否已经治疗完毕
            // 结果，如当天治疗完毕，写上治疗结果;如果当天没有结束，先空着，等结束了再写。
            // 因为可能有几个蹄一块修，没有办法出个总的结果，所以普修的时候，结果是普修。有病蹄的情况，具体看日治疗情况，分为ing，done.
                $BT['end_day'] = null;
                $BT['outcome'] = '普修的是';
                foreach($request->hoof as $hoof){
                    if($hoof == '1' && $request->LF_diseaseOrCare == '0'){
                        $BT['outcome'] .= '1,'; 
                    }
                    if($hoof == '2' && $request->RF_diseaseOrCare == '0'){
                        $BT['outcome'] .= '2,'; 
                    }
                    if($hoof == '3' && $request->LB_diseaseOrCare == '0'){
                        $BT['outcome'] .= '3,'; 
                    }
                    if($hoof == '4' && $request->RB_diseaseOrCare == '0'){
                        $BT['outcome'] .= '4,'; 
                    }
                }                
            $trims = VeterTrimHoof::create($BT);
            // 新数组，病蹄情况插入当天治疗表; 根据修蹄$request->hoof数组，判定
            // daily_表需要日期字段，需要当日治疗结果，是好转还是恶化。
            foreach($request->hoof as $hoof){
                
                // 判断当前蹄子是否是病蹄
                if($hoof == '1' && $request->LF_diseaseOrCare == '1'){
                
                    $BT_daily = array();
                    $BT_daily['veter_trim_id'] = $trims->id;
                    $BT_daily['which_hoof'] = $hoof;
                    $BT_daily['trim_date'] = $request->trim_day;
                    $BT_daily['status'] = $request->LF_status;
                    if($BT_daily['status'] =='done'){
                        $BT_daily['dailycondition'] = '';
                        $BT_daily['outcome'] =$request->outcome;
                    }else{
                        $BT_daily['dailycondition'] =$request->dailycondition;
                        $BT_daily['outcome'] = '';
                    }
                    $BT_daily['disease_name'] = $request->LF_diseasename;
                    $BT_daily['symptom'] = $request->LF_diseaseCondition;
                    $BT_daily['therapeuticWay'] = implode(",",$request->therapeuticway);
                    $BT_daily['note'] = $request->LF_note; 
                    
                    $LF_daily_treat= VeterTrimHoofDailyTreat::create($BT_daily);
                    // 如果治疗方式包括药物治疗或输液疗法
                    if(!empty($request->drug_id)){                      
                        $model = 'App\Models\VeterTrimHoofDailyDrugUse';
                        $drug_id = $request->drug_id;
                        $daily_treat_id = $LF_daily_treat->id;
                        $request['drugUse'] = $request->drugUse;
                        $request['dosage'] = $request->dosage;
                        $this->daily_drug_use($drug_id,$daily_treat_id,$request,$model);
                    }
                }
                if($hoof == '2' && $request->RF_diseaseOrCare == '1'){
                    $BT_daily = array();
                    $BT_daily['veter_trim_id'] = $trims->id;
                    $BT_daily['which_hoof'] = $hoof;
                    $BT_daily['trim_date'] = $request->trim_day;
                    $BT_daily['status'] = $request->RF_status;
                    if($BT_daily['status'] =='done'){
                        $BT_daily['dailycondition'] = '';
                        $BT_daily['outcome'] =$request->RF_outcome;
                    }else{
                        $BT_daily['dailycondition'] =$request->RF_dailycondition;
                        $BT_daily['outcome'] = '';
                    }
                    $BT_daily['disease_name'] = $request->RF_diseasename;
                    $BT_daily['symptom'] = $request->RF_diseaseCondition;
                    $BT_daily['therapeuticWay'] = implode(",",$request->RF_therapeuticway);
                    $BT_daily['note'] = $request->RF_note; 
                    $RF_daily_treat= VeterTrimHoofDailyTreat::create($BT_daily);
                    // 如果治疗方式包括药物治疗或输液疗法
                    if(!empty($request->RF_drug_id)){                      
                        $model = 'App\Models\VeterTrimHoofDailyDrugUse';
                        $drug_id = $request->RF_drug_id;
                        $daily_treat_id = $RF_daily_treat->id;
                        $request['drugUse'] = $request->RF_drugUse;
                        $request['dosage'] = $request->RF_dosage;
                        $this->daily_drug_use($drug_id,$daily_treat_id,$request,$model);
                    }
                }
                if($hoof == '3' && $request->LB_diseaseOrCare == '1'){
                    $BT_daily = array();
                    $BT_daily['veter_trim_id'] = $trims->id;
                    $BT_daily['which_hoof'] = $hoof;
                    $BT_daily['trim_date'] = $request->trim_day;
                    $BT_daily['status'] = $request->LB_status;
                    if($BT_daily['status'] =='done'){
                        $BT_daily['dailycondition'] = '';
                        $BT_daily['outcome'] =$request->LB_outcome;
                    }else{
                        $BT_daily['dailycondition'] =$request->LB_dailycondition;
                        $BT_daily['outcome'] = '';
                    }
                    $BT_daily['disease_name'] = $request->LB_diseasename;
                    $BT_daily['symptom'] = $request->LB_diseaseCondition;
                    $BT_daily['therapeuticWay'] = implode(",",$request->LB_therapeuticway);
                    $BT_daily['note'] = $request->LB_note; 
                    $LB_daily_treat= VeterTrimHoofDailyTreat::create($BT_daily);
                    // 如果治疗方式包括药物治疗或输液疗法
                    if(!empty($request->LB_drug_id)){                      
                        $model = 'App\Models\VeterTrimHoofDailyDrugUse';
                        $drug_id = $request->LB_drug_id;
                        $daily_treat_id = $LB_daily_treat->id;
                        $request['drugUse'] = $request->LB_drugUse;
                        $request['dosage'] = $request->LB_dosage;
                        $this->daily_drug_use($drug_id,$daily_treat_id,$request,$model);
                    }

                }
                if($hoof == '4' && $request->RB_diseaseOrCare == '1'){
                    $BT_daily = array();
                    $BT_daily['veter_trim_id'] = $trims->id;
                    $BT_daily['which_hoof'] = $hoof;
                    $BT_daily['trim_date'] = $request->trim_day;
                    $BT_daily['status'] = $request->RB_status;
                    if($BT_daily['status'] =='done'){
                        $BT_daily['dailycondition'] = '';
                        $BT_daily['outcome'] =$request->RB_outcome;
                    }else{
                        $BT_daily['dailycondition'] =$request->RB_dailycondition;
                        $BT_daily['outcome'] = '';
                    }
                    $BT_daily['disease_name'] = $request->RB_diseasename;
                    $BT_daily['symptom'] = $request->RB_diseaseCondition;
                    $BT_daily['therapeuticWay'] = implode(",",$request->RB_therapeuticway);
                    $BT_daily['note'] = $request->RB_note; 
                    $RB_daily_treat= VeterTrimHoofDailyTreat::create($BT_daily);
                    // 如果治疗方式包括药物治疗或输液疗法
                    if(!empty($request->RB_drug_id)){                      
                        $model = 'App\Models\VeterTrimHoofDailyDrugUse';
                        $drug_id = $request->RB_drug_id;
                        $daily_treat_id = $RB_daily_treat->id;
                        $request['drugUse'] = $request->RB_drugUse;
                        $request['dosage'] = $request->RB_dosage;
                        $this->daily_drug_use($drug_id,$daily_treat_id,$request,$model);
                    }
                }
            }
            return redirect()->back()->with('success','诊疗信息保存成功');
           

        }
        
    }
    public function repellent_single(){
        return view('admin.manager.Veterinary.repellent_single');
    }
    public function repellent_batch(){
        return view('admin.manager.Veterinary.repellent_batch');
    }
    public function repellent_history(){
        return view('admin.manager.Veterinary.repellent_history');
    }
    public function disinfection_input(){
        return view('admin.manager.Veterinary.disinfection_input');
    }
    public function disinfection_history(){
        return view('admin.manager.Veterinary.disinfection_history');
    }

    // 共用函数，存储当日用药，减库存
    public function daily_drug_use($drug_id,$daily_treat_id,$request,$model)
    {
        $drug_id = $this->unique($drug_id);
        foreach($request->drugUse as $k=>$drugname){
            // dd($drugname);
            $daily_drug = array();
            $daily_drug['daily_treat_id'] = $daily_treat_id;
            // 截取drug_id,需要在每个逗号后截取,查找逗号第一次出现的位置
            $pos = strpos($drug_id,',');
            // dd($pos);
            $daily_drug['drug_id'] = substr($drug_id,0,$pos);
            // 重新赋值drug_id为剩下的字符串
            $drug_id = substr($drug_id,$pos+1);
            $daily_drug['drug_name'] = mb_substr($drugname,0,mb_strpos($drugname,'，'));
            $daily_drug['dosage'] = $request->dosage[$k];
            // 对应库存表中的价格，当每选用一支，自动计算价格。价格选择有些复杂，直接选择兽医库存处的id最小的批次，用完再进行一下个。
            // 整体成本是不变的。个别牛的差异可以忽略不计。
            $order_price=VeterDrugRemain::where('drug_id',$daily_drug['drug_id'])->where('remain','>',0)->first();
            $daily_drug['price'] = $order_price->price;
            // 因为物资的价格有变动，所以每次出库的时候，兽医库存表上应该有个批次和价格
            $daily_drug['amount'] =$daily_drug['price'] * $daily_drug['dosage'];           
            $model::create($daily_drug);
            // 同时减去库存表中的量
            if($daily_drug['dosage'] <= $order_price->remain){
                $order_price->remain = $order_price->remain -$daily_drug['dosage'];
                $order_price->save();
            }else{
               
                $other_remain = VeterDrugRemain::where('drug_id',$daily_drug['drug_id'])->where('remain','>',0)->where('id','!=',$order_price->id)->first();
                if(!empty($other_remain)){
                    $diff = $daily_drug['dosage']-$order_price->remain;
                    $order_price->remain = 0;
                    $order_price->save();
                    $other_remain->remain = $other_remain->remain - $diff;
                    $other_remain->save();
                }else{
                    return redirect()->back()->with('error',$daily_drug['drug_name'].'使用量超过库存量');
                }
                
            }

        }
    }

    public function get_barn_cattle_num(Request $request){
        // dd($request->all());
        $cattle_num = CattleBarnMapIndividual::where('barn_id',$request->barn_id)->get()->count();
        echo json_encode(array(
            'cattle_num'=>$cattle_num
        )           
        );
    }

    public function unique($str){  
        //字符串中，需要去重的数据是以数字和“，”号连接的字符串，如$str,explode()是用逗号为分割，变成一个新的数组，见打印  
        $arr = explode(',', $str);  
        $arr = array_unique($arr);//内置数组去重算法  
        $data = implode(',', $arr);  
        // 本程序需要这个逗号
        // $data = trim($data,',');//trim — 去除字符串首尾处的空白字符（或者其他字符）,假如不使用，后面会多个逗号  
        return $data;//返回值，返回到函数外部  
    }
}
