<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CattleBarn;
use App\Models\Cattle;
use App\Models\CattleChangeBarnHistory;
use App\Models\CattleBarnMapIndividual;
use DB;
use App\Models\Staff;
use App\Models\CattleEliminate;
use App\Models\CattleToSlaughter;
use App\Models\CattleSellBatchInfo;
use App\Models\CattleEliminateBatchInfo;

class FeedController extends Controller
{
    //
    public function dieOut(){
        return view('admin.manager.Feed.dieOut');
    }
    public function dieOut_store(Request $request)
    {
        // dd($request->all());
        // 验证是否有不存在牛只
        $cattles = $request->cattleID; 
        $convertComma = str_replace("，",",",$cattles);
        $ifcomma = strstr($convertComma,',');
        if(empty($ifcomma)){
            // 如果不包含逗号，证明只有一头牛
            $cstr= trim($cattles);
            $whetherExist = Cattle::where('status','在群')->where('cattleID',$cstr)->get();
             if($whetherExist->isEmpty()){
                return redirect()->back()->with('danger','在群牛中没有'.$cstr.'牛号');
                
                    }elseif($whetherExist->count()>1){
                        $errors = '此牛号在数据库中有重复';
                        return view('exception.sqlerror',compact('errors'));
                    }
            else{
                $cstr = $cstr;
                // 进行存储,batch_info
                $EliminateBatchInfo = array();
                // 序号根据前一条数据序号加1.
                $lastOrder = CattleEliminateBatchInfo::orderBy('id','desc')->first();
                if(empty($lastOrder)){  $EliminateBatchInfo['elimiOrder']= '1'; } else { $EliminateBatchInfo['elimiOrder']= $lastOrder->elimiOrder + 1;}            
                // elimiDay,格式是年月日
                $EliminateBatchInfo['elimiDay']= $request->elimiDay;
                // 淘汰头数
                $EliminateBatchInfo['totalNum']= $request->totalNum;
                // 淘汰原因
                $EliminateBatchInfo['reason']= $request->reason;
                // 淘汰去向
                $EliminateBatchInfo['toWhere']= $request->ToWhere;
                // 购买者属性
                $EliminateBatchInfo['buyerAttribute']= $request->buyerAttribute;
                // 购买者名称
                $EliminateBatchInfo['buyerName']= $request->buyerName;
                // 购买者电话
                $EliminateBatchInfo['buyerPhone']= $request->buyerPhone;
                // 总体重
                $EliminateBatchInfo['totalWeight']= $request->bodyWeight;
                // 收入
                $EliminateBatchInfo['Income']= $request->eliminateIncome;
                // 负责人
                $EliminateBatchInfo['PIC']= $request->Income;
                // 说明
                $EliminateBatchInfo['note']= $request->note;
                $batch_info = CattleEliminateBatchInfo::create($EliminateBatchInfo);
                // 插入淘汰表格cattle_eliminates
                $eliminates = array();
                $eliminates['cattleID'] = $request->cattleID;
                $eliminates['cattle_id'] = $whetherExist->first()->id;
                $eliminates['elimiDay'] = $request->elimiDay;
                $eliminates['cattle_eliminate_batch_info_id'] = $batch_info->id;
                $eliminates['avgIncome'] = $request->eliminateIncome;
                $eliminates['PIC'] = $request->PIC;
                $eliminates['gender'] = $whetherExist->first()->gender;
                $start = date_create($whetherExist->first()->birthday);
                $end= date_create($request->elimiDay);
                $eliminates['dayAgeOfSold'] = date_diff( $start, $end )->days;
                CattleEliminate::create($eliminates);
                // 把牛只状态改为不在群
                $whetherExist->first()->status = '不在群';
                $whetherExist->first()->save();

                //同时去掉牛舍对应牛号表中的牛只。 
                $barn_cattle = CattleBarnMapIndividual::where('cattle_id',$eliminates['cattle_id'])->first();
                $barn_cattle->delete();
                // 此处应该返回到淘汰牛列表，让提交者看到新淘汰的信息
                return redirect()->back()->with('success','淘汰牛信息提交成功，请不要反复提交');
            }
        }else {
            // 如果有多个牛号
            $cattleArr = explode(',',$convertComma);
            // dd($cattleArr);
            $errorCattle='';
            // 第一遍循环，验证是否有不存在牛号，有返回前端，没有执行插入操作
            foreach($cattleArr as $cattle){
                $whetherExist = Cattle::where('status','在群')->where('cattleID',$cattle)->first();
                if(empty($whetherExist)){
                    $errorCattle .=$cattle.',';
                    }
            }
            if(!empty($errorCattle)){
                return redirect()->back()->with('danger',$errorCattle.'不存在');
            }
            // 如果牛号都正确，进行循环存储
            // 先存储batch_info
            $EliminateBatchInfo= array();
            // 序号根据前一条数据序号加1.
            $lastOrder = CattleEliminateBatchInfo::orderBy('id','desc')->first();
            if(empty($lastOrder)){  $EliminateBatchInfo['elimiOrder']= '1'; } else { $EliminateBatchInfo['elimiOrder']= $lastOrder->elimiOrder + 1;}  
            // elimiDay,格式是年月日
            $EliminateBatchInfo['elimiDay']= $request->elimiDay;
            // 淘汰头数
            $EliminateBatchInfo['totalNum']= $request->totalCattleNum;
            // 淘汰原因
            $EliminateBatchInfo['reason']= $request->reason;
            // 淘汰去向
            $EliminateBatchInfo['toWhere']= $request->ToWhere;
            // 购买者属性
            $EliminateBatchInfo['buyerAttribute']= $request->buyerAttribute;
            // 购买者名称
            $EliminateBatchInfo['buyerName']= $request->buyerName;
            // 购买者电话
            $EliminateBatchInfo['buyerPhone']= $request->buyerPhone;
            // 总体重
            $EliminateBatchInfo['totalWeight']= $request->bodyWeight;
            // 收入
            $EliminateBatchInfo['Income']= $request->eliminateIncome;
            // 负责人
            $EliminateBatchInfo['PIC']= $request->Income;
            // 说明
            $EliminateBatchInfo['note']= $request->note;
            $batch_info = CattleEliminateBatchInfo::create($EliminateBatchInfo);
            // 插入淘汰表格cattle_eliminates

            foreach ($cattleArr as $cattle) {
                $existc = Cattle::where('cattleID',$cattle)->first();
                $eliminates = array();
                $eliminates['cattleID'] = $cattle;
                $eliminates['cattle_id'] = $existc->id;
                $eliminates['elimiDay'] = $request->elimiDay;
                $eliminates['cattle_eliminate_batch_info_id'] = $batch_info->id;
                $eliminates['avgIncome'] = $request->totalCattleNum>0 ? round($request->eliminateIncome/$request->totalCattleNum,4) : 0;
                $eliminates['PIC'] = $request->PIC;
                $eliminates['gender'] = $existc->gender;
                $start = date_create($existc->birthday);
                $end= date_create($request->elimiDay);
                $eliminates['dayAgeOfSold'] = date_diff( $start, $end )->days;
                CattleEliminate::create($eliminates);
                $existc->status = '不在群';
                $existc->save();
                 //同时去掉牛舍对应牛号表中的牛只。 
                 $barn_cattle = CattleBarnMapIndividual::where('cattle_id',$eliminates['cattle_id'])->first();
                 $barn_cattle->delete();

            }
        return redirect()->back()->with('success','淘汰记录提交成功');
    }
}

