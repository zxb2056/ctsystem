@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>牛舍信息</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <a class="nav-link" href="{{url('/admin/manage/basic/cattleinfo')}}">牛只基本信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/barninfo')}}">牛舍信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/barnmapindividual')}}">配置牛舍</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/sireinfos')}}">公牛信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
    </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-eliminate')}}">牛只淘汰</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-sale-common')}}">牛只出栏</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/manage/basic/breed_code')}}">品种代码</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="#">公牛查询结果</a>
  </li>
</ul>
<div class="card rounded-0 my-3">
  <div class="card-header mb-1">
    查询公牛库
  </div>

  <div class="card-body my-2 row">
    <div class="col-md-12">
      <p>目前，本系统公牛数据库里保存有国内各大公牛站公牛信息100条。作为选配，计算近交之用。后续更新。</p>
      <p>这个页面用于查询各大公牛站的信息</p>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>序号</th>
          <th>注册号</th>
          <th>冻精号</th>
          <th>品种</th>
          <th>国家</th>
          <th>公司</th>
          <th>出生日期</th>
          <th>出生重</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sireinfos as $sire)
        <tr>
          <td>{{(($sireinfos->currentPage()-1)*$sireinfos->perPage())+$loop->iteration}}</td>
        <td><a href="javascript:;" onclick='window.open("/admin/manage/basic/sire/siredetail/{{$sire->id}}","_blank","status");return false'>{{$sire->sireRegi}}</a></td>
          <td><a href="">{{$sire->semenNum}}</a></td>
          <td>{{$sire->breedType}}</td>
          <td>{{$sire->nation->nationName}}</td>
          <td>{{$sire->belongToCompany}}</td>
          <td>{{$sire->birthDay}}</td>
          <td>{{$sire->BW}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-center">
    {{$sireinfos->appends($datas)->links()}}
  </div>


</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/barnmap.js"></script>
@stop