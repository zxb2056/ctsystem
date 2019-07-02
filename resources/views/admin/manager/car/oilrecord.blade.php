@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>车辆管理-油卡记录</title>
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
    <a class="nav-link active" href="{{url('/admin/manage/car/oilrecord')}}">油卡记录</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/maintainace')}}">保养记录</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/car/repair')}}">维修记录</a>
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
                    <h5><strong>加油卡消费记录</strong></h5>
            <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#oilrecordModal" >新增</a>     
                </div>

                       <form action="{{ url('/admin/manage/car/oilrecord')}}" method="get">
                            <div class="card-header">
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
            <div class="form-group form-row col-lg-3">
                <label for="cardId" class="col-sm-3 col-form-label">油卡号</label>
                <div class="col-md-9">
                <input type="text" class="form-control" name="cardId"  id="cardId" value="{{ $datas[ 'cardId' ]}}"> 
                </div>
            </div> 
            <div class="form-group  form-row col-lg-3" >
            <div class="col-md-6 offset-md-6">
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
                            <th>加油时间</th>
                            <th>油站位置名称</th>
                            <th>油卡号</th>
                            <th>油品类型</th>
                            <th>金额</th>
                            <th>里程数</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                 @foreach($records as $record)
                        <tr>
                            <td>{{ (($records->currentPage() - 1 ) * $records->perPage() ) + $loop->iteration}}</td>
                            <td>{{$record->licensePlate}}</td>
                            <td>{{$record->refueling_time}}</td>
                            <td>{{$record->station }}</td>
                            <td>{{$record->cardId}}</td>
                            <td>{{$record->oiltype}}</td>
                            <td>{{$record->amount}}</td>
                            <td>{{$record->mileage}}</td>
                            <td class="d-flex" width="150">
                            <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$record->id}}" data-plate="{{$record->licensePlate}}" data-refueltime="{{$record->refueling_time}}" data-station="{{$record->station}}" data-cardid="{{$record->cardId }}" data-oiltype="{{$record->oiltype}}" data-amount="{{$record->amount }}" data-mileage="{{$record->mileage}}" >编辑</a>
                            <a type="button" href='{{url("/admin/manage/car/oilrecord/delete/{$record->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                            </td>
                        </tr>
                @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center">
                    {{$records->appends($datas)->links()}}
            </div>
                    </div>
                </div>
            </div>
    </div>

  <!-- oilcardModal     -->
  <div class="modal fade" id="oilrecordModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增油卡信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增油卡信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/oilcard_add" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="cardID" class="col-sm-3 col-form-label">油卡号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cardID" name="cardID" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label  for="applydate" class="col-md-3 col-form-label">办卡日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="applydate" name="applydate" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="PIC" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PIC" name="PIC" >
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="belongto" class="col-sm-3 col-form-label">油卡所属公司</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="belongto" name="belongto">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="remain" class="col-sm-3 col-form-label">余额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="remain" name="remain">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="wnstop" class="col-sm-3 col-form-label">是否停用</label>
                            <div class="col-sm-9">
                            <select name="wnstop" id="wnstop" class="form-control">
                            <option value="在用">在用</option>
                            <option value="停用">停用</option>
                            </select>
                                
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="cardnote" class="col-sm-3 col-form-label">说明</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cardnote" name="note">
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
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
            <h5 class="modal-title" id="exampleModalLabel">新增车辆信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增车辆信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/add_car" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  for="carBrand" class="col-md-3 col-form-label">车辆品牌</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id="carBrand" name="carBrand" required>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Vtype" class="col-sm-3 col-form-label">车辆型号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Vtype" name="Vtype" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Vcategory" class="col-sm-3 col-form-label">车辆类型</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="Vcategory" name="Vcategory">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="color" class="col-sm-3 col-form-label">颜色</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="color" name="color">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seatNumber" class="col-sm-3 col-form-label">座位数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="seatNumber" name="seatNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="EngineNumber" class="col-sm-3 col-form-label">发动机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="EngineNumber" name="EngineNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="frameNumber" class="col-sm-3 col-form-label">车架号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frameNumber" name="frameNumber">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
            note:车辆类型指：三轮，摩托车，轿车，货车，叉车等
        </div>
    </div>
 </div>
</div>
<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-2" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">修改车辆信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增车辆信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/car_update" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                            </div>
                            <input type="hidden" id='id' name='id'>
                        </div>
                        <div class="form-group row">
                            <label  for="carBrand" class="col-md-3 col-form-label">车辆品牌</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id="carBrand" name="carBrand" required>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Vtype" class="col-sm-3 col-form-label">车辆型号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Vtype" name="Vtype" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Vcategory" class="col-sm-3 col-form-label">车辆类型</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="Vcategory" name="Vcategory">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="color" class="col-sm-3 col-form-label">颜色</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="color" name="color">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seatNumber" class="col-sm-3 col-form-label">座位数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="seatNumber" name="seatNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="EngineNumber" class="col-sm-3 col-form-label">发动机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="EngineNumber" name="EngineNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="frameNumber" class="col-sm-3 col-form-label">车架号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frameNumber" name="frameNumber">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
            note:车辆类型指：三轮，摩托车，轿车，货车，叉车等
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
    var carBrand=button.data('brand')
    var Vtype=button.data('type')
    var Vcategory=button.data('cate')
    var color=button.data('color')
    var seatNumber=button.data('seat')
    var EngineNumber=button.data('engine')
    var frameNumber=button.data('frame')
    var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #licensePlate').val(licensePlate)
  modal.find('.modal-body #carBrand').val(carBrand)
  modal.find('.modal-body #Vtype').val(Vtype)
  modal.find('.modal-body #Vcategory').val(Vcategory)
  modal.find('.modal-body #color').val(color)
  modal.find('.modal-body #seatNumber').val(seatNumber)
  modal.find('.modal-body #EngineNumber').val(EngineNumber)
  modal.find('.modal-body #frameNumber').val(frameNumber)

 

})
</script>
@stop
