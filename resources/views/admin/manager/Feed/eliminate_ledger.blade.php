@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>销售登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.must-fill-in{
    color:red;
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
          <a class="nav-link active" href="{{url('/admin/manage/feed/eliminate_ledger')}}">淘汰记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/sell_ledger')}}">出售记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/change_barn_history')}}">转舍记录</a>
        </li>
    </ul>
    <ul class="nav nav-tabs bg-light mt-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{url('/admin/manage/feed/eliminate_ledger')}}">按批次</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/feed/eliminate_ledger/accordCattle')}}">按牛号</a>
          </li>
    </ul>
@if(!empty(session('success')))
<div class="alert alert-success autohidereturn">
    {{session('success')}}
</div>
@endif
<div class="card-body my-1 border">
  <form action="/admin/manage/feed/eliminate_ledger"  onkeydown="if(event.keyCode==13)return false;">
<div class="form-row">
    <div class="col-md-3">
      <div class="form-group row ">
        <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">显示条数</label>
        <div class="col-md-9">
          <select name="showitem" id="showitem" class="form-control form-control-sm" name="showitem">
            <option value="10">10条</option>
            <option value="10">20条</option>
            <option value="10">30条</option>
            <option value="10">50条</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-3">
        <div class="form-group row ">
          <label for="querystartdate" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">起始日期</label>
          <div class="col-md-9">
            <input type="date" id="querystartdate" class="form-control form-control-sm" name="startdate">

          </div>
        </div>
      </div>
      <div class="col-md-3">
          <div class="form-group row ">
            <label for="queryenddate" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">截止日期</label>
            <div class="col-md-9">
              <input type="date" id="queryenddate" class="form-control form-control-sm" name="stopdate">

            </div>
          </div>
        </div>
    <div class="col-md-3">
        <div class="form-group row">
          <label for="reason" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">淘汰原因</label>
          <div class="col-sm-9">
            <select name="reason" id="reason" class="form-control form-control-sm my-1">
                <option value="">点击选择</option>
                <option value="疾病">疾病</option>
                <option value="死亡">死亡</option>
                <option value="低产">低产</option>
                <option value="遗传缺陷">遗传缺陷</option>
                <option value="禁配">禁配</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-3">
          <div class="form-group row">
            <label for="toWhere" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">淘汰去向</label>
            <div class="col-sm-9">
              <select name="toWhere" id="toWhere" class="form-control form-control-sm my-1">
                  <option value="">点击选择</option>
                  <option value="无害化处理">无害化处理</option>
                  <option value="屠宰场">屠宰场</option>
                  <option value="农户">农户</option>
                  <option value="其他">其他</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
              <label for="buyerName" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">购买者名称</label>
              <div class="col-sm-9">
                <input name="buyerName" id="buyerName" class="form-control form-control-sm my-1">
              </div>
            </div>
          </div>
          <div class="col-md-3">
              <div class="form-group row">
                <label for="elimiOrder" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">批次</label>
                <div class="col-sm-9">
                  <input type="text" name="elimiOrder" id="elimiOrder" class="form-control form-control-sm my-1">
                </div>
              </div>
            </div>
        <div class="col-md-3">
            <div class="form-group col-md-6">
                <input type="submit" class="btn btn-sm btn-outline-primary form-control" id="submit" value="提交">
              </div>
          </div>
        </form>
</div>
<table class="table table-hover">
<thead>
  <tr>
    <th>序号</th>
    <th>批次</th>
    <th>淘汰日期</th>
    <th>淘汰牛数</th>
    <th>原因</th>
    <th>淘汰去向</th>
    <th>购买者性质</th>
    <th>购买者名称</th>
    <th>购买者手机</th>
    <th>总重量</th>
    <th>收入</th>
    <th>负责人</th>
    <th>说明</th>
  </tr>
</thead>
@foreach($batchs as $batch)
<tr>
    <td>{{(($batchs->currentPage() - 1 ) * $batchs->perPage() ) + $loop->iteration}}</td>
<td><a href="/admin/manage/feed/eliminate/elimiOrder/{{$batch->elimiOrder}}">{{$batch->elimiOrder}}</a></td>
    <td>{{$batch->elimiDay}}</td>
    <td>{{$batch->totalNum}}</td>
    <td>{{$batch->reason}}</td>
    <td>{{$batch->toWhere}}</td>
    <td>{{$batch->buyerAttribute}}</td>
    <td>{{$batch->buyerName}}</td>
    <td>{{$batch->buyerPhone}}</td>
    <td>{{$batch->totalWeight}}</td>
    <td>{{$batch->Income}}</td>
    <td>{{$batch->PIC}}</td>
    <td>{{$batch->note}}</td>
  </tr>
@endforeach


</table>
<div class="card-footer d-flex justify-content-center">

 {{$batchs->appends($datas)->links()}}
</div>
</div>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/sell_batch.js"></script>
<script type="text/javascript" src="/js/autohideerror.js"> </script>
@stop
