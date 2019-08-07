@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>繁殖年报表</title>
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
            <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
          </li>
        <li class="nav-item">
          <a class="nav-link  active" href="{{ url('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
        </li>
      </ul>
      <ul class="nav nav-tabs bg-light mt-2">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/breed/matereport/month')}}">月报表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/matereport/yearly')}}">年报表</a>
          </li>
      </ul>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-2 mt-3">
            <ul class="matePlanList list-unstyled">
                @if($grouped->isEmpty())
                <li class="year-plan my-2 p-2">
                        <a href="#" >没有报告信息</a>
                </li>
                @else
              @foreach ($grouped as $k=>$item)
              <li class="year-plan my-2 p-2">
              <a href="/admin/manage/breed/matereport/yearly?year={{$k}}">{{$k}}年</a>
              </li>
              @endforeach
              @endif
          </div>
                        <div class="col-sm-10">
                            <div class="tab-content">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header d-flex">
                                    <div class="mr-auto"><strong>{{$reports->year}}&nbsp繁殖报表</strong></div>
                                    </div>
                                    <div class="card-body table-responsive">
                              <table class="table table-hover border">
                                    <thead>
                                            <tr>
                                                <th width=200px>项目</th>
                                                <th>指标值</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>牛群平均空怀天数</th>
                                            <td>{{$reports->DO}}</td>
                                            </tr>
                                            <tr>
                                                <th>年情期受胎率</th>
                                                <td>{{round($reports->yearlyEstrusConceptionRate,4)}}</td>
                                            </tr>
                                            <tr>
                                                <th>年一次受胎率</th>
                                                <td>{{$reports->yearlyOnceConception}}</td>
                                            </tr>
                                            <tr>
                                                <th>年总受胎率</th>
                                                <td>{{$reports->totalConceptionRate}}</td>
                                            </tr>
                                            <tr>
                                                <th>年分娩率</th>
                                                <td>{{$reports->totalCalvRate}}</td>
                                            </tr>
                                            <tr>
                                                <th>不正产率</th>
                                            <td>{{ $reports->notNormalCalvRate }}</td>
                                            </tr>
                                            <tr>
                                                <th>流产率</th>
                                            <td>{{$reports->abortionRate}}</td>
                                            </tr>
                                            <tr>
                                                <th>青年牛首配日龄</th>
                                            <td>{{$reports->youngfirstMateAge}}</td>
                                            </tr>
                                            <tr>
                                                <th>平均胎间距</th>
                                                <td>{{$reports->AveSpace }}</td>
                                            </tr>
                                          <tr>
                                              <th>犊牛死亡率</th>
                                              <td>{{$reports->deathCalfRate}}</td>
                                          </tr>
                                        </tbody>
                              </table>
                                      </div>
                                  
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

@stop
