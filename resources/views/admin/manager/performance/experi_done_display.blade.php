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
    <li class="breadcrumb-item active" aria-current="page">{{$experiName->experimentName}}</li>
  </ol>
</nav>
<div class="card rounded-0 my-3 ">
<div class="card-header d-flex">
    <h4 class="text-center"><strong>{{$experiName->experimentName}}</strong>--(<span style="color:red"><small>已完成</small></span>)</h4> 

</div>
    <div class="card-body">
    <div class="row">
   
    <div class="col-md-2">
    <strong>实验组信息</strong>
    </div>
    <div class="col-md-10">
        <span class="mx-1 p-1">开始日期：{{$experiName->startDate}}</span><span class="mx-1 p-1">开始牛头数：{{$experiName->cattle_quantity}}</span>
        <span class="mx-1 p-1">结束牛头数：{{$experiName->end_quantity}}</span>
        <span class="mx-1 p-1">开始总体重：{{$experiName->startWeight}}kg</span><span class="mx-1 p-1">精料配方：{{$experiName->concentrate}}</span>
        <br><br>
        <span class="mx-1 p-1">结束总体重：{{$experiName->endWeight}}kg</span><span class="mx-1 p-1">饲料转化率是：{{ $experiName->convertRatio }}</span>
    </div>
      </div>

    <div class="row mt-5">
        <div class="col-md-6  ">

        </div>
</div>
<hr>
@if($experiName->grouporSingle == 1)
<div class="card rounded-0 my-3 ">
<div class="card-header d-flex">
    <h5 class="text-center"><strong>个体饲料转化率</strong></h5> 
    <a  href='{{url("/admin/manage/performance/feed_conversion/experi_done/{$experiName->id}/feeding_details")}}' class="btn btn-sm btn-outline-primary ml-auto">查看饲喂明细</a>
</div>
<div class="card-body table-responsive">
              
              <table class="table table-hover border">
                    <thead>
                            <tr>
                                <th>序号</th>
                                <th>牛只信息</th>
                                <th>初始体重</th>
                                <th>结束体重</th>
                                <th>饲料消耗量</th>
                                <th>饲料转化率</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cattleIDs as $cattleID)
                        <tr>
                        <td>{{ (($cattleIDs->currentPage() - 1 ) * $cattleIDs->perPage() ) + $loop->iteration}}</td>
                        <td>{{ $cattleID->cattleID }}</td>
                        <td>{{ $cattleID->startWeight }}</td>
                        <td>{{ $cattleID->endWeight }}</td>
                        <td>{{ $cattleID->IndividualFeedConsumption }}</td>
                        <td>{{ $cattleID->IndividualFeedConvertRatio }}</td>
                        </tr>
                        @endforeach
                        </tbody>
</table>
</div>
<div class="card-footer d-flex justify-content-center">
           {{$cattleIDs->links()}}
</div>
</div>
@elseif($experiName->grouporSingle == 0)
<div class="card rounded-0 my-3 ">
<div class="card-header d-flex">
    <h5 class="text-center"><strong>饲料用量明细表</strong></h5> 
    </div>
    <form action='{{ url("/admin/manage/performance/feed_conversion/experi_done/{$experiName->id}/feeding_details")}}' method="get">
    <div class="card-header">
    <div class="form-row">
                        <div class="form-group form-row col-lg-3">
                        <label for="showitem" class="col-md-3 col-form-label">每页显示</label>
                        <div class="col-md-9">
                                <select name="showitem" id="showitem" class="form-control" >
                                <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                                <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                </select>
                                </div>
                                </div>

                            <div class="form-group form-row col-lg-3">
                                <label for="days" class="col-md-3 col-form-label">日期</label> 
                            <div class="col-md-9">
                            <input  type="date" class="form-control" id="days" name="days" value="{{ $datas[ 'days' ]}}"> 
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
                                <th>牛只信息</th>
                                <th>饲喂日期</th>
                                <th>饲料数量</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($feedDetails as $feedDetail)
                        <tr>
                        <td>{{ (($feedDetails->currentPage() - 1 ) * $feedDetails->perPage() ) + $loop->iteration}}</td>
                        <td>{{ $feedDetail->cattleName }}</td>
                        <td>{{ $feedDetail->days }}</td>
                        <td>{{ $feedDetail->feedAmount }}</td>
                        </tr>
                        @endforeach
                        </tbody>
</table>
</div>
<div class="card-footer d-flex justify-content-center">
           {{$feedDetails->appends($datas)->links()}}
</div>
</div>
@endif
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/checkfeedrecord.js"></script>

@stop
