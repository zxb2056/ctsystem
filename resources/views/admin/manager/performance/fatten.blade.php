@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>育肥性状测定</title>
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
    <a class="nav-link" href="{{url('/admin/manage/performance/growth')}}">生长发育性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="{{url('/admin/manage/performance/fatten')}}">育肥性状测定</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/feed_conversion')}}">饲料转化率</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/carcass')}}">胴体性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/meat_quality')}}">肉质性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/report')}}">测定报告</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/query&update')}}">数据库查询修改</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{asset('/file/NYT 2660-2014 肉牛生产性能测定技术规范.pdf')}}">生产性能测定技术规范</a>
  </li>
</ul>
<div class="card rounded-0 my-3">
     ***测定报告是肉牛个体生产报告，以国标的附表2为标准，生成电子表格，并可以打印****          
</div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
