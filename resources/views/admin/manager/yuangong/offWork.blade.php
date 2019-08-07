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
    <a class="nav-link active" href="{{url('/admin/manage/staff/offWork')}}">请假</a>
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
    <a class="nav-link" href="{{url('/admin/manage/staff/tmpworker')}}">临时用工</a>
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
                    <h5><strong>请假条列表</strong></h5>
                    <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#offWorkModal">新增</a>

                </div>
                            <form action="{{ url('/admin/manage/staff/offWork')}}" method="get">
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
                            <input  type="text" class="form-control" id="staffName" name="name" value="{{ $datas[ 'name' ]}}"> 
                            </div>
                            </div>
                            <div class="form-group form-row col-lg-3">
                            <label for="querydate" class="col-sm-3 col-form-label">请假日期</label>
                            <div class="col-md-9">
                            <input type="date" class="form-control" name="startdate" value="{{ $datas[ 'startdate' ]}}" id="querydate">
                            </div> 
                            </div>
                            <div class="form-group form-row col-lg-3">
                                <label for="enddate" class="col-sm-3 col-form-label">截止日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" name="stopdate"  id="enddate" value="{{ $datas[ 'stopdate' ]}}"> 
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
                        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>员工姓名</th>
                            <th>请假事由</th>
                            <th>请假起始时间</th>
                            <th>请假结束时间</th>
                            <th>请假类型</th>
                            <th>部门领导审批</th>
                            <th>实际返厂时间</th>
                            <th>填表人</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
             
                   @foreach($qjts as $qjt)
                   <tr>
                        <td>{{ (($qjts->currentPage() - 1 ) * $qjts->perPage() ) + $loop->iteration }}</td>
                        <td>{{ $qjt->name }}</td>
                        <td width="300px">{{ $qjt->Reason}}</td>
                        <td>{{ $qjt->startTime}}</td>
                        <td>{{ $qjt->endTime }}</td>
                        <td>{{ $qjt->offType }}</td>
                        <td>{{ $qjt->leaderApproval }}</td>
                        <td>{{ $qjt->returnTime }}</td>
                        <td>{{ $qjt->fill_form_by }}</td>
                        <td>  <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#offworkupdateModal" data-id="{{$qjt->id}} " data-name="{{$qjt->name}}"  data-reason="{{ $qjt->Reason }}" data-starttime ="{{ $qjt->startTime }}" data-endtime="{{ $qjt->endTime }}" data-offtype="{{ $qjt->offType }}" data-leaderapproval="{{ $qjt->leaderApproval }}" data-returntime="{{ $qjt->returnTime }}" data-fill="{{ $qjt->fill_form_by }}" >编辑</a>
                        <a type="button" href='{{url("/admin/manage/staff/offwork/delete/{$qjt->id}")}}' class="btn btn-sm btn-outline-primary p-1 mx-1 text-dark" onclick="disp_confirm()">删除</a>
                        </td>
                    </tr>
                   @endforeach
                    </tbody>

          </table>
                    </div>
            <div class="card-footer d-flex justify-content-center">
            {{ $qjts->appends($datas)->links()}}
            </div>
                    </div>
                </div>
            </div>
    </div>
      
<!-- listModal -->
<div class="modal fade" id="offWorkModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增请假条</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增请假条</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/offWork/store" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="staffname" class="col-sm-3 col-form-label">员工姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staffname" name="name" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="offReason" class="col-sm-3 col-form-label">请假事由</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="offReason" name="Reason" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="startTime" class="col-sm-3 col-form-label">请假起始时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="startTime" name="startTime">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endTime" class="col-sm-3 col-form-label">请假结束时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="endTime" name="endTime">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="offType" class="col-sm-3 col-form-label">请假类型</label>
                            <div class="col-sm-9">
                            <select id="offType" name="offType" class="form-control" ">
                            <option value="病假">病假</option>
                            <option value="事假">事假</option>
                            <option value="婚假">婚假</option>
                            <option value="产假">产假</option>
                            <option value="年假">年假</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="approval" class="col-sm-3 col-form-label">部门负责人审批</label>
                            <div class="col-sm-9">
                            <select id="approval" name="leaderApproval" class="form-control">
                            <option value="同意">同意</option>
                            <option value="不同意">不同意</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="returnTime" class="col-sm-3 col-form-label">实际返厂时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="returnTime" name="returnTime">
                            </div>
                            <input type="hidden" id="fill_form_by" name="fill_form_by" value="{{Auth::user()->username}}">
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
<div class="modal fade" id="offworkupdateModal" tabindex="-2" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">更新请假信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>更新请假信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/offwork/update" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="staffname" class="col-sm-4 col-form-label">员工姓名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staffname" name="name" required>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="offReason" class="col-sm-4 col-form-label">请假事由</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="offReason" name="Reason" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="startTime" class="col-sm-4 col-form-label">请假起始时间</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="startTime" name="startTime">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endTime" class="col-sm-4 col-form-label">请假结束时间</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="endTime" name="endTime">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="offType" class="col-sm-4 col-form-label">请假类型</label>
                            <div class="col-sm-8">
                            <select id="offType" name="offType" class="form-control" ">
                            <option value="病假">病假</option>
                            <option value="事假">事假</option>
                            <option value="婚假">婚假</option>
                            <option value="产假">产假</option>
                            <option value="年假">年假</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="approval" class="col-sm-4 col-form-label">部门负责人审批</label>
                            <div class="col-sm-8">
                            <select id="approval" name="leaderApproval" class="form-control">
                            <option value="同意">同意</option>
                            <option value="不同意">不同意</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="returnTime" class="col-sm-4 col-form-label">实际返厂时间</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="returnTime" name="returnTime">
                            </div>
                            <input type="hidden" id="fill_form_by" name="fill_form_by" value="{{Auth::user()->username}}">
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
<script type="text/javascript" src="{{asset('/js/disp_confirm.js')}}"></script>
<script type="text/javascript">
$('#offworkupdateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id=button.data('id')
    var name=button.data('name')
    var Reason=button.data('reason')
    var starttime=button.data('starttime')
    var endTime=button.data('endtime')
    var offType=button.data('offtype')
    var approval=button.data('leaderapproval')
    var returnTime=button.data('returntime')
    var modal = $(this)
starttime=starttime.replace(/(\d{4}-\d{2}-\d{2})\s/g,'$1'+'T')
endTime=endTime.replace(/(\d{4}-\d{2}-\d{2})\s/g,'$1'+'T')
returnTime=returnTime.replace(/(\d{4}-\d{2}-\d{2})\s/g,'$1'+'T')
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #staffname').val(name)
  modal.find('.modal-body #offReason').val(Reason)
  modal.find('.modal-body #startTime').val(starttime)
  modal.find('.modal-body #endTime').val(endTime)
  modal.find('.modal-body #offType').val(offType)
  modal.find('.modal-body #approval').val(approval)
  modal.find('.modal-body #returnTime').val(returnTime)

})
</script>

@stop
