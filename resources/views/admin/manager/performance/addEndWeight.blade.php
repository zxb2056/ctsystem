@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>完善结束体重信息</title>
@stop
@section('css')
<style>
p{
    text-indent:2rem;
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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">首页</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/growth">生产性能测定</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/feed_conversion">饲料转化率</a></li>
    <li class="breadcrumb-item active" aria-current="page">完善结束体重信息</li>
  </ol>
</nav>
@if($hasweightNumbers!=0)
<div class="alert alert-success" role="alert">
目前数据库中已经有{{$hasweightNumbers}}头牛的数据，实验组设定{{$setNumbers}}头牛，还有<?php echo $current=$setNumbers-$hasweightNumbers; ?>头牛体重数据要完善。
</div>
@else
<div class="alert alert-danger" role="alert">
提示: 系统检测到该实验组还没有实验结束时的牛只体重,请在此页完善后再进行下一步操作。
</div>
@endif
<div class="fluid-container">

    <div class="row my-4">
        <div class="col-md-6 ">
        <form action='{{url("/admin/manage/performance/feed_conversion/plusEndWeight/{$id}")}}' method="post">
        {{csrf_field()}}
        <div class="form-group form-row">
                            <label for="cattleID" class="col-sm-3 col-form-label">牛耳号</label>
                            <div class="col-sm-9">
                            <select class="form-control"  id="cattleID" name="cattleID"  required>
                            @foreach($cattles as $cattle)
                            <option value="{{$cattle->cattleID}}">{{$cattle->cattleID}}</option>
                            @endforeach
                            </select>

                            </div>
        </div>
        <div class="form-group form-row">
                            <label for="endWeight" class="col-sm-3 col-form-label">牛体重</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="endWeight" name="endWeight" >
                            </div>
        </div>
        <div class="text-right">
                          <button type="submit" class="btn btn-primary">保存</button>
        </div>
</form>
        </div>
        <div class="col-md-6 ">
            <p>为保证数据的准确性，结束体重不支持excel导入</p>
            <br>

        </div>
    </div>
     
</div>

<table class="table table-hover table-sm border mt-5">
            <thead>
                        <tr>
                            <th>序号</th>
                            <th>牛号</th>
                            <th>开始体重</th>
                            <th>结束体重</th>
                            <th>饲料消耗总量</th>
                            <th>个体饲料转化率</th>
                        </tr>
            </thead>
            <tbody>
                    @foreach($weights as $weight)
                    <tr>
                    <td>{{ (($weights->currentPage() - 1 ) * $weights->perPage() ) + $loop->iteration}}</td>
                    <td>{{ $weight->cattleID }}</td>
                    <td>{{ $weight->startWeight }}</td>
                    <td>{{ $weight->endWeight }}</td>
                    <td>{{ $weight->IndividualFeedConsumption }}</td>
                    <td>{{ $weight->IndividualFeedConvertRatio }}</td>
                    </tr>
                  @endforeach  
            </tbody>
    
    </table>
{{$weights->links()}}


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
