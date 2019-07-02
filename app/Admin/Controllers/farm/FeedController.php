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

class FeedController extends Controller
{
    //
    public function dieOut(){
        return view('admin.manager.Feed.dieOut');
    }
    public function sell(){
        return view('admin.manager.Feed.sell');
    }
    public function sell_batch(){
        return view('admin.manager.Feed.sell_batch');
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
    public function returnAssociate(Request $request){
        // dd($request->all());
        $cattleID=$request->cattleID;
        dd($cattleID);
    }
    public function getbarnCattle(Request $request){
        $id=$request->barn_id;
        $barnCattles=Cattle::whereHas('barns.linkbarns',function($query) use ($id){
                $query->where('id','=',$id);
            })->get();
        echo json_encode($barnCattles);       
    }
    public function insertChangeBarn(Request $request){
        // dd($request->all());
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
}
