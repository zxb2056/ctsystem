@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light">
  <li class="nav-item">
    <a class="nav-link " href="{{url('/admin/manage/staff/staff_list')}}">员工列表</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/offWork')}}">请假</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/attendance')}}">考勤</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/staff/partment')}}">部门管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/tmpworker')}}">临时用工</a>
  </li>

</ul>
<div>


</div>
<h5  class="my-3">公司部门列表</h5>
{!! $tree !!}

<?php $childs=getChild($departments,0); ?>
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>部门管理</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <a  href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#staffModal">新增</a>
                                <a  class="btn btn-sm btn-outline-primary ml-2 text-dark" href="/admin/manage/staff/department/truncate" onclick="return disp_confirm()">清空部门表</a>
                            </div> 
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>部门名称</th>
                            <th>部门职责</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            loopArray($childs);
                        ?>
                       

                       
                    </tbody>

          </table>
                    </div>
            <div class="card-footer">
                说明：目前只显示三级层级关系。更多层级能显示，但编码可能有问题。
            </div>
                    </div>
                </div>
            </div>
    </div>
      
<!-- Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增部门</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增部门</strong>
                </div>
                <form action="{{url('/admin/manage/staff/addDepart')}}" method="POST" class="was-validated">
                {{ csrf_field() }}
                <div class="card-body ">
                        <div class="form-group row">
                            <label for="departName" class="col-sm-3 col-form-label">部门名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="departName" name="departName"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Pid" class="col-sm-3 col-form-label">部门级别</label>
                            <div class="col-sm-9">
                            <select id="Pid0" name="Pid" class="form-control" onchange="getLowerDepartment(this,modal='div#staffModal')">
                                <option value="0">顶级部门</option>
                            @foreach($topDeparts as $department)
                                    <option value="{{ $department->id }}">----{{$department->departName}}</option>
                            @endforeach
                                </select>
                               
                        </div>
                        </div>           
                        <div class="form-group row">
                            <label for="departIntro" class="col-sm-3 col-form-label">工作职责</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="departIntro" name="departIntro" rows="5" maxlength="300"></textarea>
                            </div>
                        </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
                </div>
        </form>
   </div>
   <p>说明：工作职责限300字以内</p>
</div>
</div>
</div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="staffUpdateModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">编辑部门</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>编辑部门</strong>
                </div>
                <form action="{{url('/admin/manage/staff/department/edit')}}" method="POST" class="was-validated">
                {{ csrf_field() }}
                <div class="card-body ">
                        <div class="form-group row">
                            <label for="departName" class="col-sm-3 col-form-label">部门名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="departName" name="departName"  required>
                                <input type="hidden" id="departId" name='id'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Pid" class="col-sm-3 col-form-label">部门级别</label>
                            <div class="col-sm-9">
                            <select id="Pid0" name="Pid" class="form-control" onchange="getLowerDepartment(this,modal='div#staffUpdateModal')">
                                <option value="0">顶级部门</option>
                                @foreach($topDeparts as $department)
                                    <option value="{{ $department->id }}">----{{$department->departName}}</option>
                                @endforeach
                            </select>
                               
                        </div>
                        </div>           
                        <div class="form-group row">
                            <label for="departIntro" class="col-sm-3 col-form-label">工作职责</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="departIntro" name="departIntro" rows="5" maxlength="300"></textarea>
                            </div>
                        </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
                </div>
        </form>
   </div>
   <p>说明：工作职责限300字以内</p>
