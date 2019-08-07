@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')

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
    <a class="nav-link" href="{{url('/admin/manage/staff/partment')}}">部门管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/map_s_d')}}">设置员工部门</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/staff/tmpworker')}}">临时用工</a>
  </li>

</ul>
<div class="card rounded-0 my-3">
                                @if(count($errors) >0)
                                <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                                </div>
                                @endif
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>员工列表</strong></div>
                    <a href="" class="btn btn-sm btn-outline-primary ml-auto " data-toggle="modal" data-target="#tempworkerModal">新增</a>

                </div>

                <form action="{{ url('/admin/manage/staff/tmpworker')}}" method="get">
                        <div class="card-header">
                        <div class="form-row">
                        <div class="form-group form-row col-lg-3">
                        <label for="showitem" class="col-md-3 col-form-label">每页显示</label>
                        <div class="col-md-9">
                                <select name="showitem" id="showitem" class="form-control" >
                                <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10</option>
                                <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                </select>
                                </div>
                                </div>
                                <div class="form-group form-row col-lg-3">
                                <label for="staffName" class="col-md-3 col-form-label">姓名</label> 
                            <div class="col-md-9">
                            <input  type="text" class="form-control" id="staffName" name="name" value="{{ $datas['name']}}"> 
                            </div>
                            </div>
                                <div class="form-group  form-row col-lg-3" >
                                <div class="col-md-6">
                                <input  type="submit" class="btn btn-sm btn-outline-success form-control">
                                </div>
                            </div>
                            </div>
                                </form>
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>手机号</th>
                            <th>身份证号</th>
                            <th>工作开始日期</th>
                            <th>工作结束日期</th>
                            <th>工作内容</th>
                            <th>日工资额</th>
                            <th>总额</th>
                            <th>工资支付状态</th>
                            <th>工资支付日期</th>
                            <th>备注(已付，未付，因故取消)</th>
                            <th>填表人</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tempworkers as $tempworker)
                   <tr>
                   <td>{{ (($tempworkers->currentPage() - 1 ) * $tempworkers->perPage() ) + $loop->iteration}}</td>
                   <td>{{$tempworker->name}}</td>
                   <td>{{$tempworker->gender}}</td>
                   <td>{{$tempworker->mobilePhone}}</td>
                   <td>{{$tempworker->personid}}</td>
                   <td>{{$tempworker->startDay}}</td>
                   <td>{{$tempworker->endDay}}</td>
                   <td>{{$tempworker->workContent}}</td>
                   <td>{{$tempworker->dailySalary}}</td>
                   <td>{{$tempworker->totalSalary}}</td>
                   <td>{{$tempworker->payStatus}}</td>
                   <td>{{$tempworker->payDate}}</td>
                   <td>{{$tempworker->note}}</td>
                   <td>{{$tempworker->fill_form_by}}</td>
                   <td> 
                <a type="button"  href='' class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$tempworker->id}} " data-name="{{$tempworker->name}}" data-gender="{{ $tempworker->gender}}" data-mobilephone="{{ $tempworker->mobilePhone }}" data-personid ="{{ $tempworker->personid }}" data-startday="{{ $tempworker->startDay }}" data-endday="{{ $tempworker->endDay }}" data-workcontent="{{ $tempworker->workContent }}" data-dailysalary="{{ $tempworker->dailySalary }}" data-totalsalary="{{ $tempworker->totalSalary }}" data-paystatus="{{ $tempworker->payStatus }}" data-payday="{{$tempworker->payDate }}" data-note="{{$tempworker->note }}" data-filler="{{$tempworker->fill_form_by }}">编辑</a>
                <a type="button" href='{{url("/admin/manage/staff/delete_tmpworker/{$tempworker->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a></td>
                    </tr>
                   @endforeach
                    </tbody>

          </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
            {{$tempworkers->appends($datas)->links()}}
            </div>
            </div>


    
    
      
