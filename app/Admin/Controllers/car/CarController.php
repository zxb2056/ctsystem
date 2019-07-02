<?php

namespace App\Admin\Controllers\car;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Carinfo;
use App\Models\Caroutregi;
use App\Models\Carstatus;
use DB;
use App\Models\Carreturn;
use App\Models\Oilrecord;
use App\Models\Oilcard;
use App\Models\CarOilrecharge;
use App\Models\Carmaintain;
use App\Models\Carrepair;

class CarController extends Controller
{
    //首页，显示车辆信息和状态
    public function index(Request $request){
        $statypes=DB::select('select 1 from `carstatypes`');
        if(empty($statypes)){
            DB::insert('insert into carstatypes (name) values ("可用"),("出车"),("保养维修"), ("年检违章等")');
        }
        $carstatus=DB::select('select 1 from `carstatuses`');
        if(empty($carstatus)){
            $count=Carinfo::count();
            if($count!=0){
                $cars=Carinfo::get(['id']);
                foreach($cars as $car){
                $newarr[]['carinfo_id']=$car['id'];
                }
                Carstatus::insert($newarr);
                unset($cars);
            }
            // 
        }
        $datas=$request->all();
        $datas['licensePlate']=$request->input('licensePlate','');
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
        $cars=Carinfo::where(function($query) use($datas){
           $plate=$datas['licensePlate'];
            $query->where('licensePlate','like','%'.$plate.'%');
            })
        ->paginate($request->input('showitem',10));
        $carstatus=Carstatus::where('status','1')->with(['carinfo'])->get();
        $carouts=Carstatus::where('status','2')->with(['carinfo'])->get();
        $carmaints=Carstatus::where('status','3')->with(['carinfo'])->get();
        $carothers=Carstatus::where('status','4')->with(['carinfo'])->get();
    //    dd($carstatus);
        return view('admin.manager.car.index',compact('datas','cars','carstatus','carouts','carmaints','carothers'));
    }
    //保存车辆信息
    public function add_car(Request $request){
        // dd($request->all());
        Carinfo::create($request->all());
        return redirect()->back();

    }
    public function car_update(Request $request){

        $oldcarinfo=Carinfo::findOrFail($request->id);
        $newcarinfo=$request->all();
        $oldcarinfo->update($newcarinfo);
        return redirect()->back();
        
    }
    public function car_delete($id){
      
        $delcar=Carinfo::findOrFail($id);
        $delcar->delete();
        return redirect()->back();
    }
    //出车登记
    public function regiout(Request $request){
        $outcars=Carstatus::where('status','=','1')->get();
        $datas=$request->all();
        $datas['licensePlate']=$request->input('licensePlate','');
        $datas['startdate']=$request->input('startdate','');
        $datas['stopdate']=$request->input('stopdate','');
        $datas['Vuser']=$request->input('Vuser','');
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
        $outregis=Caroutregi::where(function($query) use($datas){
            $plate=$datas['licensePlate'];
             $query->where('licensePlate','like','%'.$plate.'%');
             })
             ->where(function($query) use($datas){
                $startdate=$datas['startdate'];
                $stopdate=$datas['stopdate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('outtime',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('outtime','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('outtime','<=', $stopdate); 
                }
            })
            ->where(function($query) use($datas){
                $user=$datas['Vuser'];
                 $query->where('Vuser','like','%'.$user.'%');
                 })
             ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.car.regiout',compact('datas','outregis','outcars'));
    }
    public function regiout_add(Request $request){
        // dd($request->all());
        $carinfoid=Request()->carid;
        $carplate=Carinfo::find(Request()->carid,['licensePlate'])->toArray();
        $outs['licensePlate']=$carplate['licensePlate'];
        $outs['Vuser']=Request()->Vuser;
        $outs['outtime']=Request()->outtime;
        $outs['driver']=Request()->driver;
        $outs['destination']=Request()->destination;
        $outs['forwhat']=Request()->forwhat;
        $outs['estimatedreturn']=Request()->estimatedreturn;
        $outs['note']=Request()->note;
        $Cstatus=Carstatus::where('carinfo_id','=',$carinfoid)->first();
        DB::transaction(function () use($outs,$Cstatus){
            Caroutregi::create($outs);
            $Cstatus->status = '2';
            $Cstatus->save();
            
        });
        return redirect()->back();
    }
    public function regiout_delete($id){
        $delout=Caroutregi::findOrFail($id);
        $delout->delete();
        return redirect()->back();

    }
    public function regiout_update(){
        $updateout=Caroutregi::findOrFail(Request()->id);
        $updateout->update(Request()->all());
        return redirect()->back();

    }
    //回车记录
    public function regireturn(Request $request){
        $outcars=Carstatus::where('status','=','2')->get();
        $datas=$request->all();
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
        $datas['licensePlate']=$request->input('licensePlate','');
        $datas['startdate']=$request->input('startdate','');
        $datas['stopdate']=$request->input('stopdate','');
        $datas['Vuser']=$request->input('Vuser','');
        $outregis=array();
        $returnregis=Carreturn::where(function($query) use($datas){
            $plate=$datas['licensePlate'];
             $query->where('licensePlate','like','%'.$plate.'%');
             })
             ->where(function($query) use($datas){
                $startdate=$datas['startdate'];
                $stopdate=$datas['stopdate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('returntime',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('returntime','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('returntime','<=', $stopdate); 
                }
            })
            ->where(function($query) use($datas){
                $user=$datas['Vuser'];
                 $query->where('Vuser','like','%'.$user.'%');
                 })
                 ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.car.regireturn',compact('datas','returnregis','outcars'));
    }
//保存回车记录
public function regireturn_add(){
    // dd(Request()->all());
    $carinfoid=Request()->carid;
    $returns=array();
    //查询对应id的对应车牌
    $carplate=Carinfo::find(Request()->carid,['licensePlate'])->toArray();
    $returns['licensePlate']=$carplate['licensePlate'];
    $returns['Vuser']=Request()->Vuser;
    $returns['returnTime']=Request()->returnTime;
    $returns['note']=Request()->note;
    $Cstatus=Carstatus::where('carinfo_id','=',$carinfoid)->first();
    DB::transaction(function () use($returns,$Cstatus){
        Carreturn::create($returns);
        $Cstatus->status = '1';
        $Cstatus->save();
        
    });
     
    return redirect()->back();
}
public function regireturn_update(Request $request){
    $returns=Carreturn::findOrFail($request->id);
    $returns->update($request->all());
    return redirect()->back();

}
//油卡记录
public function oilrecord(Request $request){
    $datas=$request->all();
    $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
    $datas['licensePlate']=$request->input('licensePlate','');
    $datas['startdate']=$request->input('startdate','');
    $datas['stopdate']=$request->input('stopdate','');
    $datas['cardId']=$request->input('cardId','');
        $records=Oilrecord::where(function($query) use($datas){
            $plate=$datas['licensePlate'];
             $query->where('licensePlate','like','%'.$plate.'%');
             })
             ->where(function($query) use($datas){
                $startdate=$datas['startdate'];
                $stopdate=$datas['stopdate'];
                if(!empty($startdate) && !empty($stopdate)){
                $query->whereBetween('refueling_time',[$startdate, $stopdate]);
                }
                if(!empty($startdate) && empty($stopdate)){
                    $query->where('refueling_time','>=', $startdate); 
                }
                if(empty($startdate) && !empty($stopdate)){
                    $query->where('refueling_time','<=', $stopdate); 
                }
            })
            ->where(function($query) use($datas){
                $cardid=$datas['cardId'];
                 $query->where('cardId','like','%'.$cardid.'%');
                 })
                 ->orderBy('id','desc')->paginate($request->input('showitem',10));
        

    return view('admin.manager.car.oilrecord',compact('datas','records'));
}
public function oilcard_add(Request $request){
    $cardadds=$request->all();
    Oilcard::create($cardadds);
    return redirect()->back();
}
//油卡展示
public function oilcard(){
    
    $cardinfos=Oilcard::get();
    return view('admin.manager.car.oilcard',compact('cardinfos'));
}
//充值逻辑
public function cardrecharge(Request $request){
            $recharges=$request->all();

            CarOilrecharge::create($recharges);
            return redirect()->back();
}
//充值明细
public function recharge_detail(Request $request){
    $datas=$request->all();
    $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
    $datas['cardID']=$request->input('cardID','');
    $datas['startdate']=$request->input('startdate','');
    $datas['stopdate']=$request->input('stopdate','');
    $recharges=CarOilrecharge::where(function($query) use($request){
        $cid=$request->cardID;
        if(!empty($cid)){
        $query->where('cardID','like','%'.$cid.'%');
        }
    })
        ->where(function($query) use($request){
            $startdate=$request->startdate;
            $stopdate=$request->stopdate;
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('rechargeDate',[$startdate, $stopdate]);
            }
        })
        ->paginate($request->input('showitem',10));
        
