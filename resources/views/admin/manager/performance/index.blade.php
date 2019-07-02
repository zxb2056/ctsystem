@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>生长发育性能测定</title>
@stop
@section('css')
<style>
label{
text-align:center;
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
    <a class="nav-link active" href="{{url('/admin/manage/performance/growth')}}">生长发育性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/fatten')}}">育肥性状测定</a>
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
<div class="card rounded-0 mt-5">
     <div class="row">
        <div class="col-md-6">
        <form action="/admin/manage/performance/growth/plusRecord" method="post">
     {{csrf_field()}}
        <h5 class="text-center my-3"><strong>生长发育性状信息</strong></h5>
        <div class="form-group form-row">
            <label for="determineDay" class="col-md-3 col-form-label">测定日期</label> 
          <div class="col-md-9">
          <input  type="date" class="form-control" id="determineDay" name="determineDay" value="{{date("Y-m-d")}}" required> 
          </div>
        </div>
        <div class="form-group form-row">
            <label for="cattle_id" class="col-md-3 col-form-label">牛耳号</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="cattle_id" name="cattle_id" value="" required> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="bodyWeight" class="col-md-3 col-form-label">体重(kg)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="bodyWeight" name="bodyWeight" value=""> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="bodyHeight" class="col-md-3 col-form-label">体高(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="bodyHeight" name="bodyHeight" value=""> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="obliqueLength" class="col-md-3 col-form-label">体斜长(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="obliqueLength" name="obliqueLength" value=""> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="chestCircumference" class="col-md-3 col-form-label">胸围(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="chestCircumference" name="chestCircumference" value=""> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="abdominalCircumference" class="col-md-3 col-form-label">腹围(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="abdominalCircumference" name="abdominalCircumference" value=""> 
        </div>
        </div>
        <div class="form-group form-row">
            <label for="cannonBone" class="col-md-3 col-form-label">管围(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="cannonBone" name="cannonBone" value=""> 
        </div>
        </div> 
        <div class="form-group form-row">
            <label for="hipWidth" class="col-md-3 col-form-label">坐骨端宽(cm)</label> 
        <div class="col-md-9">
        <input  type="text" class="form-control" id="hipWidth" name="hipWidth" value=""> 
        </div>
        </div> 
        <div class="form-group  form-row" >
            <div class="col-md-6"></div>
            <div class="col-md-6">
            <input  type="submit" class="btn btn-sm btn-outline-success form-control">
            </div>
        </div>
        </form>
        </div>

     </div>
             <!-- 以上row结束 -->
</div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
