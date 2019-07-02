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
    <a class="nav-link active" href="{{url('/admin/manage/car')}}">车辆信息</a>
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
                    <div class="mr-auto"><strong>车辆状态明细</strong></div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-2 text-center"><span><strong>空闲车辆</strong></span></div>
                    <div class="col-md-10 bg-light">
                    @foreach($carstatus as $carstat)
                    <span class="mx-2 my-2 carstatus" >{{$carstat->carinfo->licensePlate}}</span>

                    @endforeach
                    </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-2 text-center"><span><strong>外出车辆</strong></span></div>
                    <div class="col-md-10 bg-light">
                    @foreach($carouts as $carout)
                    <span class="mx-2 my-2 carstatus">{{ $carout->carinfo->licensePlate}}</span>

                    @endforeach
                    </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-2 text-center"><span><strong>保养车辆</strong></span></div>
                    <div class="col-md-10 bg-light">
                    @foreach($carmaints as $carmaint)
                    <span class="mx-2 my-2 carstatus">{{ $carmaint->carinfo->licensePlate}}</span>

                    @endforeach
                    </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-2 text-center"><span><strong>年检其它车辆</strong></span></div>
                    <div class="col-md-10 bg-light">
                    @foreach($carothers as $carother)
                    <span class="mx-2 my-2 carstatus">{{ $carother->carinfo->licensePlate}}</span>

                    @endforeach
                    </div>
                    </div>
                </div>
                </div>

                <div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <h5><strong>车辆列表</strong></h5>
            <a  href="" class="btn btn-sm btn-outline-primary  ml-auto" data-toggle="modal" data-target="#staffModal">新增</a>      
                </div>
                    <form action="{{ url('/admin/manage/car')}}" method="get">
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
                            <div class="form-group  form-row col-lg-3" >
                            <div class="col-md-6 offset-md-6">
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
                            <th>车辆品牌</th>
                            <th>车辆型号</th>
                            <th>车辆类型</th>
                            <th>颜色</th>
                            <th>座位数</th>
                            <th>发动机号</th>
                            <th>车架号</th>

                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                 @foreach($cars as $car)
                        <tr>
                            <td>{{ (($cars->currentPage() - 1 ) * $cars->perPage() ) + $loop->iteration}}</td>
                            <td>{{$car->licensePlate}}</td>
                            <td>{{$car->carBrand}}</td>
                            <td>{{$car->Vtype}}</td>
                            <td>{{$car->Vcategory}}</td>
                            <td>{{$car->color}}</td>
                            <td>{{$car->seatNumber}}</td>
                            <td>{{$car->EngineNumber}}</td>
                            <td>{{$car->frameNumber}}</td>
                            <td class="d-flex" width="150">
                            <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$car->id}}" data-plate="{{$car->licensePlate}}" data-brand="{{$car->carBrand}}" data-type="{{$car->Vtype}}" data-cate="{{$car->Vcategory}}" data-color="{{$car->color}}" data-seat="{{$car->seatNumber}}" data-engine="{{$car->EngineNumber}}" data-frame="{{ $car->frameNumber }}">编辑</a>
                            <a type="button" href='{{url("/admin/manage/car/delete/{$car->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                            </td>
                        </tr>
                @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center">
           {{$cars->appends($datas)->links()}}
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
