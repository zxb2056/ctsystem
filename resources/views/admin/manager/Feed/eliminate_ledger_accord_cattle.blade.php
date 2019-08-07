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
            <a class="nav-link" href="{{url('/admin/manage/feed/eliminate_ledger')}}">按批次</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{url('/admin/manage/feed/eliminate_ledger/accordCattle')}}">按牛号</a>
          </li>
    </ul>
@if(!empty(session('success')))
<div class="alert alert-success autohidereturn">
    {{session('success')}}
</div>
@endif
<div class="card-body my-1 border">
<form action="/admin/manage/feed/eliminate_ledger/accordCattle" onkeydown="if(event.keyCode==13)return false;">
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
                <div class="form-group row">
                  <label for="cattleID" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">牛号</label>
                  <div class="col-sm-9">
                    <input type="text" name="cattleID" id="cattleID" class="form-control form-control-sm my-1">
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
                    <div class="form-group row ">
                      <label for="dayAgeOfSold" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">淘汰日龄</label>
                      <div class="col-md-9 input-group">
                        <div class="input-group-prepend-sm">
                          <select name="dayAgeRequire" id="dayAgeRequire" class="custom-select-sm">
                            <option value=">">></option>
                            <option value="=">=</option>
                            <option value="<"><</option>
                            </select> 
                            </div>
                             <input type="text" name="dayAgeOfSold" id="dayAgeOfSold" class="form-control form-control-sm">
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
<table class="table table-hover mt-3">
<thead>
    <tr>
    <th>序号</th>
    <th>牛号</th>
    <th>淘汰日期</th>
    <th>淘汰日龄</th>
    <th>性别</th>
    <th>淘汰去向</th>
    <th>购买者名称</th>
    <th>体重</th>
    <th>收入</th>
    <th>负责人</th>
    <th>所属批次</th>
    </tr>
</thead>
<tbody>
    @foreach($eliminates as $eliminate)
    <tr>
    <td>{{(($eliminates->currentPage()-1)*$eliminates->perPage())+ $loop->iteration}}</td>
    <td>{{$eliminate->cattleID}}</td>
    <td>{{$eliminate->elimiDay}}</td>
    <td>{{$eliminate->dayAgeOfSold}}</td>
    <td>{{$eliminate->gender}}</td>
    <td>{{$eliminate->linkbatch->toWhere}}</td>
    <td>{{$eliminate->linkbatch->buyerName}}</td>
    <td>{{$eliminate->linkbatch->totalWeight}}</td>
    <td>{{$eliminate->avgIncome}}</td>
    <td>{{$eliminate->PIC}}</td>
    <td>{{$eliminate->linkbatch->elimiOrder}}</td>
    </tr>
    @endforeach
</tbody>
</table>
<div class="card-footer d-flex justify-content-center">
    {{$eliminates->appends($datas)->links()}}
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/sell_batch.js"></script>
<script type="text/javascript" src="/js/autohideerror.js"> </script>
@stop
