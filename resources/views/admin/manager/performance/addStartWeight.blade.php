@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>育肥性状测定</title>
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
    <li class="breadcrumb-item active" aria-current="page">完善个体实验组信息</li>
  </ol>
</nav>
@if($hasweightNumbers!=0)
<div class="alert alert-success" role="alert">
目前数据库中已经有{{$hasweightNumbers}}头牛的数据，实验组设定{{$setNumbers}}头牛，还有<?php echo $current=$setNumbers-$hasweightNumbers; ?>头牛体重数据要完善。
</div>
@else
<div class="alert alert-danger" role="alert">
提示: 系统检测到该实验组还没有牛只初始体重,请在此页完善后再进行下一步操作。
</div>
@endif
<div class="fluid-container">

    <div class="row my-4">
        <div class="col-md-6 ">
        <form action='{{url("/admin/manage/performance/feed_conversion/plusStartWeight/{$id}")}}' method="post">
        {{csrf_field()}}
        <div class="form-group form-row">
                            <label for="cattleID" class="col-sm-3 col-form-label">牛耳号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cattleID" name="cattleID" value="{{old('cattleID')}}" required>
                            </div>
        </div>
        <div class="form-group form-row">
                            <label for="startWeight" class="col-sm-3 col-form-label">牛体重</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="startWeight" name="startWeight" >
                            </div>
        </div>
        <div class="text-right">
                                @if(count($errors) >0)
                                <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                                </div>
                                @endif
                          <button type="submit" class="btn btn-primary">保存</button>
        </div>
</form>
        </div>
        <div class="col-md-6 ">
            <p >体重数据也可以通过excel导入，点击此处<a href="{{asset('/file/start_weight.xlsx')}}">下载模板</a>，根据模板格式上传数据，excel单元格格式全部设为文本。</p>
            <br>
            <form action="{{url('/admin/manage/performance/feed_conversion/importStartWeight')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <p class="text-center border-bottom">
             <input type="hidden" name="id" value="{{$id}}">   
            <input type="file"  id="cstartWeightexcel" name="cstartWeightexcel" required>
            <button type="submit" class="btn btn-sm btn-outline-primary">导入</button>
            </p>
</form>
            @if(!empty(session('warn')))
        　　<div class="alert alert-warning" role="alert">
        　　　　<strong>{{session('warn')}}</strong>
        　　</div>
            @endif
        </div>

    </div>
     
</div>

<table class="table table-hover table-sm border mt-5">
            <thead>
                        <tr>
                            <th>序号</th>
                            <th>牛号</th>
                            <th>初始体重</th>
                        </tr>
            </thead>
            <tbody>
                    @foreach($weights as $weight)
                    <tr>
                    <td>{{ (($weights->currentPage() - 1 ) * $weights->perPage() ) + $loop->iteration}}</td>
                    <td>{{$weight->cattleID}}</td>
                    <td>{{$weight->startWeight}}</td>


                    
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
