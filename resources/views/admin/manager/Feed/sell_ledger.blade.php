@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>销售记录</title>
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
          <a class="nav-link" href="{{url('/admin/manage/feed/eliminate_ledger')}}">淘汰记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{url('/admin/manage/feed/sell_ledger')}}">出售记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/change_barn_history')}}">转舍记录</a>
        </li>
    </ul>
    <ul class="nav nav-tabs bg-light mt-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{url('/admin/manage/feed/sell_ledger')}}">按批次</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/feed/sell_ledger/accordCattle')}}">按牛号</a>
          </li>
    </ul>
@if(!empty(session('success')))
<div class="alert alert-success autohidereturn">
    {{session('success')}}
</div>
@endif
<div class="card-body my-1 border">
  <form action="/admin/manage/feed/sell_ledger"  onkeydown="if(event.keyCode==13)return false;">
<div class="form-row">
    <div class="col-md-3">
      <div class="form-group row ">
        <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">显示条数</label>
                <div class="col-md-9">
                        <select name="showitem" id="showitem" class="form-control form-control-sm" name="showitem">
                          <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                          <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                          <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                          <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                        </select>
        </div>
      </div>
    </div>
    <div class="col-md-3">
        <div class="form-group row ">
          <label for="querystartdate" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">起始日期</label>
          <div class="col-md-9">
            <input type="date" id="querystartdate" class="form-control form-control-sm" name="startdate" value="{{ $datas['startDate'] }}">

          </div>
        </div>
      </div>
      <div class="col-md-3">
          <div class="form-group row ">
            <label for="queryenddate" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">截止日期</label>
            <div class="col-md-9">
              <input type="date" id="queryenddate" class="form-control form-control-sm" name="stopdate" value="{{ $datas['stopDate']}}">

            </div>
          </div>
        </div>
    <div class="col-md-3">
        <div class="form-group row">
          <label for="cattleFrom" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">出售特征</label>
          <div class="col-sm-9">
            <select name="cattleFrom" id="cattleFrom" class="form-control form-control-sm my-1" >
                <option value="">点击选择</option>
                <option value="单个出售" @if($datas[ 'cattleFrom' ]=='单个出售') selected @endif>单个出售</option>
                <option value="组合" @if($datas[ 'cattleFrom' ]=='组合') selected @endif>组合</option>
                <option value="整舍" @if($datas[ 'cattleFrom' ]=='整舍') selected @endif>整舍</option>
            </select>
          </div>
        </div>
      </div>

        <div class="col-md-3">
            <div class="form-group row">
              <label for="buyerName" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">购买者名称</label>
              <div class="col-sm-9">
                <input name="buyerName" id="buyerName" class="form-control form-control-sm my-1" value="{{ $datas['buyerName']}}">
              </div>
            </div>
          </div>
          <div class="col-md-3">
              <div class="form-group row">
                <label for="batchOrder" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">批次</label>
                <div class="col-sm-9">
                  <input type="text" name="batchOrder" id="batchOrder" class="form-control form-control-sm my-1" value="{{ $datas['batchOrder']}}">
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
    <th>出售日期</th>
    <th>出售特征</th>
    <th>出售牛数</th>
    <th>购买者性质</th>
    <th>购买者名称</th>
    <th>购买者手机</th>
    <th>单价(元/kg)</th>
    <th>总重量</th>
    <th>收入</th>
    <th>负责人</th>
    <th>说明</th>
  </tr>
</thead>
@foreach($batchs as $batch)
<tr>
    <td>{{(($batchs->currentPage() - 1 ) * $batchs->perPage() ) + $loop->iteration}}</td>
<td><a href="/admin/manage/feed/sell/sellBatchOrder/{{$batch->batchOrder}}">{{$batch->batchOrder}}</a></td>
    <td>{{$batch->batchSellDay}}</td>
    <td>{{$batch->cattleFrom}}</td>
    <td>{{$batch->totalCattleNum}}</td>
    <td>{{$batch->buyerAttribute}}</td>
    <td>{{$batch->buyerName}}</td>
    <td>{{$batch->buyerPhone}}</td>
    <td>{{$batch->PricePerKg}}</td>
    <td>{{$batch->totalWeight}}</td>
    <td>{{$batch->actualIncome}}</td>
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
