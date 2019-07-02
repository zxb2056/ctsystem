@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>车辆管理-回车登记</title>
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
    <a class="nav-link " href="{{url('/admin/manage/car')}}">车辆信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/regiout')}}">出车登记</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/regireturn')}}">回车登记</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/oilcard')}}">油卡●充值</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/oilcard/recharge')}}">充值明细</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/oilrecord')}}">油卡记录</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/maintainace')}}">保养记录</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="{{url('/admin/manage/car/repair')}}">维修记录</a>
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
                <h5><strong>车辆列表</strong></h5>
                <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal"  data-target="#addrepairModal" >新增</a>
 
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                    <form action="{{ url('/admin/manage/car/regireturn')}}" method="get">
                            <div class="card-header ">
                            <div class="form-row">
                            <div class="form-group form-row col-lg-3">
                            <label for="showitem" class="col-md-3 col-form-label">每页显示</label>
                            <div class="col-md-9">
                                <select name="showitem" id="showitem" class="form-control">
                                    <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                                    <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                    <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                    <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                </select>
                            </div>
                            </div>
                            <div class="form-group form-row col-lg-3">
                            <label for="licensePlate" class="col-md-3 col-form-label">车牌号</label>
                            <div class="col-md-9">
                            <input  type="text" class="form-control" id="licensePlate" name="licensePlate" value="{{ $datas[ 'licensePlate' ]}}"> 
                            </div>
                            </div>
                <div class="form-group form-row col-lg-3">
                <label for="querydate" class="col-sm-3 col-form-label">起始日期</label>
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
            </div>
                </form>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>车牌号</th>
                            <th>送修时间</th>
                            <th>送修原因</th>
                            <th>汽修厂</th>
                            <th>经办人</th>
                            <th>取车日期</th>
                            <th>修车费用</th>
                            <th>里程数</th>
                            <th>说明</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
               @foreach($repairs as $repair)
                <tr>
                <td>{{ (($repairs->currentPage() - 1 ) * $repairs->perPage() ) + $loop->iteration}}</td>
                <td>{{$repair->licensePlate}}</td>
                <td>{{$repair->send_date}}</td>
                <td>{{ $repair->reason }}</td>
                <td>{{ $repair->repair_plant }}</td>
                <td>{{ $repair->pic }}</td>
                <td>{{ $repair->back_date }}</td>
                <td>{{ $repair->cost }}</td>
                <td>{{ $repair->mileage }}</td>
                <td>{{ $repair->note }}</td>
                <td>
                <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$repair->id}}" data-plate="{{$repair->licensePlate}}" data-senddate="{{$repair->send_date}}" data-backdate="{{$repair->back_date}}" data-reason="{{ $repair->reason }}" data-plant="{{ $repair->repair_plant}}" data-pic="{{$repair->pic}}" data-cost="{{ $repair->cost }}" data-note="{{$repair->note}}" data-mileage="{{$repair->mileage}}">编辑</a>
                <a type="button" href='{{url("/admin/manage/car/regireturn/delete/{$repair->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                </td>
                </tr>
               @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center w-100">
       {{ $repairs->appends($datas)->links()}}
            </div>
                    </div>
                </div>
            </div>
    </div>
      
<!-- listModal -->
<div class="modal fade" id="addrepairModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">维修记录</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>维修记录</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/repair/add" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                            <select id="licensePlate" name="licensePlate"  class="form-control" required>
                            @foreach($cars as $car)
                                <option value="{{$car->licensePlate}}">{{ $car->licensePlate }}</option>
                            @endforeach
                            </select>
                               
                            </div>
                            
                        </div>
                        <div class="form-group form-row">
                            <label  for="send_date" class="col-md-3 col-form-label">送修日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="send_date" name="send_date" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="reason" class="col-sm-3 col-form-label">送修原因</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="reason" name="reason" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="repair_plant" class="col-sm-3 col-form-label">汽修厂</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="repair_plant" name="repair_plant" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="pic" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pic" name="pic" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="back_date" class="col-sm-3 col-form-label">取车日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="back_date" name="back_date" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="cost" class="col-sm-3 col-form-label">修车费用</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cost" name="cost" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="mileage" class="col-sm-3 col-form-label">里程数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="mileage" name="mileage" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="note" class="col-sm-3 col-form-label">备注</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="note" name="note">
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
            <h5 class="modal-title" id="exampleModalLabel">修改回车登记</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>修改回车登记</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/repair/update" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="uplicensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                            <input type="text" name="licensePlate" class="form-control" id="uplicensePlate" >
                            <input type="hidden" name="id" id="id"> 
                            </div>
                            
                        </div>
                        <div class="form-group form-row">
                            <label  for="upsend_date" class="col-md-3 col-form-label">送修日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="upsend_date" name="send_date" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upreason" class="col-sm-3 col-form-label">送修原因</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upreason" name="reason" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="uprepair_plant" class="col-sm-3 col-form-label">汽修厂</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uprepair_plant" name="repair_plant" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="uppic" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uppic" name="pic" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upback_date" class="col-sm-3 col-form-label">取车日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="upback_date" name="back_date" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upcost" class="col-sm-3 col-form-label">修车费用</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upcost" name="cost" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upmileage" class="col-sm-3 col-form-label">里程数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upmileage" name="mileage" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upnote" class="col-sm-3 col-form-label">备注</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upnote" name="note">
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
<script type="text/javascript" src="{{asset('/js/disp_confirm.js')}}"></script>
<script type="text/javascript">
$('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id=button.data('id')
    var licensePlate=button.data('plate')
    var send_date=button.data('senddate')
    var back_date=button.data('backdate')
    var reason=button.data('reason')
    var pic=button.data('pic')
    var repair_plant=button.data('plant')
    var cost=button.data('cost')
    var mileage=button.data('mileage')
    var note=button.data('note')
    var modal = $(this)

    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #uplicensePlate').val(licensePlate)
    modal.find('.modal-body #upsend_date').val(send_date)
    modal.find('.modal-body #upback_date').val(back_date)
    modal.find('.modal-body #upreason').val(reason)
    modal.find('.modal-body #uprepair_plant').val(repair_plant)
    modal.find('.modal-body #upcost').val(cost)
    modal.find('.modal-body #uppic').val(pic)
    modal.find('.modal-body #upmileage').val(mileage)
    modal.find('.modal-body #upnote').val(note)
 

})
</script>
@stop
