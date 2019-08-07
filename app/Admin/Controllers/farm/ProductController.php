<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CattleEliminateBatchInfo;
use App\Models\CattleEliminate;
use App\Models\CattleSellBatchInfo;
use App\Models\CattleToSlaughter;
use App\Models\CattleChangeBarnHistory;

class ProductController extends Controller
{
    //
    public function eliminate_ledger(Request $request)
    {
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['startDate']=$request->input('startdate','');
        $datas['stopDate']=$request->input('stopdate','');
        $datas['reason']=$request->input('reason','');
        $datas['toWhere']=$request->input('toWhere','');
        $datas['buyerName']=$request->input('buyerName','');
        $datas['elimiOrder']=$request->input('elimiOrder','');
        $batchs = CattleEliminateBatchInfo::where(function($query) use ($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('elimiDay',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('elimiDay','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('elimiDay','<=', $stopdate); 
            }
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['reason'])){
                $query->where('reason','=',$datas['reason']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['toWhere'])){
                $query->where('toWhere','=',$datas['toWhere']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['buyerName'])){
                $query->where('buyerName','like','%'.$datas['buyerName'].'%');
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['elimiOrder'])){
                $query->where('elimiOrder','=',$datas['elimiOrder']);
            } 
            })
            ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.feed.eliminate_ledger',compact('batchs','datas'));

    }
    public function eliminate_ledger_accord_cattle(Request $request)
    {
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['startDate']=$request->input('startdate','');
        $datas['stopDate']=$request->input('stopdate','');
        $datas['cattleID'] = $request->input('cattleID','');
        $datas['dayAgeOfSold'] = $request->input('dayAgeOfSold','');
        $datas['dayAgeRequire'] = $request->input('dayAgeRequire','');
        $datas['elimiOrder']=$request->input('elimiOrder','');
        // dd($datas['dayAgeRequire']);
        $eliminates = CattleEliminate::
        where(function($query) use ($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('elimiDay',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('elimiDay','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('elimiDay','<=', $stopdate); 
            }
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['cattleID'])){
                $query->where('cattleID','=',$datas['cattleID']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['dayAgeOfSold'])){
                $query->where('dayAgeOfSold',$datas['dayAgeRequire'],$datas['dayAgeOfSold']);
            } 
            })
            ->where(function($query) use ($datas){
                if(!empty($datas['elimiOrder'])){
                    $query->where('cattle_eliminate_batch_info_id','=',$datas['elimiOrder']);
                } 
                })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.feed.eliminate_ledger_accord_cattle',compact('eliminates','datas'));
    }
    public function batch_detail($order)
    {
        $batch = CattleEliminateBatchInfo::where('elimiOrder',$order)->first();
        $cattles = CattleEliminate::where('cattle_eliminate_batch_info_id',$order)->paginate(20);
        return view('admin.manager.feed.batch_detail',compact('batch','cattles'));

    }
    public function sell_ledger(Request $request)
    {
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['startDate']=$request->input('startdate','');
        $datas['stopDate']=$request->input('stopdate','');
        $datas['buyerName']=$request->input('buyerName','');
        $datas['batchOrder']=$request->input('batchOrder','');
        $datas['cattleFrom']=$request->input('cattleFrom','');
         $batchs = CattleSellBatchInfo::where(function($query) use ($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('batchSellDay',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('batchSellDay','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('batchSellDay','<=', $stopdate); 
            }
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['buyerName'])){
                $query->where('buyerName','like','%'.$datas['buyerName'].'%');
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['batchOrder'])){
                $query->where('batchOrder','=',$datas['batchOrder']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['cattleFrom'])){
                $query->where('cattleFrom','=',$datas['cattleFrom']);
            } 
            })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.feed.sell_ledger',compact('batchs','datas'));

    }
    public function sell_ledger_accord_cattle(Request $request)
    {
        $datas= array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['startDate']=$request->input('startdate','');
        $datas['stopDate']=$request->input('stopdate','');
        $datas['cattleID'] = $request->input('cattleID','');
        $datas['dayAgeOfSold'] = $request->input('dayAgeOfSold','');
        $datas['dayAgeRequire'] = $request->input('dayAgeRequire','');
        $datas['batchOrder']=$request->input('batchOrder','');
        $batchs = CattleToSlaughter::whereHas('linkbatch',function($query) use ($datas){
            $startdate=$datas['startDate'];
            $stopdate=$datas['stopDate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('batchSellDay',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('batchSellDay','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('batchSellDay','<=', $stopdate); 
            }
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['cattleID'])){
                $query->where('cattleID','=',$datas['cattleID']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['dayAgeOfSold'])){
                $query->where('dayAgeOfSold',$datas['dayAgeRequire'],$datas['dayAgeOfSold']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['batchOrder'])){
                $query->where('cattle_sell_batch_info_id','=',$datas['batchOrder']);
            } 
            })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.feed.sell_ledger_accord_cattle',compact('batchs','datas'));
    }
    public function sell_batch_detail($order)
    {
        $batch = CattleSellBatchInfo::where('batchOrder',$order)->first();
        $cattles = CattleToSlaughter::where('cattle_sell_batch_info_id',$order)->paginate(20);
        return view('admin.manager.feed.sell_batch_detail',compact('batch','cattles'));
    }
    public function change_barn_history(Request $request)
    {
        $datas= array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['startdate']=$request->input('startdate','');
        $datas['stopdate']=$request->input('stopdate','');
        $datas['cattleID'] = $request->input('cattleID','');
        $changes = CattleChangeBarnHistory:: where(function($query) use ($datas){
            $startdate=$datas['startdate'];
            $stopdate=$datas['stopdate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('changeDay',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('changeDay','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('changeDay','<=', $stopdate); 
            }
        })
        ->whereHas('linkcattle',function($query) use ($datas){
            if(!empty($datas['cattleID'])){
                $query->where('cattleID','=',$datas['cattleID']);
            } 
            })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.feed.change_barn_history',compact('changes','datas'));
     }

}
