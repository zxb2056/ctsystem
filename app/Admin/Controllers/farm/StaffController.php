<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use DB;
use App\Models\Staff;
use App\Models\OffWork;
use App\Models\Tempworker;
use Excel;
use App\imports\RegioncodeImport;
use App\Models\Regioncode;
use App\Models\StaffAttendance;
use App\imports\StaffAttendanceImport;

class StaffController extends Controller
{
    //
    public function staff_list(Request $request){
        $datas=$request->all();
        $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
        $datas['name']=$request->input('name','');
        $datas['startdate']=$request->input('startdate','');
        $datas['stopdate']=$request->input('stopdate','');

        $staffs=Staff::where(function($query) use($datas){
        $name=$datas['name'];
         $query->where('name','like','%'.$name.'%');
         })
         ->where(function($query) use($datas){
            $startdate=$datas['startdate'];
            $stopdate=$datas['stopdate'];
            if(!empty($startdate) && !empty($stopdate)){
            $query->whereBetween('entryDate',[$startdate, $stopdate]);
            }
            if(!empty($startdate) && empty($stopdate)){
                $query->where('entryDate','>=', $startdate); 
            }
            if(empty($startdate) && !empty($stopdate)){
                $query->where('entryDate','<=', $stopdate); 
            }
        })
        ->orderBy('id','desc')->paginate($request->input('showitem',10));
        return view('admin.manager.yuangong.staff_list',compact('staffs','datas'));
    }
    public function partment(){
        
        $departments=Department::get()->toArray();
        $topDeparts=Department::where('Pid','=','0')->get();
        // dd($departments[0]['Pid']);
        //查询pid字段，获取所有pid值，组成一个数组。
        // $DistinctPid= DB::table('departments')->select('Pid')->distinct('Pid')->get();
        //统计数组长度
        // $countPid=count($DistinctPid);
            //调用函数，获得树形结构
            $tree= $this->getTree($departments,0);

        return view('admin.manager.yuangong.partment',compact('topDeparts','tree','departments'));
        
    }
    public function addDepart(Request $request){
        // dd($request->all());
        $departments=$request->all();
        Department::create($departments);
        return redirect()->back();
    }
    public function retriveDepart(Request $request){
        
   
        $pid=$request->Pid;
          $lowers=Department::where('Pid','=',$pid)->get();
        // dd($lowers);
       if($lowers->first()){
        echo json_encode($lowers);
     } 
       else{
           echo '该部门目前没有下属部门';
       }

    }
//将对象数组转化为数组
   public function object_array($array) {  
        if(is_object($array)) {  
            $array = (array)$array;  
         } if(is_array($array)) {  
             foreach($array as $key=>$value) {  
                 $array[$key] = $this->object_array($value);  
                //  echo "$array[$key]";
                 }  
         }  
         return $array;  
    }
    public function getTree($data, $pId)
        {
        $tree = '';
        $i=0;
        foreach($data as $k => $v)
        {
        if($v['Pid'] == $pId)
        {        //父亲找到儿子
           
            $buffer=$this->getTree($data,$v['id']);
           if(empty($buffer)){
               $tree.='<li ><i class="fa fa-minus-square-o mr-2 text-warning" aria-hidden="true"></i>'.$v['departName'];
           }else{
            $tree.='<li ><i class="fa fa-plus-square-o mr-2 text-warning" aria-hidden="true"></i><a class="text-dark bg-white" data-toggle="collapse" href="#Manage'.$v['id'].'" role="button" onclick="toggleFoleder(this)">'.$v["departName"].'</a><div class="collapse" id="Manage'.$v['id'].'">';
            $tree.=$this->getTree($data,$v['id']);
            $tree.='</div>';
           }
            $tree.='</li>';
        }
        }
        return $tree ? '<ul class="mt-1 ">' .$tree. '</ul>' : $tree;
        }

