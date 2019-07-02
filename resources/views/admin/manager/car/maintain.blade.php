@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>车辆管理</title>
@stop
@section('css')
<style>
.carstatus{
    display:inline-block;
    width:100px;
}
</style>
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
    <a class="nav-link" href="{{url('/admin/manage/car')}}">车辆信息</a>
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
    <a class="nav-link active" href="{{url('/admin/manage/car/maintainace')}}">保养记录</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/repair')}}">维修记录</a>
  </li>


</ul>
    
               <div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                <h5><strong>车辆保养</strong></h5>
                <a  href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#staffModal" >新增</a>
                </div>
                    <form action="{{ url('/admin/manage/car/maintainace')}}" method="get">
                        <div class="card-header">
                        <div class="form-row">
                        <div class="form-group form-row col-lg-3">
                        <label for="showitem" class="col-md-3 col-form-label">每页显示</label>
                                <div class="col-md-9">
                                <select name="showitem" id="showitem" class="form-control">
                                    <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10</option>
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
                        </form>

                            </div> 

                <div class="card-body table-responsive">
              
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>车牌号</th>
                            <th>保养日期</th>
                            <th>经办人</th>
                            <th>修理厂</th>
                            <th>里程数</th>
                            <th>保养费用</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                 @foreach($maintains as $maintain)
                        <tr>
                            <td>{{ (($maintains->currentPage() - 1 ) * $maintains->perPage() ) + $loop->iteration}}</td>
                            <td>{{$maintain->licensePlate}}</td>
                            <td>{{$maintain->maintain_day}}</td>
                            <td>{{$maintain->pic}}</td>
                            <td>{{$maintain->repair_plant}}</td>
                            <td>{{$maintain->mileage}}</td>
                            <td>{{$maintain->cost}}</td>
                            <td class="d-flex" width="150">
                            <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$maintain->id}}" data-plate="{{$maintain->licensePlate}}" data-date="{{ $maintain->maintain_day }}" data-pic="{{$maintain->pic}}" data-plant="{{$maintain->repair_plant}}" data-mileage="{{$maintain->mileage}}" data-cost="{{$maintain->cost}}">编辑</a>
                            <a type="button" href='{{url("/admin/manage/car/maintain/delete/{$maintain->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                            </td>
                        </tr>
                @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center">
           {{$maintains->appends($datas)->links()}}
            </div>
                    </div>
                </div>
            </div>
    </div>
      
<!-- listModal -->
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增保养信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增保养信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/maintain/add" method="POST" class="was-validated" >
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-md-9">
                            <select class="form-control" id="licensePlate" name="licensePlate" required>
                            @foreach($carinfos as $carinfo)
                            <option value="{{$carinfo->licensePlate}}">{{$carinfo->licensePlate}}</option>
                            @endforeach    
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  for="maintain_day" class="col-md-3 col-form-label">保养日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="maintain_day" name="maintain_day" required>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pic" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pic" name="pic" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="repair_plant" class="col-sm-3 col-form-label">修理厂</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="repair_plant" name="repair_plant" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mileage" class="col-sm-3 col-form-label">保养里程数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="mileage" name="mileage" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cost" class="col-sm-3 col-form-label">费用</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cost" name="cost" required>
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
            <h5 class="modal-title" id="exampleModalLabel">修改保养信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增保养信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/maintain/update" method="POST" class="was-validated" >
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="uplicensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-md-9">
                                <input type="text" id="uplicensePlate" name="licensePlate"> 
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  for="upmaintain_day" class="col-md-3 col-form-label">保养日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="upmaintain_day" name="maintain_day" required>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uppic" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uppic" name="pic" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="uprepair_plant" class="col-sm-3 col-form-label">修理厂</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="uprepair_plant" name="repair_plant" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upmileage" class="col-sm-3 col-form-label">保养里程数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upmileage" name="mileage" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upcost" class="col-sm-3 col-form-label">费用</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upcost" name="cost" required>
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
    var maintain_day=button.data('date')
    var pic=button.data('pic')
    var repair_plant=button.data('plant')
    var mileage=button.data('mileage')
    var cost=button.data('cost')
    var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #uplicensePlate').val(licensePlate)
  modal.find('.modal-body #upmaintain_day').val(maintain_day)
  modal.find('.modal-body #uppic').val(pic)
  modal.find('.modal-body #uprepair_plant').val(repair_plant)
  modal.find('.modal-body #upmileage').val(mileage)
  modal.find('.modal-body #upcost').val(cost)

})
</script>
@stop