    return view('admin.manager.car.oilcardrecharge',compact('recharges','datas'));

}
//车辆保养记录
public function maintain(Request $request){
    $datas=$request->all();
    $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
    $datas['licensePlate']=$request->input('licensePlate','');
    $datas['startdate']=$request->input('startdate','');
    $datas['stopdate']=$request->input('stopdate','');
    $maintains=Carmaintain::where(function($query) use($datas){
        $plate=$datas['licensePlate'];
         $query->where('licensePlate','like','%'.$plate.'%');
         })
         ->where(function($query) use($datas){
            $startdate=$datas['startdate'];
            $stopdate=$datas['stopdate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('maintain_day',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('maintain_day','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('maintain_day','<=', $stopdate); 
            }
        })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        $carinfos=Carinfo::get(['licensePlate']);
    return view('admin.manager.car.maintain',compact('datas','maintains','carinfos'));
}
public function maintain_add(Request $request){

    $maintains=$request->all();
    Carmaintain::create($maintains);
    return redirect()->back();

}
public function maintain_update(Request $request){
    $maintains=$request->all();
    $id=$request->id;
    $oldmaintain=Carmaintain::findOrFail($id);
    $oldmaintain->update($maintains);
    return redirect()->back();
    
}
public function maintain_delete($id){
    $delmaintain=Carmaintain::findOrFail($id);
    $delmaintain->delete();
    return redirect()->back();

}
//维修记录
public function repair(Request $request){
    $cars=Carinfo::get(['licensePlate']);
    $datas=$request->all();
    $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10
    $datas['licensePlate']=$request->input('licensePlate','');
    $datas['startdate']=$request->input('startdate','');
    $datas['stopdate']=$request->input('stopdate','');
    $repairs=Carrepair::orderBy('id','desc')->paginate($request->input('showitem',10));
    return view('admin.manager.car.repair',compact('repairs','datas','cars'));
}
//添加维修记录
public function repair_add(Request $request){
        $datas=$request->all();
        Carrepair::create($datas);
        return redirect()->back();
}
//更新维修记录
public function repair_update(Request $request){
    $updates=Carrepair::findOrFail($request->id);
    $datas=$request->all();
    $updates->update($datas);
    return redirect()->back();
}

}
