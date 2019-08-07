@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>繁殖月报表</title>
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
            <a class="nav-link  active" href="{{url('/admin/manage/breed/matereport/month')}}">月报表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/breed/matereport/yearly')}}">年报表</a>
          </li>
      </ul>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-2 mt-3">
            <ul class="matePlanList list-unstyled">
            @if($grouped->isEmpty())
            <li class="year-plan my-2 p-2">
                    <a href="#" data-toggle="collapse" aria-expanded="false" aria-controls="#" class="dropdown-toggle">没有报告信息</a>
            </li>
            @else
              @foreach ($grouped as $k=>$item)
              <li class="year-plan my-2 p-2">
              <a href="#Submenu{{$k}}" data-toggle="collapse" aria-expanded="false" aria-controls="#Submenu{{$k}}" class="dropdown-toggle">{{$k}}年</a>
              <div class="collapse" id="Submenu{{$k}}">
              <ul  class="list-unstyled">
              @foreach($item as $it)
              <li class="month-plan p-2"><a href="/admin/manage/breed/matereport/month?year={{$k}}&month={{$it['month']}}" class="text-muted">{{$it['month']}}月</a></li>
              @endforeach
            </ul>
          </div>
              </li>
              @endforeach
              @endif
          </div>
    
                    
                        <div class="col-sm-10">
                            <div class="tab-content">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header d-flex">
                                    <div class="mr-auto"><strong>{{$reports->year}}年&nbsp{{$reports->month}}月&nbsp繁殖报表</strong></div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover border">
                                                <thead>
                                                        <tr>
                                                            <th width=200px>项目</th>
                                                            <th>数据</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                    <th>适配母牛数</th>
                                                                    <td>{{$reports->eligibleBreed}}</td>
                                                                </tr>
                                                        <tr>
                                                            <th>参配母牛数</th>
                                                            <td>{{$reports->matedCowNum}}</td> 
                                                        </tr>
                                                        <tr>
                                                                <th>发情检出率/参配率</th>
                                                                <td>{{$reports->HDR}}</td> 
                                                            </tr>
                                                        <tr>
                                                                <th>总配种次数</th>
                                                                <td>
                                                                    {{$reports->totalMateNum}}
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <th>使用冻精数</th>
                                                                <td>{{$reports->semenUseAmount}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>孕检牛头数</th>
                                                            <td>{{$reports->pregCheckNum}}</td>
                                                        </tr>
                                                      <tr>
                                                          <th>确定怀孕头数</th>
                                                          <td>{{$reports->confirmPregNum}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>受胎率</th>
                                                      <td>{{ $reports->lastMonthPregRation }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>情期受胎率</th>
                                                          <td>{{$reports->estrusConceptionRate}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>产犊数</th>
                                                          <td>{{$reports->calvNum}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>公犊数</th>
                                                          <td>{{$reports->MaleCalfNum}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>母犊数</th>
                                                          <td>{{$reports->FemaleCalfNum}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>流产头数</th>
                                                          <td>{{$reports->abortionNum}}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>不正产头数</th>
                                                          <td>{{$reports->nonNormalCalv}}</td>
                                                          
                                                      </tr>
                                                      <tr>
                                                          <th>胎衣不下牛数</th>
                                                          <td>{{$reports->retainedAfterBirthNum}}</td>
                                                      </tr>
                                                    </tbody>
                                
                                          </table>
                                                                           
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
