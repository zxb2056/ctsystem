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
    <a class="nav-link  active" href="{{url('/admin/manage/basic/barnmapindividual')}}">配置牛舍</a>
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
      <a class="nav-link dropdown-toggle" href="{{url('/admin/manage/basic/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
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
</ul>
          <div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <h5><span><strong>配置牛舍牛只情况</strong></h5>

                </div>
                <div class="card-body form-row">
                <div class=" form-group col-md-2">
                <label for="inputEmail4">选择牛舍</label>
                <select name="barn" id="selectbarn" placeholder="选择牛舍" class="form-control">
                @foreach($barns as $barn)
                <option value="{{$barn->id}}">@if($barn->id == '1') {{$barn->barnName}} @else {{$barn->barnID}} @endif </option>
                @endforeach
                </select>

                </div>
                <div class="form-group col-md-2">
                <label for="cattleID">选择牛只</label>
                <select name="cattleID" id="cattleID" placeholder="选择牛只" class="form-control" multiple="multiple" size="10">
                @foreach($allCattles as $cattle)
                <option value="{{$cattle->id}}">{{$cattle->cattleID}}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group col-md-1">
                <label for="submit">submit</label>
                <input type="submit" class="btn btn-outline-primary form-control" id="submit" value="提交">
                </div>
                  </div>
                  <div class="card-footer">
                    说明：可以按ctrl或shift进行多选。
                  </div>
                  </div>
                 
            </div>
            </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/barnmap.js"></script>
@stop
