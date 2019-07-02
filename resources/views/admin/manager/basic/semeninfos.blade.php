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
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
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
    <a class="nav-link" href="{{ url('/admin/manage/basic/breed_code') }}">品种代码</a>
  </li>
</ul>
<div class="card rounded-0 my-3">
    <div class="card-header d-flex">
        <div class="mr-auto"><strong>冻精库存</strong></div>
    </div>
    <div class="card-header">
        <form action="" method="get">
                <div class="form-row align-items-center">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">每页显示</div>
                                  </div>
                                  <select name="showitem" id="showitem" class="form-control">
                                    <option value="10" @if($datas['showitem'] == '10') selected @endif>10条</option>
                                    <option value="20" @if($datas['showitem'] == '20') selected @endif>20条</option>
                                    <option value="30" @if($datas['showitem'] == '30') selected @endif>30条</option>
                                    <option value="50" @if($datas['showitem'] == '50') selected @endif>50条</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-auto">
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">冻精号</div>
                                  </div>
                                <input type="text" class="form-control" id="semenNum" name="semenNum" value="{{$datas['semenNum']}}">
                                </div>
                        </div>
                       
                        <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-2">查询</button>
                        </div>
                </div>                                 
        </form>
    </div>

            <div class="card-body table-responsive">                
<table class="table table-hover border">
    <thead>
            <tr>
                <th>序号</th>
                <th>冻精号</th>
                <th>公司</th>
                <th>冻精类型</th>
                <th>品种</th>                                                         
            </tr>
        </thead>
        <tbody>
          @foreach($semens as $semen)
            <tr>
            <td>{{(($semens->currentPage()-1)*$semens->perPage())+$loop->iteration}}</td>
            <td>{{$semen->semenNum}}</td>
            <td>{{$semen->company}}</td>
            <td>{{$semen->frozenType}}</td>
            <td>{{$semen->linkbreed->name}}</td>
             </tr>
           @endforeach
          
        </tbody>

</table>
        </div>
<div class="card-footer d-flex justify-content-center">
{{$semens->appends($datas)->links()}}
</div>
<div class="card-footer">
  <p>说明：冻精号null，用于匹配没有冻精号的情况。</p>
</div>
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
