@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>饲料转化率明细页</title>
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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">首页</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/growth">生产性能测定</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/feed_conversion">饲料转化率</a></li>
    <li class="breadcrumb-item active" aria-current="page">异常提醒</li>
  </ol>
</nav>

<div class="card rounded-0 my-3 ">
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">群体数量不符</h4>
  <p>你看到这个页面，是因为系统检测到实验组标明的牛头数和实际数据库中的牛头数不一致。这可能是数据输入有误造成。你可以修改实验组的牛头数，或者删除实验组重建。</p>
  <hr>
  <p>实验组标明是{{$totalcattle}}头，数据库中实际有{{$actual_quantity}}头。</p>
  </div>
<div class="card-body">
<div class="row">
<div class="col-md-6">
<form action="/admin/manage/performance/feed_conversion/updateExperiment" method="POST">
                    {{ csrf_field() }}
                    <h5 class="mb-4">解决方案一：更新实验组</h5>
                        <div class="form-group form-row">
                            <label for="experiname" class="col-sm-3 col-form-label">实验组名字</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="{{$experiName->id}}">
                                <input type="text" class="form-control" id="experiname" name="experimentName" value="{{$experiName->experimentName}}" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="startDate" class="col-sm-3 col-form-label">开始时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="startDate" name="startDate" value="{{$experiName->startDate}}" disabled>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="cattle_quantity" class="col-sm-3 col-form-label">开始牛只数量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cattle_quantity" name="cattle_quantity">
                            </div>
                        </div>
                        <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-outline-primary">更新</button>
                        </div>
                        </form>

</div>
<div class="col-md-6">
<h5 class="mb-4">解决方案二：删除实验组，然后新建</h5>

<a href='{{url("/admin/manage/performance/feed_conversion/deleteExperiment/{$experiName->id}")}}' class="form-control col-md-6 btn btn-outline-warning"  >删除实验组</a>

</div>
</div>

</div>

</div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/checkfeedrecord.js"></script>

@stop