        public function deletedepart($id){
            $departments=Department::get();
            $depart=$this->getChild($departments,$id);
            // dd($depart);
            if(count($depart)==0){
                $department=Department::findOrFail($id);
                $department->delete();
            }else{
                $depart[]=$id;
                Department::destroy($depart);
            }
            
            return redirect()->back();
        }
        public function editdepart(Request $request){
            // dd(Request()->all());
            $department=Department::findOrFail($request->id);
            $department->update($request->all());
            return redirect()->back();
        }
        public function getChild($data,$pid){
            $child=array();
            foreach($data as $k => $v){
                if($v['Pid'] == $pid){
                    array_push($child,$v['id']);
                 $this->getChild($data,$v['id']);
                    
                }

            }
            return $child;
        }
        public function truncate(){
            Department::truncate();
            return redirect()->back();

        }
        //添加员工信息
        public function add_staff(){
            $this->validate(Request(),[
                'telephone'=>'unique:staff',
               
            ],[
                'telephone.unique'=>'电话号码已经存在',
               
            ]);
            
            Staff::create(Request()->all());
            // dd(Request()->all());
            return redirect()->back();

        }
        //编辑员工信息
        public function edit_staff(Request $request){
           $oldstaff=Staff::find($request->id);
            $newstaff=$request->all();
            $oldstaff->update($newstaff);
            return redirect()->back();
        }
        //员工请假管理
        public function offWork(Request $request){
            $datas=$request->all();
            $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
            $datas['name']=$request->input('name','');
            $datas['startdate']=$request->input('startdate','');
            $datas['stopdate']=$request->input('stopdate','');
            $qjts=OffWork::where(function($query) use($datas){
                $name=$datas['name'];
                 $query->where('name','like','%'.$name.'%');
                 })
                 ->where(function($query) use($datas){
                    $startdate=$datas['startdate'];
                    $stopdate=$datas['stopdate'];
                    if(!empty($startdate) && !empty($stopdate)){
                    $query->whereBetween('startTime',[$startdate, $stopdate]);
                    }
                    if(!empty($startdate) && empty($stopdate)){
                        $query->where('startTime','>=', $startdate); 
                    }
                    if(empty($startdate) && !empty($stopdate)){
                        $query->where('startTime','<=', $stopdate); 
                    }
                })
                ->paginate($request->input('showitem',10));
            return view('admin.manager.yuangong.offWork',compact('qjts','datas'));
        }
        //员工考勤页面
        public function attendance(Request $request){
            
            $months=StaffAttendance::groupBy('month')->pluck('month')->toArray();
            $endmonth=end($months);
            // dd($endmonth);
            // dd($attends[0]->month);
            $datas=$request->all();
            $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
            $datas['name']=$request->input('name','');
            $datas['month']=$request->input('month','');
            $attends=StaffAttendance::where(function($query) use($datas){
                $name=$datas['name'];
                 $query->where('name','like','%'.$name.'%');
                 })
                 ->where(function($query) use($datas){
                     
                    $month=$datas['month'];
                    if(!empty($month)){
                        $query->where('month','=',$month); 
                    }
                  })
                 ->paginate($request->input('showitem',10));
                 $months=array_reverse($months); 
            return view('admin.manager.yuangong.attendance',compact('attends','datas','months'));
        }
        //员工考勤表上传逻辑
        public function uploadattendance(Request $request){
            Excel::import(new StaffAttendanceImport,$request->file('attendancexls'));
            return redirect()->back();

        }
        //删除考勤
        public function attendance_delete($id){
            $attendance=StaffAttendance::find($id);
            $attendance->delete();
            return redirect()->back();

        }
        public function offWorkStore(Request $request){
            
            $this->validate(Request(),[
                'telephone'=>'unique:offworks',
               
            ],[
                'telephone.unique'=>'电话号码已经存在',
               
            ]);
            Offwork::create($request->all());
            return redirect()->back();

        }
        //请假条更新
        public function offWorkUpdate(Request $request){
            // dd($request->all());
            $oldoffwork=Offwork::find($request->id);
            $newoffwork=$request->all();
            $oldoffwork->update($newoffwork);
            return redirect()->back();
        }
        //请假条删除
        public function offWorkdelete(Request $request,$id){
            $offwork=Offwork::findOrFail($id);
            $offwork->delete();

            return redirect()->back();
        }
        //临时用工
        public function tmpworker_list(Request $request){
            $datas=$request->all();
            $datas['showitem']=$request->input('showitem',10);//如果没有传值，默认10。
            $datas['name']=$request->input('name','');
            $tempworkers=Tempworker::where(function($query) use($datas){
                $name=$datas['name'];
                 $query->where('name','like','%'.$name.'%');
                 })
                 ->paginate($request->input('showitem',10));
            $regioncodes=Regioncode::paginate(50);

            return view('admin.manager.yuangong.tempworker',compact('datas','tempworkers','regioncodes'));
        }
        public function add_tmpworker(Request $request){
            $tmpworkers=$request->all();
            Tempworker::create($tmpworkers);         
            return redirect()->back();
        }
        public function importcode(Request $request){
            // dd($request->file('xzqcode'));

            Excel::import(new RegioncodeImport,$request->file('xzqcode'));
            return redirect()->back();
        }
        public function delete_tmpworker($id){
            $deltemp=Tempworker::findOrFail($id);
            $deltemp->delete();
            return redirect()->back();
        }
        public function update_tmpworker(Request $request){
            $datas=$request->all();
            $updatetemp=Tempworker::findOrFail($request->id);
            $updatetemp->update($datas);
            return redirect()->back();
        }

}
