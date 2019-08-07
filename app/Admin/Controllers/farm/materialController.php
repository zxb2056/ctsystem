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
use App\Models\MaterialDrugRepository;
use App\Models\SupplierMaterial;
use App\Models\MaterialDrugStoreRecord;
use App\Models\Department;
use App\Models\MaterialDrugRemain;
use App\Models\MaterialDrugOutRecord;
use App\Models\VeterDrugRemain;
class materialController extends Controller
{
    // 新药品登记
    public function drugs_repository_plus()
    {
        return view('admin.manager.material.drug.drug_repository_plus');
    }
    public function drugs_repository_store(Request $request)
    {
        // dd($request->all());
        // 首先判断supplier_id是否提交，如果没有提交根据公司名字查询得到
        if(empty($request->supplier_id)){
            $sup= Supplier::where('supplier','like','%'.$request->supplier.'%')->get();
            if($sup->count()>1){
                return redirect()->back()->with('errors','请准确输入或选择公司名字，类似结果大于1条');
            }
            else {
                $request->supplier_id = $sup->first()->id;
            }
        }

        MaterialDrugRepository::create($request->all());
        return redirect()->back()->with('success','药品信息保存成功');
    }
    // ajax检测兽药信息
    public function get_drug_info(Request $request)
    {
        if($request->type =='store'){
            $drugs = MaterialDrugRepository::where('drugName','like','%'.$request->drug_name.'%')->get();
        }elseif($request->type =='out')
        {
            $drugs = MaterialDrugRepository::where('drugName','like','%'.$request->drug_name.'%')->whereHas('company_remain',function($query){
                $query->where('remain','>',0);
            })->get();
        }
        else
        {
            $drugs = MaterialDrugRepository::where('drugName','like','%'.$request->drug_name.'%')->wherehas('veter_remain',function($query){
                $query->where('remain','>',0);
            })->get();
        }
        echo json_encode(array(
                'error' =>'0',
                'drug_name'=>$drugs,
            )
        );
    }
    //兽药
    public function drugs_input(){

        return view('admin.manager.material.drug.drugs_input');
    }
    // 药品详情页
    public function repo_detail($id)
    {
        $drug = MaterialDrugRepository::find($id);
        return view('admin.manager.material.drug.repo_detail',compact('drug'));
    }
    public function drugs_input_store(Request $request){
        // dd($request->all()); 
        $supplier_id = MaterialDrugRepository::where('id',$request->drug_id)->first();
        $supplier = array();
        $supplier['supplier_id'] = $supplier_id->supplier_id;
        $supplier['type_name'] = '药品类';
        $supplier['query_link'] ='/admin/manage/material/drugs/ledger/store';
        // 储存入库记录，多一个序列号，即入库批次
        $beforStores = MaterialDrugStoreRecord::where('drug_id',$request->drug_id)->orderBy('id','desc')->first();
        if(empty($beforStores)){
            $request['batch_order'] = '1';
        }else{
            $request['batch_order'] = $beforStores->batch_order + 1;
        }
        $request['unit'] = $supplier_id->unit;
        $request['supplier_id'] = $supplier_id->supplier_id;
        $request['sum'] = $request->price * $request->amount;
        try{
      
               $stored= MaterialDrugStoreRecord::create($request->all());
                // 储存到公司表，里面，储存包括类型名，药品，饲料等，然后还有模型App\Models\MaterialDrugRecord,入库登记，同时有出库登记表
                // 可以通过跳转到药品类台帐页面。参数为公司id就可以。
                $ifexist = SupplierMaterial::where('supplier_id',$supplier['supplier_id'])->where('type_name','药品类')->first();
                if(empty($ifexist)){
                    SupplierMaterial::create($supplier);
                }
                // 插入库存表
                    // $remains = MaterialDrugRemain::where('drug_id',$request->drug_id)->first();
                    // 因为后来加入储存id,所以有变化。每次入库都相应的新加入一个remain,对应的是入库id.因为价格和保质期都不一样。
                    MaterialDrugRemain::insert([
                        'drug_id'=>$request->drug_id,
                        'remain'=>$request->amount,
                        'drug_store_id' =>$stored->id,
                    ]);
                
            }catch(\Exception $e){
                DB::rollback();
                $errors= $e->getMessage();
                return view('exception.sqlerror',compact('errors'));
            }
        return redirect()->back()->with('success','信息保存成功');
    }
    public function drugs_store_ledger(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['drug_name']=$request->input('drug_name','');
        $datas['company_name']=$request->input('company_name','');
        $datas['stored_day_require']=$request->input('stored_day_require','');
        $datas['storedDay']=$request->input('storedDay','');
        $store_history = MaterialDrugStoreRecord::whereHas('linkdrug',function($query) use($datas){
            if(!empty($datas['drug_name'])){
                $query->where('drugName','like','%'.$datas['drug_name'].'%');
            }
        })
        ->whereHas('linkdrug',function($query) use($datas){
            if(!empty($datas['company_name'])){
                $query->where('supplier','like','%'.$datas['company_name'].'%');
            }
        })
        ->where(function($query) use($datas){
            if(!empty($datas['storedDay'])){
                $query->where('storedDay',$datas['stored_day_require'],$datas['storedDay']);
            }
        })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.material..drug.drugs_ledger',compact('store_history','datas'));
    }
    public function drugs_output_ledger(Request $request)
    {
        // dd('成功');
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['drug_name']=$request->input('drug_name','');
        $datas['out_day_require']=$request->input('out_day_require','');
        $datas['outDay']=$request->input('outDay','');
        $out_history = MaterialDrugOutRecord::whereHas('linkdrug',function($query) use($datas){
            if(!empty($datas['drug_name'])){
                $query->where('drugName','like','%'.$datas['drug_name'].'%');
            }
        })
        ->where(function($query) use($datas){
            if(!empty($datas['outDay'])){
                $query->where('outDay',$datas['out_day_require'],$datas['outDay']);
            }
        })
        ->orderBy('id','desc')->paginate(10);
        return view('admin.manager.material..drug.drugs_output_ledger',compact('datas','out_history'));
        

    }
    public function drugs_output(){
        $departs = Department::where('pid','0')->get();
        return view('admin.manager.material..drug.drugs_output',compact('departs'));
    }
    public function drugs_output_store(Request $request)
    {
        // dd($request->all());
        $datas = $request->all();
        $depart_str='';
        foreach($datas as $k=>$v){
            // 正则匹配键名，然后截取-后面的数字
        if(preg_match('/department-/',$k)){
            $depart_str .= $v.'-';
        }

        }
        // dd($depart_str);
        // 判断如果只有一个-号
        if( substr_count($depart_str,'-') == 1 ){
            $department_id =rtrim($depart_str, '-');
        }else{
            $department_id =rtrim($depart_str, '-');
            $department_id = trim(strrchr($department_id, '-'),'-');
        }
        
          // 下一步是减去药品库存，
          $remains = MaterialDrugRemain::where('drug_id',$request->drug_id)
          ->where('drug_store_id',$request->drug_stored_id)->first();
          if($remains->remain < $request->amount){
              return redirect()->back()->with('info','出库数量不能大于现有库存数量');
          }else{
              $remains->remain = $remains->remain- $request->amount;
              $remains->save();
          }
        // 最后一个-号后的数字是department_id
        $outrecords = array();
        $outrecords['drug_id'] = $request->drug_id;
        $outrecords['outDay'] = $request->outDay;
        $outrecords['amount'] = $request->amount;
        $outrecords['department_id'] = $department_id;
        $outrecords['user'] = $request->user;
        $outrecords['drug_store_id'] = $request->drug_stored_id;   
        MaterialDrugOutRecord::create($outrecords); 
        // 增加兽医处库存，即使不是兽医也存在这里，但是库存应该为0，代表已经用过了。
        $veter_remain = VeterDrugRemain::where('drug_id',$request->drug_id)
        ->where('drug_store_id',$request->drug_stored_id)->first();
        $price = MaterialDrugStoreRecord::where('drug_id',$request->drug_id)
        ->where('id',$request->drug_stored_id)->first();
        if(empty($veter_remain)){
            VeterDrugRemain::insert([
                'drug_id'=>$request->drug_id,
                'drug_store_id'=>$request->drug_stored_id,
                'remain'=>$request->amount,
                'price'=>$price->price,
            ]);
        }
        else {
            $veter_remain->remain = $veter_remain->remain + $request->amount;
            $veter_remain->save();
        }
        return redirect()->back()->with('success','信息保存成功！');

    }
    public function drugs_remain(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['drug_name']=$request->input('drug_name','');
        $remains = MaterialDrugRemain::whereHas('linkdrug',function($query) use($datas){
            if(!empty($datas['drug_name'])){
                $query->where('drugName','like','%'.$datas['drug_name'].'%');
            }
        })
        ->orderBy('updated_at','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.material.drug.drugs_remain',compact('remains','datas'));
    }
    public function get_drug_remain(Request $request)
    {
        // dd($request->all());
        $remains = MaterialDrugRemain::where('drug_id',$request->drug_id)->where('drug_store_id',$request->drug_store_id)->first();
        if(empty($remains)){
            echo json_encode('库存记录不存在');
        }else{
            echo json_encode($remains->remain);
        }
       
    }
    public function drugs_repository(Request $request){
        $repos = MaterialDrugRepository::orderBy('id','desc')->paginate(10);
        return view('admin.manager.material.drug.drugs_repository',compact('repos'));
    }
    // 通过药品id,查找入库记录，且该入库记录目前的库存>0;
    public function store_drug_record(Request $request)
    {
        // dd($request->all());
        // 这里需要显示不同进货批次，剩余数量，价格
        $batchs =  MaterialDrugStoreRecord::where('drug_id',$request->drug_id)->whereHas('linkremain',function($query){
            $query->where('remain','>',0);

        })->get();
        echo json_encode(array(
            'batchs'=>$batchs,
        ));
    }
    //饲料
    public function feed_input(){
        return view('admin.manager.material.feed.feed_input');
    }
    public function feed_ledger(){
        return view('admin.manager.material.feed.feed_ledger');
    }
    public function feed_output(){
        return view('admin.manager.material.feed.feed_output');
    }
    public function feed_remain(){
        return view('admin.manager.material.feed.feed_remain');
    }
    public function feed_repository(){
        return view('admin.manager.material.feed.feed_repository');
    }
    // 机械
    public function instru_consum_check(){
        return view('admin.manager.material.instru.instru_consum_check');
    }
    public function instru_consum_input(){
        return view('admin.manager.material.instru.instru_consum_input');
    }
    public function instru_consum_output(){
        return view('admin.manager.material.instru.instru_consum_output');
    }
    public function instru_consum_remain(){
        return view('admin.manager.material.instru.instru_consum_remain');
    }
    public function instru_consum_ledger(){
        return view('admin.manager.material.instru.instru_consum_ledger');
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
