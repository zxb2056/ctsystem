<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierForbiddenHistory;
use App\Models\SupplierContact;
use Illuminate\Validation\Rule;
use App\Models\SupplierMaterial;
use App\Models\MaterialDrugStoreRecord;

class SupplierController extends Controller
{
    //
    public function supplier_plus()
    {
        return view('admin.manager.supplier.supplier_plus');
    }
    public function supplier_plus_store(Request $request)
    {
        // dd($request->all());
        if($request->hasFile('license_photo') && $request->file('license_photo')->isValid()){
          $ext = $request->file('license_photo')->getClientOriginalExtension();
          if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
              return redirect()->back()->with('errors','文件扩展名不正确，请重新上传');
          }
            $path='./uploads/supplier/'.date('Ymd');
            $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$ext;
            $request->file('license_photo')->move($path,$filename);
            $data= $request->all();
            // dd($data);
            $data['license_photo']= trim($path.'/'.$filename);
            Supplier::create($data);
            return redirect()->back()->with('success','企业信息保存成功');
            }
            else 
            {
                return ;
            }
    }
    public function supplier_contacter_plus()
    {
        $suppliers = Supplier::orderBy('id','desc')->get();
        return view('admin.manager.supplier.supplier_contacter_plus',compact('suppliers'));
    }
    public function supplier_contacter_store(Request $request)
    {
        // 验证，联系人名不能重复
        $this->validate($request,[
            'contacter'=>[
                "required",
                Rule::unique('supplier_contacts')
                    ->where(function($query) use($request){
                        return $query->where('supplier_id',$request->supplier_id);
                    }),
        ],
    ]);
    //    dd($request->all());
    //    逻辑
       $datas= $request->all();
       SupplierContact::create($datas);
       return redirect()->back()->with('success','联系人保存成功');
    }
    public function supplier_info(Request $request)
    {
        $datas=array();
        $datas['showitem'] = $request->input('showitem','');
        $datas['company_name'] = $request->input('company_name','');
        $datas['registered_capital'] = $request->input('registered_capital','');
        $datas['capital_require'] = $request->input('capital_require','');
        $suppliers = Supplier::where(function($query) use($datas){
            if(!empty($datas['company_name'])){
                $query->where('company_name','like','%'.$datas['company_name'].'%');
            } 
        })
        ->where(function($query) use($datas){
            if(!empty($datas['registered_capital'])){
                $query->where('registered_capital',$datas['capital_require'],$datas['registered_capital']);
            }
        })
        ->orderBy('id','desc')->paginate($request->input('showitem',''));
        return view('admin.manager.supplier.supplier_info',compact('suppliers','datas'));
    }
    public function supplier_detail($id)
    {
        // 供应的物品类目
        $items = SupplierMaterial::where('supplier_id',$id)->get();
        $counts = $items->count();
        $first = MaterialDrugStoreRecord::where('supplier_id',$id)->first()->storedDay;
        // 查询各类目的进货次数
        
        foreach($items as $item){
            if($item->type_name == '药品类'){
                $drugs = MaterialDrugStoreRecord::where('supplier_id',$id)->get();
                $drug_count = $drugs->last()->batch_order;
                $drug_sum =  $drugs->sum('sum');
            }
        }
        $total_batchs = $drug_count;
        $total_sum = $drug_sum;
        $suppliers = Supplier::find($id);
        return view('admin.manager.supplier.supplier_detail',compact('suppliers','items','counts','drug_count','first','drug_sum','total_batchs','total_sum'));
    }
    public function supplier_update_license(Request $request)
    {
       // 首先删除原来的图片
        if($request->hasFile('license_photo') && $request->file('license_photo')->isValid())
            {
                $ext = $request->file('license_photo')->getClientOriginalExtension();
                if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
                    return redirect()->back()->with('errors','文件扩展名不正确，请重新上传');
                }
                // 查找到对应的记录,删除
                $supplier=Supplier::findOrFail($request->id);
                $profile=$supplier->license_photo;
                if(file_exists($profile)){
                    unlink($profile);
                }
                $path='./uploads/supplier/'.date('Ymd');
                $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$ext;
                $request->file('license_photo')->move($path,$filename);
                //  重新插入新链接
                    $supplier->license_photo = trim($path.'/'.$filename);
                    $supplier->save();
                return redirect()->back()->with('success','企业信息保存成功');
            }
        else 
              {
                  return ;
              }
    }
    public function supplier_forbidden($id,Request $request)
    {
        $datas=array();
        $datas['supplier_id'] = $id;
        $supplier = Supplier::findOrFail($id);
        if($supplier->status != '-1'){
            $supplier->status = '-1'; 
            $supplier->save();
            $datas['forbidden'] = '加入黑名单';
            $datas['happen_date'] = $request->happen_date;
            $datas['reason'] = $request->reason;
            SupplierForbiddenHistory::create($datas);
            return redirect()->back();
        }
        else{
            // 解除黑名单后，进入后备状态
            $supplier->status = '0'; 
            $supplier->save();
            $datas['forbidden'] = '解除黑名单';
            $datas['happen_date'] = $request->happen_date;
            $datas['reason'] = $request->reason;
            SupplierForbiddenHistory::create($datas);
            return redirect()->back();
        }
        
       
    }
    public function get_company(Request $request)
    {
        // dd($request->all());
        $supplier = Supplier::where('company_name','like','%'.$request->company_name.'%')->get();
        echo json_encode(array(
                'error' =>'0',
                'company_name'=>$supplier,
            )
        );
    }
}