</div>
</div>
</div>
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/department.js"></script>
<script type="text/javascript">

    function toggleFoleder(obj) {
        if($(obj).prev().hasClass("fa-plus-square-o")){

            $(obj).prev().removeClass("fa-plus-square-o");
            $(obj).prev().addClass("fa-minus-square-o");
        }else {
            $(obj).prev().removeClass("fa-minus-square-o");
            $(obj).prev().addClass("fa-plus-square-o");
        }

           }
    function disp_confirm()
        {
        var r=confirm("您确认要删除吗？")
       
        if (r==true)
            {
          
           return true;
            }
        else
            {
           return false;
            }
        }
        $('#staffUpdateModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var departname = button.data('departname') 
  var id=button.data('id')
  var departIntro = button.data('intro')
  var modal = $(this)
  modal.find('.modal-body #departName').val(departname)
  modal.find('.modal-body #departIntro').val(departIntro)
  modal.find('.modal-body #departId').val(id)
})
</script>
@stop
<?php
function getChild($data, $pId){
    $childs=array();
    $i=0;
    foreach($data as $k => $v){
        if($v['Pid'] == $pId){
            $v['serial']=++$i;
           $v['childs']=getChild($data,$v['id']);
            $childs[]=$v;
        }
    }

return  $childs;
}
//判断数组维度
function array_depth($arr)
{
    $array_max=1;
    foreach ($arr as $value) 
    {
        if(is_array($value))
        {
            $depth=array_depth($value)+1;       
            if($depth>$array_max)
            {
              $array_max=$depth;
            }
       }

    }

    return $array_max;
}
//循环输出数组
function loopArray($data){
     foreach($data as $dat){
            if(is_array($dat['childs'])){
                echo "<tr><td><strong>".$dat['serial']."</strong></td>
                    <td>".$dat['departName']."</td><td>".$dat['departIntro']."</td>
                    <td><button class='btn btn-sm btn-outline-success mx-1' data-toggle='modal' data-target='#staffUpdateModal'    data-intro=".$dat['departIntro']." data-id=".$dat['id']." data-departname=".$dat['departName']." >编辑</button><a class='btn btn-sm btn-outline-success mx-1' href='/admin/manage/staff/department/delete/".$dat['id']."' onclick='return disp_confirm()'>删除</a></td></tr>";
                $i=$dat['serial'];
                foreach($dat['childs'] as $childat){
                    $pinjie='';
                    $pinjie.=$i.'--';
                    $pinjie .=$childat["serial"];
                    echo "<tr><td>".$pinjie."</td>
                    <td>".$childat['departName']."</td><td>".$childat['departIntro']."</td>
                    <td><button class='btn btn-sm btn-outline-success mx-1' data-toggle='modal' data-target='#staffUpdateModal'    data-intro=".$childat['departIntro']." data-id=".$childat['id']." data-departname=".$childat['departName']." >编辑</button><a class='btn btn-sm btn-outline-success mx-1' href='/admin/manage/staff/department/delete/".$childat['id']."' onclick='return disp_confirm()'>删除</a></td></tr>";
                    foreach($childat['childs'] as $grandson){
                        $pinjie='';
                        $pinjie.=$i.'--';
                        $pinjie .=$childat["serial"];
                        $pinjie.='--'.$grandson['serial'];
                        echo "<tr><td>".$pinjie."</td><td>".$grandson['departName']."</td><td>".$grandson['departIntro']."</td><td ><button class='btn btn-sm btn-outline-success mx-1' data-toggle='modal' data-target='#staffUpdateModal'    data-intro=".$grandson['departIntro']." data-id=".$grandson['id']." data-departname=".$grandson['departName'].">编辑</button><a class='btn btn-sm btn-outline-success mx-1' href='/admin/manage/staff/department/delete/".$grandson['id']."' onclick='return disp_confirm()'>删除</a></td></tr>";
                    loopArray($grandson['childs']);
                    }
                        
                    
                   
                }}

           
                
                    
                
                
        }

}
function getParents($data,$pid){
       foreach($data as $item){
           if($item['id'] == $pid && $item['Pid']==0){
            return $item['id'];
           }elseif($item['id']==$pid && $item['Pid'] !=0){
            
            return getParents($data,$item['Pid']);
            }
        }
               
    }

       
      
    

  

?>