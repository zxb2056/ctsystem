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
    <a class="nav-link " href="{{url('/admin/manage/car/oilcard')}}">油卡●充值</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="{{url('/admin/manage/car/oilcard/recharge')}}">充值明细</a>
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
    <div class="card-header d-flex">
            <h4 ><strong>油卡充值明细</strong></h4>
            <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#oilcardModal">添加记录</a>
    </div>
    <form action="{{ url('/admin/manage/car/oilcard/recharge')}}" method="get">
            <div class="row card-header ">
            <div class="form-group form-row col-lg-3">
            <label for="showitem" class="col-sm-3 col-form-label">每页显示</label>
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
                <label for="cardID" class="col-sm-3 col-form-label"> 油卡号</label>
                <div class="col-md-9">
                <input  type="text" class="form-control" id="cardID" name="cardID" value="{{ $datas[ 'cardID' ]}}"> 
                </div>
                
            </div>
           <div class="form-group form-row col-lg-3">
                <label for="querydate" class="col-sm-3 col-form-label">起始日期</label>
                <div class="col-md-9">
                <input type="date" class="form-control" name="startdate" value="{{ $datas[ 'startdate' ]}}" id="querydate" >
                </div>
               
            </div>
            <div class="form-group form-row col-lg-3">
                <label for="enddate" class="col-sm-3 col-form-label">截止日期</label>
                <div class="col-md-9">
                <input type="date" class="form-control" name="stopdate"  id="enddate" value="{{ $datas[ 'stopdate' ]}}" > 
                </div>
                
            </div> 
            <div class="form-group  form-row col-lg-3" >
                    <input  type="submit" class="btn btn-sm btn-outline-primary  form-control">
            </div>          
            </div>
            
            </form>



            <div class="card-body table-responsive">
        <table class="table table-hover border">
            <thead>
                        <tr>
                            <th>序号</th>
                            <th>油卡号</th>
                            <th>充值金额</th>
                            <th>经办人</th>
                            <th>充值日期</th>
                        </tr>
            </thead>
            <tbody>
                    @foreach($recharges as $recharge)
                    <tr>
                    <td>{{ (($recharges->currentPage() - 1 ) * $recharges->perPage() ) + $loop->iteration }}</td>
                    <td>{{$recharge->cardID}}</td>
                    <td>{{$recharge->rechargeAmount}}</td>
                    <td>{{$recharge->byperson}}</td>
                    <td>{{$recharge->rechargeDate}}</td>
                    
                    </tr>
                  @endforeach  
            </tbody>
    
    </table>
        
    </div>   

    <div class="card-footer d-flex justify-content-center">
       {{ $recharges->appends($datas)->links() }} 
    </div>
    </div>

  <!-- oilcardModal     -->
  <div class="modal fade" id="oilcardModal" tabindex="-1" role="dialog"  data-backdrop="static">
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


<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-2" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">修改油卡信息</h5>
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
                            <label for="upcardID" class="col-sm-3 col-form-label">油卡号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upcardID" name="cardID" required>
                                <input type="hidden" id="upid" name="id">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label  for="upapplydate" class="col-md-3 col-form-label">办卡日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="upapplydate" name="applydate" required>   
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upPIC" class="col-sm-3 col-form-label">经办人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upPIC" name="PIC" required>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="upbelongto" class="col-sm-3 col-form-label">油卡所属公司</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="upbelongto" name="belongto" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upremain" class="col-sm-3 col-form-label">余额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upremain" name="remain" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upwnstop" class="col-sm-3 col-form-label">是否停用</label>
                            <div class="col-sm-9">
                            <select name="wnstop" id="upwnstop" class="form-control">
                            <option value="在用">在用</option>
                            <option value="停用">停用</option>
                            </select>
                                
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="upcardnote" class="col-sm-3 col-form-label">说明</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upcardnote" name="note">
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">关闭</button>
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
    var cardID=button.data('cardid')
    var applydate=button.data('applydate')
    var PIC=button.data('pic')
    var belongto=button.data('belongto')
    var remain=button.data('remain')
    var wnstop=button.data('wnstop')
    var note=button.data('note')
    var modal = $(this)
  modal.find('.modal-body #upid').val(id)
  modal.find('.modal-body #upcardID').val(cardID)
  modal.find('.modal-body #upapplydate').val(applydate)
  modal.find('.modal-body #upPIC').val(PIC)
  modal.find('.modal-body #upbelongto').val(belongto)
  modal.find('.modal-body #upremain').val(remain)
  modal.find('.modal-body #upwnstop').val(wnstop)
  modal.find('.modal-body #upnote').val(note)

 

})
</script>
@stop