    public function sell_batch(){
        $barns = CattleBarn::all();
        return view('admin.manager.Feed.sell_batch',compact('barns'));
    }
    public function sell_batch_store(Request $request)
    {
        $batchOrder = CattleSellBatchInfo::orderBy('id','desc')->first();
        
        if(empty($batchOrder)){
            $batchOrder=$batchOrder->batchOrder ='1';
            
        }else {
            $batchOrder = $batchOrder->batchOrder + 1;
        }
        // 如果传递的cattleFrom是单个出售
        if($request->cattleFrom == '单个出售'){
            $singleSell=array();
            $singleSell['batchSellDay'] = $request->saleDay;
            $singleSell['buyerAttribute'] = $request->buyerAttribute;
            $singleSell['buyerName'] = $request->buyerName;
            $singleSell['buyerPhone'] = $request->buyerPhone;
            $singleSell['PricePerKg'] = $request->PricePerKg;
            $singleSell['cattleFrom'] = $request->cattleFrom;
            $singleSell['totalCattleNum'] = $request->totalCattleNum;
            $singleSell['totalWeight'] = $request->totalWeight;
            $singleSell['theoryIncome'] = $request->theroyIncome;
            $singleSell['actualIncome'] = $request->actualIncome;
            $singleSell['PIC'] = $request->PIC;
            $singleSell['batchOrder'] = $batchOrder;
            $sellbatchCreate = CattleSellBatchInfo::create($singleSell);
            $cattle_info = Cattle::where('status','在群')->where('cattleID',$request->cattleID)->first();
            $toSlauther = array();
            $toSlauther['cattle_sell_batch_info_id'] = $batchOrder;
            $toSlauther['cattle_id'] = $cattle_info->id;
            $toSlauther['cattleID'] = $request->cattleID;
            $start = date_create($cattle_info->birthday);
            $end= date_create($request->saleDay);
            $toSlauther['dayAgeOfSold'] =  date_diff( $start, $end )->days;
            $toSlauther['gender'] = $cattle_info->gender;
            $toSlauther['avgIncome'] = $request->actualIncome;
            CattleToSlaughter::create($toSlauther);
            $cattle_info->status = '不在群';
            $cattle_info->save();
            return redirect()->back()->with('success','销售信息保存成功！');
        }elseif($request->cattleFrom == '整舍'){
            $barnSell=array();
            $barnSell['batchSellDay'] = $request->saleDay;
            $barnSell['buyerAttribute'] = $request->buyerAttribute;
            $barnSell['buyerName'] = $request->buyerName;
            $barnSell['buyerPhone'] = $request->buyerPhone;
            $barnSell['PricePerKg'] = $request->PricePerKg;
            $barnSell['cattleFrom'] = $request->cattleFrom.'-'.($request->barnID-1);
            $barnSell['totalCattleNum'] = $request->totalCattleNum;
            $barnSell['totalWeight'] = $request->totalWeight;
            $barnSell['theoryIncome'] = $request->theroyIncome;
            $barnSell['actualIncome'] = $request->actualIncome;
            $barnSell['PIC'] = $request->PIC;
            $barnSell['batchOrder'] = $batchOrder;
            $barnSellCreate = CattleSellBatchInfo::create($barnSell);
            $toSlauther = array();
            $toSlauther['cattle_sell_batch_info_id'] = $batchOrder;
            $cattles = Cattle::where('status','在群')->whereHas('barns',function($query) use($request){
                $query->where('barn_id',$request->barnID);
            })->get();
            $toSlauther['avgIncome'] = round($request->actualIncome/$cattles->count(),4);
            foreach($cattles as $cattle){
                $toSlauther['cattle_id'] = $cattle->id;
                $toSlauther['cattleID'] = $cattle->cattleID;
                $start = date_create($cattle->birthday);
                $end= date_create($request->saleDay);
                $toSlauther['dayAgeOfSold'] =  date_diff( $start, $end )->days;
                $toSlauther['gender'] = $cattle->gender;
                CattleToSlaughter::create($toSlauther);
                $cattle->status = '不在群';
                $cattle->save();
            }
            return redirect()->back()->with('success','销售信息保存成功！');
         }elseif($request->cattleFrom == '组合'){
            //  dd($request->all());
            $combination=array();
            $combination['batchSellDay'] = $request->saleDay;
            $combination['buyerAttribute'] = $request->buyerAttribute;
            $combination['buyerName'] = $request->buyerName;
            $combination['buyerPhone'] = $request->buyerPhone;
            $combination['PricePerKg'] = $request->PricePerKg;
            $combination['cattleFrom'] = $request->cattleFrom;
            $combination['totalCattleNum'] = $request->totalCattleNum;
            $combination['totalWeight'] = $request->totalWeight;
            $combination['theoryIncome'] = $request->theroyIncome;
            $combination['actualIncome'] = $request->actualIncome;
            $combination['PIC'] = $request->PIC;
            $combination['batchOrder'] = $batchOrder;
            $combinationCreate =  CattleSellBatchInfo::create($combination);
            $toSlauther = array();
            $toSlauther['cattle_sell_batch_info_id'] = $batchOrder;
            $cattles = $request->cattleID; 
            $convertComma = str_replace("，",",",$cattles);
            $ifcomma = strstr($convertComma,',');
            if(empty($ifcomma)){
                // 如果不包含逗号，证明只有一头牛
                $cstr= trim($cattles);
                $whetherExist = Cattle::where('status','在群')->where('cattleID',$cstr)->first();
                 if(!empty($whetherExist)){
                    $cstr = $cstr;
                                  }
                else{
                    $cstr='';
                }
            }else {
                $cattleArr = explode(',',$convertComma);
                // dd($cattleArr);
                foreach ($cattleArr as $cattle) {
                    $whetherExist = Cattle::where('status','在群')->where('cattleID',$cattle)->first();
                    if(!empty($whetherExist)){
                        $toSlauther['cattle_id'] = $whetherExist->id;
                        $toSlauther['cattleID'] = $whetherExist->cattleID;
                        $start = date_create($whetherExist->birthday);
                        $end= date_create($request->saleDay);
                        $toSlauther['dayAgeOfSold'] =  date_diff( $start, $end )->days;
                        $toSlauther['gender'] = $whetherExist->gender;
                        CattleToSlaughter::create($toSlauther);
                        $whetherExist->status = '不在群';
                        $whetherExist->save();
                    }
                }
            }
            return redirect()->back()->with('success','牛只销售信息保存成功！');

         }
        // 查找牛舍内所有牛只,把在群状态改为不在群
        
        // 在销售表中，填写牛号，销售日期，

        // 整舍销售的收入，总体重填写到哪里？新建一张表，储存批次销售总信息，然后每头牛对应一个批次id.实践中，经常一次出售20-30头，不算具体每头牛的价钱，更常发生。
        // 单头牛也生成一个批次信息。每一次有一个序号，年终报表，今年共卖牛多少次，多少头，总收入多少钱？
    }
    // 通过ajax获得牛舍牛头数
    public function getBarnNum(Request $request)
    {
           $barnCattleNum = Cattle::where('status','在群')->wherehas('barns',function($query) use($request){
            $query->where('barn_id',$request->barnid);
        })->count();
        echo json_encode($barnCattleNum,JSON_UNESCAPED_UNICODE);
    }
    public function zhuanshe(){
        return view('admin.manager.Feed.zhuanshe');
    }
    public function change_barn(){
        $staffs = Staff::all();
        $barns=CattleBarn::all();
        $reverseBarns=$barns->reverse();
        return view('admin.manager.Feed.change_barn',compact('barns','reverseBarns','staffs'));
    }
    public function getbarnCattle(Request $request){
        $id=$request->barn_id;
        $barnCattles=Cattle::where('status','在群')->whereHas('barns.linkbarns',function($query) use ($id){
                $query->where('id','=',$id);
            })->get();
        echo json_encode($barnCattles);       
    }
    public function insertChangeBarn(Request $request){
        $leaveBarn=$request->leaveBarn;
        $enterBarn=$request->enterBarn;
        $reason=$request->reason;
        $changeDay=$request->changeDay;
        $pic=$request->PIC;
        $cattleID=$request->cattleID;
        $cattlesTomove=[];
        foreach($cattleID as $k=>$cattle_id){
            $cattlesTomove[$k]['cattle_id']=$cattle_id;
            $cattlesTomove[$k]['leaveBarn']=$leaveBarn;
            $cattlesTomove[$k]['enterBarn']=$enterBarn;
            $cattlesTomove[$k]['reason']=$reason;
            $cattlesTomove[$k]['changeDay']=$changeDay;
            $cattlesTomove[$k]['PIC']=$pic;
        }
        //获得二维数组的cattle_id列的集合
        $cattlesin=array_column($cattlesTomove,'cattle_id');
        // dd($cattlesin);
        try{
            DB::beginTransaction();
            CattleChangeBarnHistory::insert($cattlesTomove);
            CattleBarnMapIndividual::whereIn('cattle_id',$cattlesin)->where('barn_id','=',$leaveBarn)->update(['barn_id'=>$enterBarn]);
            DB::commit();
            echo json_encode('数据更新成功');
        }catch(\Exception $e){
            DB::rollback();
            $errors= $e->getMessage();
            return view('exception.sqlerror',compact('errors'));
        }
        
    }
    public function wholeMigration(Request $request){
        // dd($request->all());
        $leaveBarn=$request->leaveBarn;
        $enterBarn=$request->enterBarn;
        $reason=$request->reason;
        $changeDay=$request->changeDay;
        $pic=$request->PIC;
        // dd($leaveBarn);
        $cattle_id=CattleBarnMapIndividual::where('barn_id','=',$leaveBarn)->get(['cattle_id']);
        $migrates=[];
        foreach($cattle_id as $k=>$c_id){
            $migrates[$k]['cattle_id']=$c_id->cattle_id;
            $migrates[$k]['leaveBarn']=$leaveBarn;
            $migrates[$k]['enterBarn']=$enterBarn;
            $migrates[$k]['reason']=$reason;
            $migrates[$k]['changeDay']=$changeDay;
            $migrates[$k]['PIC']=$pic;
        }


        try{
            DB::beginTransaction();
            CattleChangeBarnHistory::insert($migrates);
            CattleBarnMapIndividual::where('barn_id','=',$leaveBarn)->update(['barn_id'=>$enterBarn]);
            DB::commit();
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            $errors= $e->getMessage();
            return view('exception.sqlerror',compact('errors'));
        }

    }
    public function check_cattle(Request $request)
    {
        $cattles = $request->cattleID; 
        $convertComma = str_replace("，",",",$cattles);
        $ifcomma = strstr($convertComma,',');
        
        if(empty($ifcomma)){
            // 如果不包含逗号，证明只有一头牛
            $cstr= trim($cattles);
            $count= 0;
            $whetherExist = Cattle::where('status','在群')->where('cattleID',$cstr)->first();
             if(!empty($whetherExist)){
                $cstr = $cstr;
                $error = 0;
                $cattleNum=1;
            }
            else{
                $cstr='';
                $count= 1;
                $error = 1;
                $cattleNum=1;
            }
        }else {
            $cattleArr = explode(',',$convertComma);
            $cattleNum= count($cattleArr);
             $cstr = '';
            $count= 0;
            foreach ($cattleArr as $cattle) {
                $whetherExist = Cattle::where('status','在群')->where('cattleID',$cattle)->first();
                if(empty($whetherExist)){
                    $cstr .=$cattle.',';
                    $count ++;
                }
            }
            if($count == 0){
                $error = 0;
            }else {
                $error = 1;
            }
        }
       
        echo json_encode(array(
            'cattle' =>$cstr,
            'count' =>$count,
            'error' =>$error,
            'cattleNum'=>$cattleNum,
        ));

    }

}
