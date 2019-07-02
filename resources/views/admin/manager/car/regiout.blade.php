@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>车辆管理-出车登记</title>
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
    <a class="nav-link active" href="{{url('/admin/manage/car/regiout')}}">出车登记</a>
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
            <h5><strong>出车记录</strong></h5>
        <a  href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#staffModal" >新增</a>
            </div>

                       <form action="{{ url('/admin/manage/car/regiout')}}" method="get">
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
                <label for="vuser" class="col-sm-3 col-form-label">用车人</label>
                <div class="col-md-9">
                <input type="text" class="form-control" name="Vuser"  id="vuser" value="{{ $datas[ 'Vuser' ]}}"> 
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
                            <th>用车人</th>
                            <th>出车时间</th>
                            <th>驾驶员</th>
                            <th>目的地</th>
                            <th>出车事由</th>
                            <th>预计回车时间</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
               @foreach($outregis as $outregi)
                <tr>
                <td>{{ (($outregis->currentPage() - 1 ) * $outregis->perPage() ) + $loop->iteration}}</td>
                <td>{{$outregi->licensePlate}}</td>
                <td>{{$outregi->Vuser}}</td>
                <td>{{ $outregi->outtime}}</td>
                <td>{{ $outregi->driver }}</td>
                <td>{{ $outregi->destination}}</td>
                <td>{{ $outregi->forwhat }}</td>
                <td>{{ $outregi->estimatedreturn }}</td>
                <td>{{ $outregi->note }}</td>
                <td>
                <a type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$outregi->id}}" data-plate="{{$outregi->licensePlate}}" data-vuser="{{$outregi->Vuser}}" data-outtime="{{$outregi->outtime}}" data-driver="{{$outregi->driver}}" data-destination="{{$outregi->destination}}" data-forwhat="{{$outregi->forwhat}}" data-return="{{$outregi->estimatedreturn}}" data-note="{{ $outregi->note }}">编辑</a>
                <a type="button" href='{{url("/admin/manage/car/regiout/delete/{$outregi->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                </td>
                </tr>



               @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center w-100">
                    {{$outregis->appends($datas)->links()}}
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
            <h5 class="modal-title" id="exampleModalLabel">出车登记</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>出车登记</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/regiout/regiout_add" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                            <select id="licensePlate" name="carid"  class="form-control" required>
                            @foreach($outcars as $outcar)
                                <option value="{{$outcar->carinfo->id}}">{{ $outcar->carinfo->licensePlate }}</option>
                            @endforeach
                            </select>
                            </div>
                            
                        </div>
                        <div class="form-group form-row">
                            <label  for="Vuser" class="col-md-3 col-form-label">用车人</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id="Vuser" name="Vuser" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="outtime" class="col-sm-3 col-form-label">出车时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="outtime" name="outtime" >
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="driver" class="col-sm-3 col-form-label">驾驶员</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="driver" name="driver">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="destination" class="col-sm-3 col-form-label">目的地</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="destination" name="destination">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="forwhat" class="col-sm-3 col-form-label">出车事由</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="forwhat" name="forwhat">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="estimatedreturn" class="col-sm-3 col-form-label">预计回车时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="estimatedreturn" name="estimatedreturn">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="extranote" class="col-sm-3 col-form-label">备注</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="extranote" name="note">
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
            <h5 class="modal-title" id="exampleModalLabel">修改出车登记</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>修改出车登记</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/car/regiout/update" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="licensePlate" class="col-sm-3 col-form-label">车牌号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                            </div>
                            <input type="hidden" name="id" id='id'>
                        </div>
                        <div class="form-group form-row">
                            <label  for="Vuser" class="col-md-3 col-form-label">用车人</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id="Vuser" name="Vuser" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="outtime" class="col-sm-3 col-form-label">出车时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="outtime" name="outtime" >
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="driver" class="col-sm-3 col-form-label">驾驶员</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="driver" name="driver">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="destination" class="col-sm-3 col-form-label">目的地</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="destination" name="destination">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="forwhat" class="col-sm-3 col-form-label">出车事由</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="forwhat" name="forwhat">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="estimatedreturn" class="col-sm-3 col-form-label">预计回车时间</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="estimatedreturn" name="estimatedreturn">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="extranote" class="col-sm-3 col-form-label">备注</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="extranote" name="note">
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
    var Vuser=button.data('vuser')
    var outtime=button.data('outtime')
    var driver=button.data('driver')
    var destination=button.data('destination')
    var forwhat=button.data('forwhat')
    var estimatedreturn=button.data('return')
    var note=button.data('note')
    var modal = $(this)
    outtime=outtime.replace(/(\d{4}-\d{2}-\d{2})\s/g,'$1'+'T')
    estimatedreturn=estimatedreturn.replace(/(\d{4}-\d{2}-\d{2})\s/g,'$1'+'T')
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #licensePlate').val(licensePlate)
  modal.find('.modal-body #Vuser').val(Vuser)
  modal.find('.modal-body #outtime').val(outtime)
  modal.find('.modal-body #driver').val(driver)
  modal.find('.modal-body #destination').val(destination)
  modal.find('.modal-body #forwhat').val(forwhat)
  modal.find('.modal-body #estimatedreturn').val(estimatedreturn)
  modal.find('.modal-body #extranote').val(note)

 

})
</script>
@stop
