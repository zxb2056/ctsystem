@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>诊疗登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.get_drug_info{
  position: relative;
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
        <li class="nav-item"><a class="nav-link active" href="/admin/manage/Veterinary/diseasing_list">诊疗登记</a></li>
        <li class="nav-item"><a class="nav-link" href="#">防疫登记</a></li>
        <li class="nav-item"><a class="nav-link" href="#">检疫登记</a></li>
        <li class="nav-item"><a class="nav-link" href="#">修蹄登记</a></li>
        <li class="nav-item"><a class="nav-link" href="#">驱虫登记</a></li>
        <li class="nav-item"><a class="nav-link" href="#">消毒登记</a></li>
</ul>
<ul class="nav nav-tabs bg-light my-1">
<li class="nav-item"><a class="nav-link  active" href="/admin/manage/Veterinary/diseasing_list">现有诊疗更新</a></li>
<li class="nav-item"><a class="nav-link" href="/admin/manage/Veterinary/disease_input">新增诊疗记录</a></li>
</ul>
<div class="card">
        <div class="card-header d-flex">
          <h6 class="mr-auto"><strong>现有病牛列表</strong></h6>
            <div>目前共有<span class="text-danger">{{$counts}}</span>头病牛，其中6月龄以下牛只<span class="text-danger">{{$calfs}}</span>头</div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>牛号</th>
                        <th>发病日期</th>
                        <th>疾病名称</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diseasing  as $cattle)
                    <tr>
                        <td>{{ (($diseasing ->currentPage()-1)*$diseasing ->perPage())+ $loop->iteration }}</td>
                        <td><a href="/admin/manage/Veterinary/diseasing/daily_update/{{$cattle->id}}">{{ $cattle->cattleID }}</a></td>
                        <td>{{ $cattle->dateOfOnset }}</td>
                        <td>{{ $cattle->nameOfDisease }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted d-flex justify-content-center">
          {{$diseasing->links()}}
        </div>
      </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')



@stop
