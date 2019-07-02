<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CattleBreedVariety;
use App\Models\CompanyBreeding;
use App\Models\SemenInfo;
use App\Models\Staff;
use DB;
use App\Models\SemenStoreRecord;
use App\Models\CattleSireDepository;
use App\Models\SemenOutRecord;
use App\Models\SemenBrokeRecord;
use App\Models\BreedMateRecord;
use App\Models\MaterialSemenRemain;
use App\Models\BreedSemenRemain;

class materialController extends Controller
{
    //兽药
    public function drugs_input(){
        return view('admin.manager.material.drugs_input');
    }
    public function drugs_ledger(){
        return view('admin.manager.material.drugs_ledger');
    }
    public function drugs_output(){
        return view('admin.manager.material.drugs_output');
    }
    public function drugs_remain(){
        return view('admin.manager.material.drugs_remain');
    }
    public function drugs_repository(){
        return view('admin.manager.material.drugs_repository');
    }
    //饲料
    public function feed_input(){
        return view('admin.manager.material.feed_input');
    }
    public function feed_ledger(){
        return view('admin.manager.material.feed_ledger');
    }
    public function feed_output(){
        return view('admin.manager.material.feed_output');
    }
    public function feed_remain(){
        return view('admin.manager.material.feed_remain');
    }
    public function feed_repository(){
        return view('admin.manager.material.feed_repository');
    }
    // 机械
    public function instru_consum_check(){
        return view('admin.manager.material.instru_consum_check');
    }
    public function instru_consum_input(){
        return view('admin.manager.material.instru_consum_input');
    }
    public function instru_consum_output(){
        return view('admin.manager.material.instru_consum_output');
    }
    public function instru_consum_remain(){
        return view('admin.manager.material.instru_consum_remain');
    }
    public function instru_consum_ledger(){
        return view('admin.manager.material.instru_consum_ledger');
    }
    // 冻精
    public function semen_input(){
        $breeds=CattleBreedVariety::all();
        $companys=CompanyBreeding::get();
        $staffs=Staff::get();
        return view('admin.manager.material.semen_input',compact('breeds','companys','staffs'));
    }
    public function semen_store(Request $request){
        try{
        DB::beginTransaction();
        // 保存到两张表中,一张保存冻精信息,一张入库信息,一张剩余库存表
        $semen_infos=array();
        $semen_infos['semenNum']=$request->semenNum;
        $semen_infos['breed']=$request->breed;
        $semen_infos['frozenType']=$request->frozenType;
        $semen_infos['company']=$request->company;
        // 这里需要判断,如果表中已经存在此牛号，则不更新冻精信息
        $hadSemen=SemenInfo::where('semenNum','=',$semen_infos['semenNum'])->first();
        
        if(empty($hadSemen)){
            $semens=SemenInfo::create($semen_infos);
            $id=$semens->id;
        }else{
            $id=$hadSemen->id;
        }
        $semen_store=array();
        $semen_store['semen_id']=$id;
        $semen_store['storedDay']=$request->storedDay;
        $semen_store['mount']=$request->mount;
        $semen_store['price']=$request->price;
        $semen_store['sum']=$request->totalSum;
        $semen_store['PIC']=$request->PIC;
        SemenStoreRecord::create($semen_store);
        //插入数据到库存表，如果不存在此牛号，直接创建，如果存在直接加上库存
        $semen_remain=array();
        $semen_remain['semen_id']=$id;
        $semen_remain['remain']=$request->mount;
        $hasId=MaterialSemenRemain::where('semen_id','=',$id)->first();
        if(!empty($hasId)){
            $hasId->remain += $semen_remain['remain'];
            $hasId->save();
        }else{
            MaterialSemenRemain::create($semen_remain);
        }
        DB::commit();
        // dd($hadSemen);
        $hadSemen=SemenInfo::findOrFail($id);
        return redirect()->back()->with(['success'=>'数据提交成功.','hadSemen'=>$hadSemen]);
        }
        catch(\Exception $e){
        DB::rollback();
        $errors= $e->getMessage();
        return view('exception.sqlerror',compact('errors'));
        }
    }
    public function semen_broke_ledger(Request $request){
        // dd($request->all());
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $datas['startDate']=$request->input('startDate','');
        $datas['stopDate']=$request->input('stopDate','');
        $datas['reason']=$request->input('reason','');
        $brokes=SemenBrokeRecord::whereHas('linksemen',function($query) use ($datas){
            $semen=$datas['semenNum'];
            if(!empty($semen)){
                $query->where('semenNum','like','%'.$semen.'%');
            }
            })
            ->where(function($query) use($datas){
                $startdate=$datas['startDate'];
                $stopdate=$datas['stopDate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('brokeDate',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('brokeDate','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('brokeDate','<=', $stopdate); 
                }
                })
                ->where(function($query) use($datas){
                    if(!empty($datas['reason'])){
                        $query->where('reason','like','%'.$datas['reason'].'%');
                    }
                })
                ->orderBy('id','desc')->paginate(10);

        return view('admin.manager.material.semen_broke_ledger',compact('brokes','datas'));
    }
    public function semen_output(Request $request){
        $staffs=Staff::get();
        //出库冻精选择库存不为0的冻精,且公牛库中有信息的公牛
        //首先查询系谱状态为1的公牛号，
        $haspediSemens=SemenInfo::where('pedigreeStatus','=','1')->where('forwhich','=','0')->pluck('id');
        // dd($haspediSemens);
        // 然后查询这些公牛号当中，库存大于0的公牛号
        $semens=MaterialSemenRemain::whereIn('semen_id',$haspediSemens)->where('remain','>','0')->orderBy('id','desc')->get();
        // dd($semens);
        return view('admin.manager.material.semen_output',compact('staffs','semens'));
    }
    public function semen_output_store(Request $request){
        // dd($request->all());
        // validate 数量超过库存数量
        $remains=MaterialSemenRemain::where('semen_id',$request->semen_id)->first();
        $originalRemain=$remains->remain;
        $out=$request->amount;
        if($out>$originalRemain){
            return redirect()->back()->withInput()->with('error','出库数量超过现有库存数量!');
        }
        try{
            DB::beginTransaction();
           SemenOutRecord::create($request->all());
            //同时冻精库存表更新        
            $currentRemain=$originalRemain-$out;
            $remains->remain=$currentRemain;
            $remains->save();
            // 同时需要向繁育人员冻精表中插入领取的冻精数量 BreedSemenRemain
            // 这个地方需要考虑，如果原先存在的有，要更新，如果没有直接创建。
            $breedsemenRemain=BreedSemenRemain::where('semen_id',$request->semen_id)->first();
            if(empty($breedsemenRemain)){
                BreedSemenRemain::create(['semen_id'=>$request->semen_id,'remain'=>$out,]);
            }else{
                $currentRemain=$breedsemenRemain->remain+$out;
                $breedsemenRemain->remain = $currentRemain;
                $breedsemenRemain->save();
            }
            DB::commit();
            return redirect()->back()->with('success','提交成功!'); 
        }catch(\Exception $e){
            DB::rollback();
            $errors= $e->getMessage();
            return view('exception.sqlerror',compact('errors'));
            }
        
    }
    public function semen_store_ledger(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $datas['startDate']=$request->input('startDate','');
        $datas['stopDate']=$request->input('stopDate','');
        
        $stores=SemenStoreRecord::whereHas('linksemen',function($query) use ($datas){
            $semen=$datas['semenNum'];
            if(!empty($semen)){
                $query->where('semenNum','like','%'.$semen.'%');
            }
            })
            ->where(function($query) use($datas){
                $startdate=$datas['startDate'];
                $stopdate=$datas['stopDate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('storedDay',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('storedDay','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('storedDay','<=', $stopdate); 
                }
                })
            ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.material.semen_store_ledger',compact('stores','datas'));
    }
    public function semen_out_ledger(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $datas['startDate']=$request->input('startDate','');
        $datas['stopDate']=$request->input('stopDate','');
        $semen_out_ledgers=SemenOutRecord::whereHas('linksemen',function($query) use ($datas){
            $semen=$datas['semenNum'];
            if(!empty($semen)){
                $query->where('semenNum','like','%'.$semen.'%');
            }
            })
            ->where(function($query) use($datas){
                $startdate=$datas['startDate'];
                $stopdate=$datas['stopDate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('outDay',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('outDay','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('outDay','<=', $stopdate); 
                }
                })
            ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.material.semen_out_ledger',compact('semen_out_ledgers','datas'));
    }
    public function semen_remain(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $remains=MaterialSemenRemain::whereHas('linksemen',function($query) use ($datas){
            $semen=$datas['semenNum'];
            if(!empty($semen)){
                $query->where('semenNum','like','%'.$semen.'%');
            }
            })->orderBy('id','desc')->paginate($request->input('showitem',10));

        return view('admin.manager.material.semen_remain',compact('remains','datas'));
    }
    public function mate_ledger(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $datas['startDate']=$request->input('startDate','');
        $datas['stopDate']=$request->input('stopDate','');

        $mateRecords=BreedMateRecord::whereHas('linksemen',function($query) use ($datas){
            $semen=$datas['semenNum'];
            if(!empty($semen)){
                $query->where('semenNum','like','%'.$semen.'%');
            }
            })
            ->where(function($query) use($datas){
                $startdate=$datas['startDate'];
                $stopdate=$datas['stopDate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('mateDate',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('mateDate','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('mateDate','<=', $stopdate); 
                }
                })        
            ->orderBy('id','desc')->paginate($request->input('showitem',10));
            // dd($mateRecords);
        return view('admin.manager.material.mate_ledger',compact('mateRecords','datas'));
    }

}
