<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PerformanceFeedExperiment;
use App\Models\PerformanceFeedcovert;
use Excel;
use App\imports\FeedExperiWeightImport;
use App\Models\PerformanceFeedExperiWeight;
use Illuminate\Validation\Rule;

class PerformanceController extends Controller
{
    //默认生长性状测定
    public function index(){
        return view('admin.manager.performance.index');
    }
    //育肥性状测定
    public function fatten(){
        return view('admin.manager.performance.fatten');
    }
    //饲料转化率
    public function feed_conversion(){
        $experimentings=PerformanceFeedExperiment::whereNUll('endDate')->get();
        $experimented=PerformanceFeedExperiment::whereNotNUll('endDate')->get();
        return view('admin.manager.performance.feed_conversion',compact('experimentings','experimented'));
    }
    //胴体性状
    public function carcass(){
        return view('admin.manager.performance.carcass');
    }
    //肉质性状
    public function meat_quality(){
        return view('admin.manager.performance.meat_quality');
    }
     //牛只测定报告
     public function report(){
        return view('admin.manager.performance.report');
    }
    //数据查询和修改
    public function queryUpdate(){
        return view('admin.manager.performance.queryUpdate');
}
//增加转化率实验组逻辑
public function plusexperiment(Request $request){
    // dd($request->all());
    $experiments=$request->all();
    PerformanceFeedExperiment::create($experiments);
    return redirect()->back();
}
//增加个体转化率实验组
public function addStartWeight($id){
    $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->paginate(10);
    $hasweightNumbers= $weights->count();
    $setNumbers=PerformanceFeedExperiment::find($id)->cattle_quantity;
    if($hasweightNumbers==$setNumbers){
        //计算开始总体重，插入表
        $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->get();
        $sum=0;
        foreach($weights as $weight){
            $sum=$sum+$weight->startWeight;
        }
        $experiment=PerformanceFeedExperiment::find($id);
        $experiment->startWeight = $sum;
        $experiment->save();
        return redirect('/admin/manage/performance/feed_conversion/experi/'.$id); 
    }else {
    return view('admin.manager.performance.addStartWeight',compact('id','hasweightNumbers','setNumbers','weights'));
}
}
//增加结束时体重
public function addEndWeight($id){
    //群体实验组到不了这一步，因为它提交的时候已经有最终体重数据
    $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->whereNotNUll('endWeight')->paginate(10);
    $cattles=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->whereNULL('endWeight')->get();
    $hasweightNumbers= $weights->count();
    $setNumbers=PerformanceFeedExperiment::find($id)->cattle_quantity;

   
    if($hasweightNumbers==$setNumbers){
        //计算增加的总体重
        $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->whereNotNUll('endWeight')->get();
        $sum=0;
        foreach($weights as $weight){
            $sum=$sum+$weight->endWeight;
        }
        $experiment=PerformanceFeedExperiment::find($id);
        $experiment->endWeight = $sum;
        $experiment->save();
        //计算饲料消耗总量
        $feeds=PerformanceFeedcovert::where('experiment_id',$id)->get();
        $feedAmounts=0;
        foreach($feeds as $feed){
            $feedAmounts = $feedAmounts + $feed->feedAmount;
            
        }
        //计算饲料转化率，并储存到表中
        $convertRatio=$feedAmounts/($experiment->endWeight-$experiment->startWeight);
        $convertRatio=round($convertRatio,4);      
        $experiment->convertRatio = $convertRatio;
        $experiment->save();
        //计算每头牛的饲料转化率，并存到体重表中
        $cattleIDs=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->get();
            foreach($cattleIDs as $cattleID){
            // dd($cattleID->cattleID);
            $feedAmountInfos=PerformanceFeedcovert::where('experiment_id','=',$id)->where('cattleName','=',$cattleID->cattleID)->get();
            $feedsum=0;
            foreach($feedAmountInfos as $feedAmount){
                $feedsum=$feedsum+$feedAmount->feedAmount;
                $cattleID->individualFeedConsumption = $feedsum;
                $cattleID->save();
                      
                $convertRatio=$feedsum/($cattleID->endWeight - $cattleID->startWeight);
                $convertRatio=round($$convertRatio,4);
                $cattleID->IndividualFeedConvertRatio=$convertRatio;
                $cattleID->save();
            }
           
            
        }
        return redirect('/admin/manage/performance/feed_conversion/experi_done/'.$id);
    }else{
        return view('admin.manager.performance.addEndWeight',compact('id','hasweightNumbers','setNumbers','weights','cattles'));
    }
   
    
}
//添加牛只体重逻辑
public function plusStartWeight(Request $request,$id){
    
    //验证，不能有重复牛号
    // dd($request->all());
    $this->validate($request, [
        'cattleID'=>[
            'required',
            Rule::unique('performance_feed_experi_weights')->where(function ($query) use($id){
            
               return $query->where('experiment_id',$id);
            })
        ],
    ]);
$datas=$request->all();
$datas['experiment_id']=$id;
PerformanceFeedExperiWeight::create($datas);
return redirect()->back();
}
//添加牛只结束体重逻辑
public function plusEndWeight(Request $request,$id){


// dd($request->cattleID);
$endinfos=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->where('cattleID','=',$request->cattleID)->first();
// dd($endinfos);
$endinfos->endWeight = $request->endWeight;
$endinfos->save();
return redirect()->back();

}
//excel import start weight data
public function importStartWeight(Request $request){
    $id=$request->id;
    try{Excel::import(new FeedExperiWeightImport($id),$request->file('cstartWeightexcel'));}
    catch(\Exception $e){
        return redirect()->back()->with('warn','导入失败，请严格按照模板格式，并将单元格格式设置为文本'.$e);
    }        
    $experiment=PerformanceFeedExperiment::find($id);
    $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->pluck('cattleID')->toArray();
    if (count($weights) != count(array_unique($weights))) {
        $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->delete();
        return redirect()->back()->with('warn','导入失败，牛号有重复');
    }
    if(count($weights) != $experiment->cattle_quantity){
        $importnumber=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->count();
        $hasSetnumber=$experiment->cattle_quantity;
        $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->delete();
        return redirect()->back()->with('warn','导入失败，牛只数量不符，导入牛只'.$importnumber.'头，实验组设定'.$hasSetnumber.'头');
    }
    $weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->get();
    $sum=0;
    foreach($weights as $weight){
        $sum=$sum+$weight->startWeight;
    }
    $experiment=PerformanceFeedExperiment::find($id);
    $experiment->startWeight = $sum;
    $experiment->save();
      return redirect('/admin/manage/performance/feed_conversion/experi/'.$id);
}
//结束转化率实验组
public function closeExperiment(Request $request){
    //首先检测饲料表里是否有该实验记录，如果没有，提示没有记录，确定要关闭吗？
    //在点击的时候就进行ajax查询。并返回信息
    //见方法--checkFeedRecord
  //个体实验，先关闭实验组，然后提示输入每头牛的体重
// dd($request->all());
$retriveExperiment=PerformanceFeedExperiment::find($request->id);
if($retriveExperiment->grouporSingle ==1){
    $retriveExperiment->endDate = $request->endDate;
    $retriveExperiment->end_quantity = $request->end_quantity;
    $retriveExperiment->save();
}elseif($retriveExperiment->grouporSingle ==0){
    $retriveExperiment->endDate = $request->endDate;
    $retriveExperiment->end_quantity = $request->end_quantity;
    $retriveExperiment->endWeight = $request->endWeight;
    $retriveExperiment->save();
    //计算饲料消耗量
    $feedAmountInfos=PerformanceFeedcovert::where('experiment_id','=',$request->id)->where('cattleName','=','全部牛只')->get();
    $feedsum=0;
    foreach($feedAmountInfos as $feedAmount){
        $feedsum=$feedsum+$feedAmount->feedAmount;
    }
    $convertRatio=$feedsum/($retriveExperiment->endWeight - $retriveExperiment->startWeight);
    $convertRatio=round($convertRatio,4);
    $retriveExperiment->convertRatio=$convertRatio;
    $retriveExperiment->save();

}
return redirect('/admin/manage/performance/feed_conversion/experi/'.$request->id);


}
//更新实验组
public function updateExperiment(){
    // dd(Request()->all());
    $experiment=PerformanceFeedExperiment::find(Request()->id);
    $experiment->cattle_quantity=Request()->cattle_quantity;
    $experiment->save();
  return redirect('/admin/manage/performance/feed_conversion');
}
//删除实验组
public function deleteExperiment($id){
$weights=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->delete();
$delexperiment=PerformanceFeedExperiment::findOrFail($id)->delete();
return redirect('/admin/manage/performance/feed_conversion');
}

//ajax检测饲料记录表里是否存在记录
public function checkFeedRecord(Request $request){
    $id=$request->id;
    // dd($request->all());
$feedRecord=PerformanceFeedcovert::where('experiment_id','=',$id)->first();
if(empty($feedRecord)){
    echo json_encode(array(
        "error" => 1,
        "data" => '饲喂记录数据为空,确认要关闭吗?',
    ));
}
else {
    echo json_encode(array(
        "error" => 0,
        "data" => '有饲喂数据,可以正常关闭',
    ));
}

}

public function convertDetail($id){

    $experiName=PerformanceFeedExperiment::findOrFail($id);
    if(!empty($experiName->endDate) && !empty($experiName->end_quantity)){
        return redirect('/admin/manage/performance/feed_conversion/experi_done/'.$id);
    }
    $totalcattle=$experiName->cattle_quantity;
    $actual_quantity=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->count();
    // dd($actual_quantity);
    $feedRecords=PerformanceFeedcovert::where('experiment_id','=',$id)->paginate(10);
    if($experiName->grouporSingle==1 && is_null($experiName->startWeight)){
        return redirect('/admin/manage/performance/feed_conversion/addStartWeight/'.$id);
    } 
    //  elseif($experiName->grouporSingle==1 && $totalcattle !=$actual_quantity){
    //     return view('admin.manager.performance.quantity_exception',compact('totalcattle','actual_quantity','experiName'));
    // } 
        else{
        return view('admin.manager.performance.convertDetail',compact('experiName','feedRecords'));
    }
   
}
public function feedRecord_add(Request $request){
    // dd($request->all());
    //判断是属于群体实验还是精细化个体实验
    $experiment_id=$request->experiment_id;
    
    $grouporSingle=PerformanceFeedExperiment::find($experiment_id);
    // dd($grouporSingle->grouporSingle);
    if($grouporSingle->grouporSingle == 0){
        PerformanceFeedcovert::create($request->all());
        return redirect()->back();
    }else{
        $hascattle=PerformanceFeedExperiWeight::where('experiment_id','=',$request->experiment_id)->where('cattleID','=',$cattleName)->first();
    //牛号存在于数据库的情况下，验证
    //验证数据，同一天不能出现重复牛号
    if($hascattle){
        $this->validate($request, [
            'cattleName'=>[
                'required',
                Rule::unique('performance_feedcoverts')->where(function ($query) use($days){
                
                   return $query->where('days',$days);
                })
            ],
        ]);
        //验证通过
        $feedrecord=$request->all();
        PerformanceFeedcovert::create($feedrecord);
        return redirect()->back();
    }else{
        return redirect()->back()->with('failure','该牛号不存在，请核对后再输入')->withInput();
    }

    }
    


}
public function experi_done_display(Request $request,$id){
    $cattleIDs=PerformanceFeedExperiWeight::where('experiment_id','=',$id)->paginate(10);
    $experiName=PerformanceFeedExperiment::findOrFail($id);
    // $feedRecords=PerformanceFeedcovert::where('experiment_id','=',$id)->paginate(10);
    if(empty($experiName->endWeight)){

        return redirect('/admin/manage/performance/feed_conversion/addEndWeight/'.$id);
    }else{
        $datas=$request->all();
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
        $datas['cattleName']=$request->input('cattleName','');
        $datas['days']=$request->input('days','');
        $feedDetails=PerformanceFeedcovert::where('experiment_id','=',$id)->where(function($query) use($datas){
            $name=$datas['cattleName'];
             $query->where('cattleName','like','%'.$name.'%');
             })
             ->where(function($query) use($datas){
                $selectdate=$datas['days'];
            if(!empty($selectdate) ){
                $query->where('days',$selectdate);
                }
                
            })
             ->paginate(10);

        return view('admin.manager.performance.experi_done_display',compact('experiName','cattleIDs','datas','feedDetails'));
    }

}
public function feeding_details(Request $request,$id){
    
    $experiName=PerformanceFeedExperiment::findOrFail($id);
    
    $datas=$request->all();
    $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
    $datas['cattleName']=$request->input('cattleName','');
    $datas['days']=$request->input('days','');
    $feedDetails=PerformanceFeedcovert::where('experiment_id','=',$id)->where(function($query) use($datas){
        $name=$datas['cattleName'];
         $query->where('cattleName','like','%'.$name.'%');
         })
         ->where(function($query) use($datas){
            $selectdate=$datas['days'];
        if(!empty($selectdate) ){
            $query->where('days',$selectdate);
            }
            
        })
         ->paginate(10);
    return view('admin.manager.performance.feeding_details',compact('experiName','feedDetails','datas'));

}
//增加生长发育性状记录
public function plusRecord(Request $request){

    dd($request->all());
}


}
