<?php

namespace App\Admin\controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Models\CattleBreedVariety;
use App\Models\Cattle;
use App\Models\CattleBarn;
use App\Models\Staff;
use Excel;
use App\Imports\CattleImport;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\CattleBarnMapIndividual;
use App\Models\CattleSireInfo;
use App\Models\SirePedigree;
use App\Models\CattlePedigree;
use App\Model\Nation;
use App\Models\CattleSireDepository;
use App\Models\CompanyBreeding;
use App\Imports\SireInfoImport;
use App\Imports\SirePedigreeImport;
use App\Models\CattleSirePedigree;
use App\Models\CattleOutsideSireDam;
use App\Models\CattleOutsideDamInfo;
use App\Models\SemenInfo;
use App\Models\SemenStoreRecord;
use App\Models\BreedMateRecord;


class BasicController extends Controller
{
    //默认页面，显示牛只信息
    public function index(Request $request){

        $datas=$request->all();
        // dd($datas);
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
        $datas['whichBreed']=$request->input('whichBreed','');
        $datas['pregnancyNum']=$request->input('pregnancyNum','');
        $datas['cattleID']=$request->input('cattleID','');
        $datas['birthday1']=$request->input('birthday1','');
        $datas['birthday2']=$request->input('birthday2','');
        $datas['belongBarn']=$request->input('belongBarn','');
        $datas['status']=$request->input('status','');
        $datas['gender']=$request->input('gender','');
        $datas['enterday_start']=$request->input('enterday_start','');
        $datas['enterday_end']=$request->input('enterday_end','');
        $datas['whereComefrom']=$request->input('whereComefrom','');
        $datas['sortby']=$request->input('sortby','');
        $datas['sorttype']=$request->input('sorttype','');
        $datas['export']=$request->input('export','');
        // dd($datas['sortby']);
        $hasRepeat = DB::select('select cattleID from cattle group by cattleID having count(cattleID) > 1');
        //判断是否有牛只没有分配牛舍
        $cattle_barn=CattleBarnMapIndividual::groupby('cattle_id')->get(['cattle_id']);

        $need_barn=Cattle::whereNotIn('id',$cattle_barn)->get();
 
        $breedvarieties = CattleBreedVariety::get();
       
        $allCattles=$this->allCattles($datas,$request);
  
       

        if($datas['export']=='all'){
            $cattles=[];
        $i=1;
        foreach($allCattles as $k=>$allcattle){
            $cattles[$k]['id']=$i++;   
            $cattles[$k]['cattleID']=$allcattle->cattleID;
            $cattles[$k]['birthday']=$allcattle->birthday;
            $cattles[$k]['birthWeight']=$allcattle->birthWeight;
            $cattles[$k]['gender']=$allcattle->gender;
            $cattles[$k]['whichBreed']=$allcattle->breedVariety->name;
            $cattles[$k]['whereComefrom']=$allcattle->whereComefrom;
            $cattles[$k]['enterDay']=$allcattle->enterDay;
            $cattles[$k]['enterWeight']=$allcattle->enterWeight;
            $cattles[$k]['pregnancyNum']=$allcattle->pregnancyNum;
            $cattles[$k]['belongBarn']=$allcattle->belongBarn;
            $cattles[$k]['status']=$allcattle->status;
            $cattles[$k]['created_at']=$allcattle->created_at;
        }
            $export=new \App\Exports\CattleExport($cattles);
            return Excel::download($export,'牛只信息.xlsx');
        }elseif($datas['export']=='fromview'){
            return Excel::download(new \App\exports\CattleExportView($datas,$allCattles,$breedvarieties,$hasRepeat),'cattleview.xlsx');
        }
      
        
        return view('admin.manager.basic.basic',compact('breedvarieties','allCattles','hasRepeat','datas','need_barn'));  
    
    }
   
