@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>配种月计划</title>
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
          <a class="nav-link" href="{{ url('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
        </li>
      </ul>
      <ul class="nav nav-tabs bg-light mt-2">
        <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/mateplan')}}">月计划</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/breed/mateplan/yearly')}}">年计划</a>
          </li>
      </ul>
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-2 mt-3">
        <ul class="matePlanList list-unstyled">
          @foreach ($grouped as $k=>$item)
          <li class="year-plan my-2 p-2">
          <a href="#Submenu{{$k}}" data-toggle="collapse" aria-expanded="false" aria-controls="#Submenu{{$k}}" class="dropdown-toggle">{{$k}}年</a>
          <div class="collapse" id="Submenu{{$k}}">
          <ul  class="list-unstyled">
          @foreach($item as $it)
          <li class="month-plan p-2"><a href="/admin/manage/breed/mateplan?year={{$k}}&month={{$it['month']}}" class="text-muted">{{$it['month']}}月</a></li>
          @endforeach
        </ul>
      </div>
          </li>
          @endforeach

      </div>

                
                    <div class="col-sm-10">
                        <div class="tab-content">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header">
                                        <strong>{{$plans->year}}年{{$plans->month}}月计划表</strong>
                                    </div>
                                    <div class="card-body table-responsive">

                                        <table class="table table-hover border">
                                            <thead>
                                                <tr>
                                                    <th>类目</th>
                                                    <th>数值</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>上月配种牛数</th>
                                                    <td>{{$plans->lastMonthMated}}</td>

                                                </tr>
                                                <tr>
                                                    <th>上月定胎牛数</th>
                                                    <td>{{$plans->lastMonthPregCheck}}</td>
                                                </tr>
                                                <tr>
                                                    <th>上月定胎怀孕牛数</th>
                                                    <td>{{$plans->lastMonthPregCattleNum}}</td>
                                                </tr>
                                                <tr>
                                                    <th>上月定胎怀孕率</th>
                                                    <td>{{$plans->lastMonthPregRation}}</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计配种牛头数</th>
                                                    <td>{{$plans->thisMonthMating}}</td>
                                                </tr>
                                                <tr>
                                                    <th>本月需要定胎牛头数</th>
                                                    <td>{{$plans->thisMonthPregCheck}}</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计产犊数</th>
                                                    <td>{{$plans->thisMonthCalv}}</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计冻精使用量</th>
                                                    <td>{{$plans->thisMonthSemenUse}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>本月情期受胎率估测</th>
                                                    <td>60%</td>
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="card-footer">

                                    </div>
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
<script type="text/javascript" src="/js/mateplan.js"></script>
@stop
