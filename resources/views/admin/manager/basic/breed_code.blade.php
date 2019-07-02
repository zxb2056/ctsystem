@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light mb-4">
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
      <a class="nav-link dropdown-toggle" href="{{url('/admin/manage/basic/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
    </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-eliminate')}}">牛只淘汰</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-sale-common')}}">牛只出栏</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ url('/admin/manage/basic/breed_code') }}">品种代码</a>
  </li>
</ul>


            <div class="card rounded-0 my-3">
            <form action="{{ url('/admin/manage/basic/breed_code')}}" method="get">
                    <div class="card-header">
                        <div class="form-group row">
                        <label for="showitem" class="col-form-label">每页显示</label>
                           <div class="col-md-2">
                                <select name="showitem" id="showitem" class="form-control" >
                                    <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                                    <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                    <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                    <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button  type="submit" class="btn btn-sm btn-outline-success">提交</button>
                                </div>
                        </div>
                    </div>
                </div> 
             </form> 
                <div class="card-body table-responsive">
                <div class="row">
                <div class="col-md-6 offset-md-3">
                <table class="table table-hover">
                  <thead>
                    <tr>
                    <td >序号</td>
                    <td>品种名称</td>
                    <td>数字代码</td>
    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($varieties as $variety)
                    <tr>
                      <td>{{ (($varieties->currentPage() - 1 ) * $varieties->perPage() ) + $loop->iteration }}</td>
                      <td>{{ $variety->name }}</td>                     
                      <td>{{ $variety->id }}</td>
                    </tr>
                    @endforeach
                  </tbody>
            
                </table>
                </div>
                </div>
                  </div>
                  <div class="card-footer d-flex justify-content-center">
                    {{$varieties->appends($datas)->links()}}
                  </div>
                  </div>
        </div>

    </div>
 
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/cattleinput.js"></script>
@stop