    //添加单个牛只信息
    public function plusCattle(Request $request){
        // dd($request->all());
        Cattle::create($request->all());
        return redirect()->back();

    }
    //添加新品种
    public function plus_breed_variety(Request $request){

        $request->validate([
            'name'=>'required|unique:cattle_breed_varieties',
        ]);
        CattleBreedVariety::create($request->all());
        if($request->ajax()){
            echo json_encode(array(
                "error" => 0,
                "data" => '保存成功',
            )
            );
        }else{
           return redirect()->back();
        }
        
    }
    //导入牛只信息表
    public function import_cattle(Request $request)
    {
        // dd($request->all());
       try{ Excel::import(new CattleImport,$request->file('cattleinfo'));}
       catch(\Exception $e){ 
           return redirect()->back()->with('warn','导入失败，请严格按照模板格式，并将单元格格式设置为文本');
        }
        return redirect()->back();
    }
    public function lookrepeat(Request $request){
        $datas=$request->all();
        $datas['showitem']=$request->input('showitem',10);
        //注意使用groupby 不能有效创建分页器
        // 联合查询结合in的经典例子.指定列名是因为有两个表有重复的id字段，造成结果取不到准确的id。
        $cattles = DB::select('select cattle.id,cattle.cattleID,cattle.birthday,cattle.birthWeight,cattle.gender,cattle.whereComefrom,cattle.enterDay,cattle.enterWeight,cattle.status, cattle_breed_varieties.name from cattle RIGHT OUTER JOIN cattle_breed_varieties ON cattle.whichBreed = cattle_breed_varieties.id where cattleID in (select cattleID from cattle group by cattleID having count(cattleID) > 1) order by cattleID');
        // dd($cattles);
        //当前页数，默认1
        $page=$request->page ? : 1;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //每页条数
        $perPage = $datas['showitem'] ;
        //计算每页分页的初始位置
        $offset = ($page*$perPage)-$perPage;
   
        // 实例化LengthAwarePaginator类，并传入对应参数
        $cattles = new LengthAwarePaginator(array_slice($cattles,$offset,$perPage,true),count($cattles),$perPage,$currentPage,['path'=>Paginator::resolveCurrentPath()]);

        return view('admin.manager.basic.lookrepeat',compact('cattles','datas'));
        
    }
    //删除重复牛只
    public function deleteRepeat($id){
        $cattle=Cattle::findOrFail($id);
        $cattle->delete();
        return redirect()->back();

    }
    //牛舍信息
    public function barninfo(){
        $staffs=Staff::get();
        $barns=CattleBarn::paginate(10);
        $barnNum=CattleBarn::count()-1;

        return view('admin.manager.basic.barninfo',compact('staffs','barns','barnNum'));
    }
    // 新建牛舍
    public function addbarn(Request $request){
        // dd($request);
        CattleBarn::create($request->all());
        return redirect()->back();
    }
    public function semen(){
        return view('admin.manager.basic.semen');
    }
    public function breed_code(Request $request){
        
        $datas=$request->all();
        $datas['showitem']=$request->input('showitem',10);
        $varieties=CattleBreedVariety::paginate($request->input('showitem',10));
        return view('admin.manager.basic.breed_code',compact('varieties','datas'));
    }

//公用函数
    public function allCattles($datas,$request){
        // dd($datas);
        $allCattles = Cattle::whereHas('breedVariety',function($query) use ($datas){
            $breed=$datas['whichBreed'];
            if(!empty($breed)){
                $query->where('name','like','%'.$breed.'%');
            }
            })->where(function($query) use ($datas){
                if(!empty($datas['pregnancyNum'])){
                    $query->where('pregnancyNum','=',$datas['pregnancyNum']);
                } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['cattleID'])){
                $query->where('cattleID','like','%'.$datas['cattleID'].'%');
            } 
    })
    ->doesntHave('barns.linkbarns')
    ->orWhereHas('barns.linkbarns',function($query) use ($datas){
        if(!empty($datas['belongBarn'])){
            $query->where('barnID','=',$datas['belongBarn']);
        } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['status'])){
                $query->where('status','=',$datas['status']);
            } 
            })
        ->where(function($query) use ($datas){
                if(!empty($datas['gender'])){
                    $query->where('gender','=',$datas['gender']);
                } 
                })
        ->where(function($query) use($datas){
        $startdate=$datas['birthday1'];
        $stopdate=$datas['birthday2'];
        if(!empty($startdate) && !empty($stopdate)){
        $query->whereBetween('birthday',[$startdate, $stopdate]);
        }
        if(!empty($startdate) && empty($stopdate)){
            $query->where('birthday','>=', $startdate); 
        }
        if(empty($startdate) && !empty($stopdate)){
            $query->where('birthday','<=', $stopdate); 
        }
        })
        ->where(function($query) use($datas){
        $startdate=$datas['enterday_start'];
        $stopdate=$datas['enterday_end'];
        if(!empty($startdate) && !empty($stopdate)){
        $query->whereBetween('enterDay',[$startdate, $stopdate]);
        }
        if(!empty($startdate) && empty($stopdate)){
            $query->where('enterDay','>=', $startdate); 
        }
        if(empty($startdate) && !empty($stopdate)){
            $query->where('enterDay','<=', $stopdate); 
        }
        })
        ->where(function($query) use($datas){
            if(!empty($datas['whereComefrom'])){
                $query->where('whereComefrom','like', '%'.$datas['whereComefrom'].'%');  
            }
        })
        ->when($datas['sortby'],function($query) use($datas){
                  return $query->orderBy($datas['sortby'], $datas['sorttype']);
        })
        ->paginate($request->input('showitem',10));
        return $allCattles;
    }
    public function barnmapindividual(){
        // dd('how are you?');
        $barns=CattleBarn::all();
        $allCattles=Cattle::all();
        $cattle_barn=CattleBarnMapIndividual::groupby('cattle_id')->get(['cattle_id']);

        $allCattles=Cattle::whereNotIn('id',$cattle_barn)->get();

        return view('admin.manager.basic.barnmapindividual',compact('barns','allCattles'));
    }
    public function plusBarn_cattle(Request $request){
        // dd($request->all());
        $cattle_id=$request->cattle_id;
        $barn_id=$request->barn_id;
        $cattlebarn=[];
        foreach($cattle_id as $k=>$cattle){
            $cattlebarn[$k]['cattle_id']=$cattle;
            $cattlebarn[$k]['barn_id']=$barn_id;
        }

        CattleBarnMapIndividual::insert($cattlebarn);
        $cattle_barn=CattleBarnMapIndividual::groupby('cattle_id')->get(['cattle_id']);

        $allCattles=Cattle::whereNotIn('id',$cattle_barn)->get();
        echo json_encode($allCattles);
    }
    //以下公牛部分
    public function sire(){
        $breeds=CattleSireInfo::groupby('breedType')->get(['breedType']);
        $companys=CattleSireInfo::groupby('belongToCompany')->get(['belongToCompany']);
        $sireinfos=CattleSireInfo::paginate(10);
        $nations=Nation::all();
        //以下获得字段名,现有下面的代替。单独可以使用。
        // $columns=Schema::getColumnListing('cattle_sire_infos');
        // $columns=array_splice($columns,1,-2);
        //获取字段注释
        $sql = "SELECT COLUMN_NAME,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ctmy' AND TABLE_NAME = 'cattle_sire_infos'";
        $results = \DB::select($sql);
        foreach($results as $key=>$value){
          if(empty($value->COLUMN_COMMENT)){
            unset($results[$key]);
          }
        }
        // dd($results);

        return view('admin.manager.basic.sire',compact('sireinfos','breeds','nations','companys','results'));
    }
    public function cattle_detail($cattle_id){
        $cattleinfos=Cattle::find($cattle_id);
        if($cattleinfos->whereComefrom == '自繁'){
            $sire_dam=CattlePedigree::where('cattle_id','=',$cattleinfos->id)->first();
            //查询父亲信息
            if(!empty($sire_dam->sire_id)){
                // dd($sire_dam->cattlesire->sireRegi);
                try{
                    $grandsire=CattleSirePedigree::where('sire','=',$sire_dam->cattlesire->sireRegi)->first();  
                }
                catch(\Exception $e){
                    $errors= $e->getMessage()."there is a exception sire_id";
                    return view('exception.sqlerror',compact('errors'));
                }
                // 公牛全部是公牛库中的公牛，如果自己的公牛本交，也要将之存到公牛库中。
                    
                //查询祖父的父母
                if(!empty($grandsire->father)){
                    $greatSire=CattleSirePedigree::where('sire','=',$grandsire->father)->first();   
                } 
                // 查询祖母的父母
                if(!empty($grandsire->mother)){
                    $greatDam=CattleSirePedigree::where('sire','=',$grandsire->mother)->first();
                }
                }
                // 查询母亲的信息
                if(!empty($sire_dam->dam_id)){
                    // 如果母亲是自繁牛，继续在本场系谱表里查询母亲的父母信息
                    if($sire_dam->cattledam->whereComefrom == '自繁'){
                        $grandDam=CattlePedigree::where('cattle_id','=',$sire_dam->dam_id)->first();
                        // dd($grandDam);
                        // 如果母亲也是自繁牛，继续在本场系谱里查询曾祖父母
                        // 查询外曾祖父亲信息
                        if(!empty($grandDam->cattlesire->sireRegi)){
                            $outgreatSire=CattleSirePedigree::where('sire','=',$grandDam->cattlesire->sireRegi)->first();
                        }
                        // 查询外曾祖母信息
                            if($grandDam->cattledam->whereComefrom =='自繁'){
                                $outgreatDam=CattlePedigree::where('cattle_id','=',$grandDam->dam_id)->first(); 
                            }
                            else{
                                $outgreatDam=CattleSirePedigree::where('sire','=',$grandDam->cattleDam->damNum)->first();
                            }
                    }
                    //如果母亲不是自繁牛，跳入外购牛只系谱表
                    else{
                        $grandDam=CattleSirePedigree::where('sire','=',$sire_dam->cattledam->cattleID)->first();
                        //如果非空，继续查询母亲的父母信息
                        if(!empty($grandDam->father)){
                            $outgreatSire=CattleSirePedigree::where('sire','=',$grandDam->father)->first();
                        } 
                        if(!empty($grandsire->mother)){
                            $outgreatDam=CattleSirePedigree::where('sire','=',$grandDam->mother)->first();
                        }
                    }
                }

            }else{
                //如果牛只是外购，直接查询外购牛系谱表
                $sire_dam=CattleOutsideSireDam::where('cattle_id','=',$cattleinfos->id)->first();
            // 因为要判断sire_id,dam_id各自是否存在，所以父母分开判断，分别进行下一步。
                if(!empty($sire_dam->sire_id)){
                    $grandsire=CattleSirePedigree::where('sire','=',$sire_dam->outsideSire->sireRegi)->first();
                    if(!empty($grandsire->father)){
                        $greatSire=CattleSirePedigree::where('sire','=',$grandsire->father)->first();   
                    }                    
                    if(!empty($grandsire->mother)){
                        $greatDam=CattleSirePedigree::where('sire','=',$grandsire->mother)->first();
                    }
                }
                    if(!empty($sire_dam->dam_id)){
                        
                        $grandDam=CattleSirePedigree::where('sire','=',$sire_dam->outsideDam->damNum)->first();
                        // dd($grandDam);
                        if(!empty($grandDam->father)){
                            $outgreatSire=CattleSirePedigree::where('sire','=',$grandDam->father)->first();
                        }
                        if(!empty($grandDam->mother)){
                            $outgreatDam=CattleSirePedigree::where('sire','=',$grandDam->mother)->first();
                        }
                    }
                }

        return view('admin.manager.basic.cattle_detail',compact('cattleinfos','sire_dam','grandsire','grandDam','greatSire','greatDam','outgreatSire','outgreatDam'));
    }
    public function sireQueryResult(Request $request){
        $datas=$request->all();
        // dd($datas);
        $sireinfos=CattleSireInfo::where(function($query) use ($datas){
            if(!empty($datas['breedType'])){
                $query->where('breedType','=',$datas['breedType']);
            } 
    })
    ->where(function($query) use ($datas){
        if(!empty($datas['nation'])){
            $query->where('nation','=',$datas['nation']);
        } 
            })
       ->where(function($query) use ($datas){
        if(!empty($datas['belongToCompany'])){
            $query->where('belongToCompany','=',$datas['belongToCompany']);
        } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['semenNum'])){
                $query->where('semenNum','=',$datas['semenNum']);
            } 
            })
        ->where(function($query) use ($datas){
            if(!empty($datas['sireRegi'])){
                $query->where('sireRegi','=',$datas['sireRegi']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['CBI'])){
                $query->where('CBI',$datas['CBIRequire'],$datas['CBI']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['birthDay'])){
                $query->where('birthDay',$datas['birthDayRequire'],$datas['birthDay']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['BW'])){
                $query->where('BW',$datas['BWRequire'],$datas['BW']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['WW'])){
                $query->where('WW',$datas['WWRequire'],$datas['WW']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['YW'])){
                $query->where('YW',$datas['YWRequire'],$datas['YW']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['W18month'])){
                $query->where('W18month',$datas['W18Require'],$datas['W18month']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['W24month'])){
                $query->where('W24month',$datas['W24Require'],$datas['W24month']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['W36month'])){
                $query->where('W36month',$datas['W36Require'],$datas['W36month']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['level'])){
                $query->where('level',$datas['bodylevelRequire'],$datas['level']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['CEM'])){
                $query->where('CEM',$datas['CEMRequire'],$datas['CEM']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['milk'])){
                $query->where('milk',$datas['milkRequire'],$datas['milk']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['MH'])){
                $query->where('MH',$datas['MHRequire'],$datas['MH']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['CW'])){
                $query->where('CW',$datas['CWRequire'],$datas['CW']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['Marbling'])){
                $query->where('Marbling',$datas['MarblingRequire'],$datas['Marbling']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['REA'])){
                $query->where('REA',$datas['REARequire'],$datas['REA']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['Fat'])){
                $query->where('Fat',$datas['FatRequire'],$datas['Fat']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['$F'])){
                $query->where('$F',$datas['$FRequire'],$datas['$F']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['$G'])){
                $query->where('$G',$datas['$GRequire'],$datas['$G']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['$QG'])){
                $query->where('$QG',$datas['$QGRequire'],$datas['$QG']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['$YG'])){
                $query->where('$YG',$datas['$YGRequire'],$datas['$YG']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['$B'])){
                $query->where('$B',$datas['$BRequire'],$datas['$B']);
            } 
        })
        ->where(function($query) use ($datas){
            if(!empty($datas['Marbling'])){
                $query->where('Marbling',$datas['MarblingRequire'],$datas['Marbling']);
            } 
        })
        ->when($datas['sortby'],function($query) use($datas){
            return $query->orderBy($datas['sortby'], $datas['orderby']);
        })
        
       ->paginate($request->input('showitem',10));
        return view('admin.manager.basic.sireQueryResult',compact('sireinfos','datas'));
    }
    public function sireDetail($sire_id){
        $array=array();
        $sire=CattleSireInfo::find($sire_id);
        
        // dd($sire->sireRegi);
        //父母信息
        $sireDam=SirePedigree::where('sire','=',$sire->sireRegi)->first();
        // dd($sireDam);
        //如果父母信息皆无，如果只有父亲或母亲，或者只有祖父，没有祖母，会产生太多的if--else.
        // 考虑采用when语句，相对简单
        //父亲的父母
        if($sireDam){
            //父亲的父母
            $grandsire =SirePedigree::where('sire','=',$sireDam->father)->first();
            // 母亲的父母
            $grandDam = SirePedigree::where('sire','=',$sireDam->mother)->first();
        }
        else{
            $grandsire='';
            $grandDam='';
        }
        //母亲的父母
        if($grandsire){
            //爷爷的父母
            $greatSire=sirePedigree::where('sire','=',$grandsire->father)->first();
            //奶奶的父母
            $greatDam = sirePedigree::where('sire','=',$grandsire->mother)->first();
        }   
        else{
            $greatSire='';
            $grandDam='';
        }
        //
        if($grandDam){
            //姥爷的父母
            $outgreatSire=sirePedigree::where('sire','=',$grandDam->father)->first();
            //姥姥的父母
            $outgreatDam=sirePedigree::where('sire','=',$grandDam->mother)->first();
        }else {
            $outgreatSire='';
            $outgreatDam='';
        }
        return view('admin.manager.basic.siredetail',compact('sire_id','sire','sireDam','grandsire','grandDam','greatSire','greatDam','outgreatSire','outgreatDam'));

    }
    public function importSireInfo(Request $request){
        try{ 
            Excel::import(new SireInfoImport,$request->file('sireInfo'));
        }
        catch(\Exception $e){ 
            // dd($e->errorInfo);
            return redirect()->back()->with('warn','导入失败，请严格按照模板格式，删除多余空行，并将时间，数字单元格格式设置为文本。详细错误信息为'.$e->errorInfo[2]);
         }
         $breeds=CattleSireInfo::groupby('breedType')->get(['breedType']);
         $newcount=$breeds->count();

         return redirect()->back();

    }
    public function importSirePedigree(Request $request){

        // dd($request->all());
        try{ 
            Excel::import(new SirePedigreeImport,$request->file('sirePedigree'));
        }
        catch(\Exception $e){ 
            return redirect()->back()->with('warn','导入失败，请严格按照模板格式，并将时间，数字单元格格式设置为文本格式');
         }
         return redirect()->back();
    }
    public function farmSireDepository(){
        // 首先检测冻精信息表中，pedigree状态为0的牛只，如果有，则提示进行
        $semen_no_pedigrees=SemenInfo::where('pedigreeStatus','=','0')->get();
        $nations=Nation::all();
        //品种未来要单独建表
        $breeds=CattleBreedVariety::all();
        $companys=CompanyBreeding::all();
        // get all sires
        $sires=CattleSireDepository::paginate(10);
        //需要完善系谱信息的牛只，即外购牛
        //查询所有外购牛的id，对比cattle_sire表中的cattle_id,不包含的即是需要显示的
        $outBuyCattles=Cattle::where('whereComefrom','!=','自繁')->pluck('id');
        $havePedigrees=CattleOutsideSireDam::whereIn('cattle_id',$outBuyCattles)->pluck('cattle_id');
        $notPedigree= $outBuyCattles->diff($havePedigrees);
        $outBuyCattles=Cattle::whereIn('id',$notPedigree)->get();
        // dd($outBuyCattles);
        
        return view('admin.manager.basic.sireDepository',compact('nations','breeds','companys','outBuyCattles','sires','semen_no_pedigrees'));
    }
    // 牧场公牛库，ajax查看是否已经存在此牛号；
    public function query_sire_depository(Request $request){
        // dd($request->all());
        $sire=$request->sire;
        if(CattleSireDepository::where('sireRegi','=',$sire)->exists()){
           echo json_encode(array(
                "error" => '1',
                "info" => '有重复牛号',
            )
            );
        }else{
            //无论多么古老的牛只，都要在数据库中留下记录。包含基本的国家，品种，出生日期等信息。否则会混乱。
            //同时，在sireInfo表中的牛，一定要在sirePedigree中有记录。
            $sireinfo=CattleSireInfo::where('sireRegi','=',$sire)->first();
            if(!empty($sireinfo)){
                $nation=$sireinfo->nation->nationName;
                $breed=$sireinfo->breedType;
                $sireinfo['belongToCompany']=CompanyBreeding::where('companyName','like',$sireinfo['belongToCompany'])->first(['id']);
                // dd($nation);
            //如果牧场还没用过此公牛，检索公牛站版仓库
            $sire_sire=SirePedigree::where('sire','=',$sire)->first();
           
                if($request->breedType == $breed){
                    if($sire_sire){
                    // 父亲的父母
                    $grandsire =SirePedigree::where('sire','=',$sire_sire->father)->first();
                    // 母亲的父母
                    $grandDam = SirePedigree::where('sire','=',$sire_sire->mother)->first();
        
                        echo json_encode(array(
                            "error" => '0',
                            "info" =>$sire_sire,
                            "grandsire"=>$grandsire,
                            "grandDam"=>$grandDam,
                            "birthday"=>$sireinfo,
                        )
                        );
                }
            else{
                
                echo json_encode(array(
                    "error" => '0',
                    "birthday"=>$sireinfo,
                    "info" =>'',
                    "grandsire"=>'',
                    "grandDam"=>'',
                )
                );
            } 
        }           
            }else 
            {
                echo json_encode(array(
                    "error" => '2',
                    "sires" =>'公牛数据库中没有此牛信息,请做好系谱记录',
                )
                );
            }
        }
   
    }
    public function addnation(Request $request){
        // dd($request->all());
        $datas['nationName']=$request->nationName;
        $datas['abbreviation']=$request->abbreviation;
        if(empty($datas['abbreviation'])){
            $datas['abbreviation']='***';
        }
        Nation::insert($datas);
        return redirect()->back();
    }
    public function addcompany(Request $request){
        $company=$request->all();
        CompanyBreeding::create($company);
        return redirect()->back();
    }
    public function sire_input(Request $request){
        // dd($request->all());
        $sireinformation=array();
        $sireinformation['sireRegi']=$request->cattleID;
        $sireinformation['semenNum']=$request->semenNum;
        $sireinformation['nation']=$request->nation;
        $sireinformation['breedType']=$request->breedType;
        $sireinformation['belongToCompany']=$request->belongToCompany;
        $sireinformation['birthday']=$request->birthday;
        $sirepedigree=array();
        $sirepedigree['sire']=$request->cattleID;
        $sirepedigree['father']=$request->father;
        $sirepedigree['grandSire']=$request->grandSire;
        $sirepedigree['grandDam']=$request->grandDam;
        $sirepedigree['dam']=$request->dam;
        $sirepedigree['outgrandSire']=$request->outgrandSire;
        $sirepedigree['outgrandDam']=$request->outgrandDam;
        try{
            DB::beginTransaction();
            CattleSireDepository::insert($sireinformation);
            if(!empty($sirepedigree['father'])){
                $pedigree=new CattleSirePedigree;
                $pedigree->sire=$sireinformation['sireRegi'];
                $pedigree->father=$sirepedigree['father'];
                $pedigree->mother=$sirepedigree['dam'];
                $pedigree->save();
                if(!empty($sirepedigree['grandSire'])){
                    $pedigree=new CattleSirePedigree;
                    $pedigree->sire=$sirepedigree['father'];
                    $pedigree->father=$sirepedigree['grandSire'];
                    $pedigree->mother=$sirepedigree['grandDam'];
                    $pedigree->save();
                }
            }
          if(!empty($pedigree['dam']) && !empty($sirepedigree['outgrandSire'])){
            $pedigree=new CattleSirePedigree;
            $pedigree->sire=$sirepedigree['dam'];
            $pedigree->father=$sirepedigree['outgrandSire'];
            $pedigree->mother=$sirepedigree['outgrandDam'];
            $pedigree->save();
          }
            //判断公牛号是否存在冻精表中，如果在更新冻精的系谱状态
        $upsemen=SemenInfo::where('semenNum','=',$sireinformation['semenNum'])->first();
        if(!empty($upsemen)){
            $upsemen->pedigreeStatus = '1';
            $upsemen->save();
        }

            DB::commit();
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            $errors= $e->getMessage();
            return view('exception.sqlerror',compact('errors'));
        }
    }
    public function input_dam_info_pedigree(Request $request){
        // dd($request->all());
        // if there is no dam info
        if(empty($request->out_dam)){
            $cattlepedigrees=array();
            $cattlepedigrees['cattle_id']=$request->cattleID;
            $cattlepedigrees['sire_id']=$request->out_father;
            $cattlepedigrees['dam_id']='';
            CattleOutsideSireDam::create($cattlepedigrees);
            return redirect()->back();
        }
        else{

     
        //保存到外购母牛信息表中 cattle_outside_dam_info
        try{
            DB::beginTransaction();

        $daminfos=array();
        $daminfos['damNum']=$request->out_dam;
        $daminfos['breed']=$request->breedType;
        $daminfos['whereComeFrom']=$request->whereComeFrom;
        $daminfos['birthday']=$request->birthday;
        $dams=CattleOutsideDamInfo::create($daminfos);
        $id=$dams->id;
        // 插入本场牛只系谱表 cattle_outside_sire_dams
        $cattlepedigrees=array();
        $cattlepedigrees['cattle_id']=$request->cattleID;
        $cattlepedigrees['sire_id']=$request->out_father;
        $cattlepedigrees['dam_id']=$id;
        CattleOutsideSireDam::create($cattlepedigrees);
        //把母牛系谱插入整个系谱表 cattle_sire_pedigree
         $farmpedigree=array();
         $farmpedigree['sire']=$request->out_dam;
         $farmpedigree['father']=$request->father;
         $farmpedigree['mother']=$request->dam;
         CattleSirePedigree::create($farmpedigree);
         if(!empty($request->grandSire)){
            $farmpedigree['sire']= $request->father;
            $farmpedigree['father']=$request->grandSire;
            $farmpedigree['mother']=$request->grandmother;
            CattleSirePedigree::create($farmpedigree);
         }
         if(!empty($request->outgrandSire)){
             $farmpedigree['sire']=$request->dam;
             $farmpedigree['father']=$request->outgrandSire;
             $farmpedigree['mother']=$request->outgrandDam;
             CattleSirePedigree::create($farmpedigree);
         }
         DB::commit();
         return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            $errors= $e->getMessage();
            return view('exception.sqlerror',compact('errors'));
            }
        }
    }
    public function local_sire_detail($sireId){
        $sire=CattleSireDepository::find($sireId);
        $sire_dam=CattleSirePedigree::where('sire','=',$sire->sireRegi)->first();
        // dd($sire_dam);
        if(!empty($sire_dam)){
            $grandsire=CattleSirePedigree::where('sire','=',$sire_dam->father)->first();
            $grandDam=CattleSirePedigree::where('sire','=',$sire_dam->mother)->first();
            // dd($grandDam);
            if(!empty($grandsire)){
                $greatSire=CattleSirePedigree::where('sire','=',$grandsire->father)->first();
                $greatDam=CattleSirePedigree::where('sire','=',$grandsire->mother)->first();
            }
            if(!empty($grandDam)){
                $outgreatSire=CattleSirePedigree::where('sire','=',$grandDam->father)->first();
                $outgreatDam=CattleSirePedigree::where('sire','=',$grandDam->mother)->first();
            }
        }
        return view('admin.manager.basic.local_sire_detail',compact('sire','sire_dam','grandsire','grandDam','greatSire','greatDam','outgreatSire','outgreatDam'));
    }
    public function semeninfos(Request $request){
        $datas=array();
        $datas['showitem']=$request->input('showitem',10);
        $datas['semenNum']=$request->input('semenNum','');
        $semens=SemenInfo::where('semenNum','like','%'.$datas['semenNum'].'%')->orderBy('id','desc')->paginate(10);
        return view('admin.manager.basic.semeninfos',compact('semens','datas'));
    }
    public function outPregCattle(){
        $breedvarieties = CattleBreedVariety::get();
        $companys=CompanyBreeding::all();
        // 冻精同时应该在公牛库中有信息 cattle_sire_depository
        $semens=SemenInfo::where('forwhich','!=','0')->pluck('semenNum');
        $semens=CattleSireDepository::whereIn('semenNum',$semens)->get();
        return view('admin.manager.basic.outPregCattleMateRecord',compact('breedvarieties','companys','semens'));
    }
    public function outpregSemenStore(Request $request){
        // dd($request->all());
        // 判断冻精表里是否有此冻精号，如果有，查询入库表里是否有记录，如果有，把forwhich更新为1，如果无，提示牛号已经存在，请核对;如果冻精表中无此号，新建，设置为-1
        // 
        $whetherIn=SemenInfo::where('semenNum','=',$request->semenNum)->where('breed','=',$request->breed)->first();
        if(!empty($whetherIn)){
            $whetherInStore=SemenStoreRecord::where('semen_id','=',$whetherIn->id)->get();
            if(!$whetherInStore->isEmpty()){
                $whetherIn->forwhich = '1';
                $whetherIn->save();
                if($whetherIn->pedigreeStatus=='1'){
                    return redirect()->back()->with('success','冻精信息保存成功,该牛号系统中已存在，无需完善系谱');
                }else{
                    return redirect()->back()->with('pompt','冻精信息保存成功,该牛号系统中已存在，但系谱尚未完善，请及时完善');
                }
                
            }
            else{
                return redirect()->back()->with('error','该冻精号已经存在，无需输入');
            }
        }
        else{
            $newSemens=array();
            $newSemens['semenNum']=$request->semenNum;
            $newSemens['company']=$request->company;
            $newSemens['frozenType']=$request->frozenType;
            $newSemens['breed']=$request->breed;
            $newSemens['forwhich']='-1';
            SemenInfo::create($newSemens);
            return redirect()->back()->with('success','冻精信息保存成功');
        }
    }
    public function outPregMateRecordStore(Request $request){
        // dd($request->all());
        // validation whether cowID in database?
        $whetherCowIN=Cattle::where('cattleID','=',$request->cowID)->where('gender','=','母')->first();
        if(empty($whetherCowIN)){
            return redirect()->back()->withInput()->with('error','母牛号不存在，请核对');        
        }
        else{
            // validation mateDate must early than today?
            $mateDate=$request->mateDate;
            if(strtotime($mateDate)>=strtotime(date('Y-m-d'))){
            return redirect()->back()->withInput()->with('error','配种日期必须在今天之前');
            }
            else{
                // validation 牛只配种记录重复输入
                // 母牛号，配种日期两个都一致，证明该条配种记录重复
                $whetherMateRepeat=BreedMateRecord::where('cow_id','=',$whetherCowIN->id)->where('mateDate','=',$request->mateDate)->first();
                if(!empty($whetherMateRepeat)){
                    return redirect()->back()->with('error','该条配种记录已经存在，请核对');
                }
                try{
                    DB::beginTransaction();
                    $outpregRecords=array();
                    //获取该牛号上次配种记录的，如果有记录，修改isLatest为0;有产犊记录的时候也修改，避免有时候，产犊没有输入直接输入配种记录。如果没有记录不做操作。 
                    $lastMateRecord=BreedMateRecord::where('cow_id','=',$whetherCowIN->id)->orderBy('id','desc')->first();
                    if(!empty($lastMateRecord)){
                        $lastMateRecord->isLatest='0';
                        $lastMateRecord->save();
                        // 配种次数
                        $outpregRecords['mateOrder']=$lastMateRecord->mateOrder + 1;
                        // dd($outpregRecords['mateOrder']);
                    }
                    else{
                        $outpregRecords['mateOrder']='1';
                    }
                    // insert BreedMateRecord
                    $outpregRecords['cow_id']=$whetherCowIN->id;
                    $outpregRecords['semen_id']=$request->semen_id;
                    $outpregRecords['useAmount']='1';
                    $outpregRecords['mateDate']=$request->mateDate;
                    $outpregRecords['mateTime']='00:00';
                    $outpregRecords['PIC']='outer';
                    $start  = date_create($whetherCowIN->birthday);
                    $end 	= date_create(); // Current time and date
                    $diff  	= date_diff( $start, $end )->days;
                    $outpregRecords['mateAgeOfDay']=$diff;
                    BreedMateRecord::create($outpregRecords);
                    DB::commit();
                    return redirect()->back()->with('mateSuccess','配种信息保存成功！');
                }catch(\Exception $e){
                    DB::rollback();
                    $errors= $e;
                    return view('exception.sqlerror',compact('errors'));
                    }
               
            }
        }       

    }
}
