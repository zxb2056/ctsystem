@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>配种计划</title>
<style>
.matePlanList{
    background-color:#CCCC99;
    max-height:600px;
  }
  .year-plan{
  border-bottom: 1px solid #777777;
  padding: 3px;
  width:100%;
}
.year-plan a{
  color:black;
}
.year-plan a:visited{
  font-size: 14px;
  color:black;
}
.year-plan a:hover{ 
text-decoration: none; 
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
                <a class="nav-link" href="{{url('/admin/manage/breed/mateInput')}}" >配种</a>
              </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/aftercare')}}">产后护理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/waitmate')}}">待配母牛表</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/fanzhidisease')}}">繁殖病症诊疗卡</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
        </li>
      </ul>
      <ul class="nav nav-tabs bg-light mt-2">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">月计划</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/mateplan/yearly')}}">年计划</a>
          </li>
      </ul>

<div class="container-fluid">
          <div class="col-md-3 border my-4">

            <h5>暂时没有配种计划数据。</h5>
          </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
