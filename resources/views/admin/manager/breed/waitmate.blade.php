@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>待配母牛</title>
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
          <a class="nav-link  active" href="{{url('/admin/manage/breed/waitmate')}}">待配母牛表</a>
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
          <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
        </li>
      </ul>
<div class="card rounded-0 my-3">
                <div class="card-header">
                        <strong>待配母牛表</strong>
                </div>
                <div class="card-body table-responsive">

          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>母牛号</th>
                            <th>出生日期</th>
                            <th>月龄</th>
                            <th>日龄</th>
                            <th>最近配种日期</th>
                            <th>上次产犊日期</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($waitmates as $waitmate)
                        <tr>
                        <td>{{(($waitmates->currentPage()-1)*$waitmates->perPage())+$loop->iteration}}</td>
                            <td>{{$waitmate->cattleID}}</td>
                            <td>{{$waitmate->birthday}}</td>
                        <td>@php
                          // echo date_default_timezone_get();
                          $now=date('Y-m-d');
                          $start  = date_create($waitmate->birthday);
                          $end 	= date_create(); // Current time and date
                          $diff  	= date_diff( $start, $end );
                          echo  $diff->y . ' 岁 ';  
                          echo  $diff->m . ' 月龄';       
                        @endphp
                        </td>
                        <td>@php
                            echo $diff->format("%a");
                        @endphp</td>
                        <td> @if(!$waitmate->linkmaterecord->isEmpty())
                            {{$waitmate->linkmaterecord->last()->mateDate}}
                        @endif</td>
                            <td>
                             @if(!$waitmate->linkcalv->isEmpty())
                                  {{$waitmate->linkcalv->last()->calvDate}}
                              @endif
                           
                             </td>
                        </tr>
                      @endforeach
                    </tbody>

          </table>
            
               
                  </div>
                  <div class="card-footer d-flex justify-content-center">
                      {{$waitmates->links()}}
                    </div>
                  <div class="card-footer">
                    说明：待配母牛是指月龄13月龄(400天)以上，产后40天以上尚未配种的母牛。
                  </div>
                  </div>
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
