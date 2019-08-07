@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>转舍记录</title>
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
      <a class="nav-link" href="{{url('/admin/manage/feed/sell_ledger')}}">出售记录</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{url('/admin/manage/feed/change_barn_history')}}">转舍记录</a>
    </li>
</ul>

@if(!empty(session('success')))
<div class="alert alert-success autohidereturn">
    {{session('success')}}
</div>
@endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>转舍记录</strong></div>
                </div>
                
                <form action="/admin/manage/feed/change_barn_history"  onkeydown="if(event.keyCode==13)return false;" class="mt-1">
                    <div class="form-row">
                        <div class="col-md-3">
                          <div class="form-group row ">
                            <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">显示条数</label>
                            <div class="col-md-9">
                              <select name="showitem" id="showitem" class="form-control form-control-sm" name="showitem">
                                    <option value="10" @if(!$datas || $datas['showitem']==10) selected @endif>10条</option>
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
                              <input type="date" id="querystartdate" class="form-control form-control-sm" name="startdate" value="{{$datas['startdate']}}">
                    
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group row ">
                                <label for="queryenddate" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">截止日期</label>
                                <div class="col-md-9">
                                <input type="date" id="queryenddate" class="form-control form-control-sm" name="stopdate" value="{{$datas['stopdate']}}">
                    
                                </div>
                              </div>
                            </div>
                        
                              <div class="col-md-3">
                                  <div class="form-group row">
                                    <label for="cattleID" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-right">牛号</label>
                                    <div class="col-sm-9">
                                    <input type="text" name="cattleID" id="cattleID" class="form-control form-control-sm my-1" value="{{$datas['cattleID']}}">
                                    </div>
                                  </div>
                                </div>
                            <div class="col-md-3">
                                <div class="form-group col-md-6">
                                    <input type="submit" class="btn btn-sm btn-outline-primary form-control" id="submit" value="提交">
                                  </div>
                              </div>
                    </div>
                            </form>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>序号</th>
                                <th>牛号</th>
                                <th>转舍日期</th>
                                <th>转出舍</th>
                                <th>转入舍</th>
                                <th>原因</th>
                                <th>负责人</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($changes as $change)
                            <tr>
                            <td>{{(($changes->currentPage()-1 )*$changes->perPage()) + $loop->iteration}}</td>
                            <td>{{$change->linkcattle->cattleID}}</td>
                            <td>{{$change->changeDay}}</td>
                            <td>{{$change->leaveBarn}}</td>
                            <td>{{$change->enterBarn}}</td>
                            <td>{{$change->reason}}</td>
                            <td>{{$change->PIC}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                            {{$changes->appends($datas)->links()}}
                    </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/sell_batch.js"></script>
<script type="text/javascript" src="/js/autohideerror.js"> </script>
@stop