<!-- listModal -->
<div class="modal fade" id="tempworkerModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增用工情况</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增用工情况</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/add_tmpworker" method="POST" class="was-validated">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="addstaffname" class="col-sm-3 col-form-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addstaffname" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label">性别</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input class="custom-control-input " type="radio" name="gender" id="addinlineRadio1"
                                            value="1"  checked="checked" >
                                        <label class="custom-control-label " for="addinlineRadio1" >男</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="gender" id="addinlineRadio2"
                                            value="2" >
                                        <label class="custom-control-label" for="addinlineRadio2">女</label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addstaffPhone" class="col-sm-3 col-form-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addstaffPhone" name="mobilePhone" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addPID" class="col-sm-3 col-form-label">身份证号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addPID" name="personid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addstartday" class="col-sm-3 col-form-label">入职日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addstartday" name="startDay" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addendday" class="col-sm-3 col-form-label">结束日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addendday" name="endDay">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addworkContent" class="col-sm-3 col-form-label">工作内容</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addworkContent" name="workContent" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adddailySalary" class="col-sm-3 col-form-label">日工资额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="adddailySalary" name="dailySalary" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addtotalSalary" class="col-sm-3 col-form-label">总工资额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addtotalSalary" name="totalSalary">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addpayStatus" class="col-sm-3 col-form-label">支付状态</label>
                            <div class="col-sm-9">
                            <select name="payStatus" id="addpayStatus" class="form-control">
                            <option value="未付">未付</option>
                            <option value="已付">已付</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="addpayDate" class="col-sm-3 col-form-label">支付日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addpayDate" name="payDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addnote" class="col-sm-3 col-form-label">说明</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addnote" name="note">
                                <input type="hidden" name="fill_form_by" value="{{Auth::user()->username}} ">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-2" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">修改员工信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>修改员工信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/update_tmpworker" method="POST" class="was-validated">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="upstaffname" class="col-sm-3 col-form-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upstaffname" name="name" required>
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label">性别</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input class="custom-control-input " type="radio" name="gender" id="upinlineRadio1"
                                            value="男"  >
                                        <label class="custom-control-label " for="upinlineRadio1" >男</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="gender" id="upinlineRadio2"
                                            value="女" >
                                        <label class="custom-control-label" for="upinlineRadio2">女</label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upmobilePhone" class="col-sm-3 col-form-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upmobilePhone" name="mobilePhone" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="upPID" class="col-sm-3 col-form-label">身份证号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upPID" name="personid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upstartday" class="col-sm-3 col-form-label">入职日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="upstartday" name="startDay" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upendday" class="col-sm-3 col-form-label">结束日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="upendday" name="endDay">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upworkContent" class="col-sm-3 col-form-label">工作内容</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upworkContent" name="workContent" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="updailySalary" class="col-sm-3 col-form-label">日工资额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="updailySalary" name="dailySalary" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uptotalSalary" class="col-sm-3 col-form-label">总工资额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uptotalSalary" name="totalSalary">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uppayStatus" class="col-sm-3 col-form-label">支付状态</label>
                            <div class="col-sm-9">
                            <select name="payStatus" id="uppayStatus" class="form-control">
                            <option value="未付">未付</option>
                            <option value="已付">已付</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="uppayDate" class="col-sm-3 col-form-label">支付日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="uppayDate" name="payDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upnote" class="col-sm-3 col-form-label">说明</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upnote" name="note">
                                <input type="hidden" name="fill_form_by" value="{{Auth::user()->username}} ">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/disp_confirm.js"></script>
<script type="text/javascript">
$('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id=button.data('id')
    var name=button.data('name')
    var gender=button.data('gender')
    var mobilePhone=button.data('mobilephone')
    var personid=button.data('personid')
    var startDay=button.data('startday')
    var endDay=button.data('endday')
    var workContent=button.data('workcontent')
    var dailySalary=button.data('dailysalary')
    var totalSalary=button.data('totalsalary')
    var payStatus=button.data('paystatus')
    var payDate=button.data('payday')
    var note=button.data('note')
    var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #upstaffname').val(name)
  modal.find('.modal-body #upmobilePhone').val(mobilePhone)
  modal.find('.modal-body #upPID').val(personid)
  modal.find('.modal-body #upstartday').val(startDay)
  modal.find('.modal-body #upendday').val(endDay)
  modal.find('.modal-body #upworkContent').val(workContent)
  modal.find('.modal-body #updailySalary').val(dailySalary)
  modal.find('.modal-body #uptotalSalary').val(totalSalary)
  modal.find('.modal-body #uppayStatus').val(payStatus)
  modal.find('.modal-body #uppayDate').val(payDate)
  modal.find('.modal-body #upnote').val(note)
  if(gender == '男'){
    modal.find('.modal-body input#upinlineRadio1').prop('checked','checked')
  }else{
    modal.find('.modal-body input#upinlineRadio2').prop('checked','checked')
  }
 

})
</script>
@stop
