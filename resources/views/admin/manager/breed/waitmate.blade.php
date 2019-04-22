@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')

@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
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
                            <th>上次产犊日期</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>35</td>
                            <td>2017-12-21</td>
                        </tr>
                        <tr>
                            <td>2</td>
                                <td>281065</td>
                                <td>2016-5-23</td>
                                <td>35</td>
                                <td>青年牛</td>
                            </tr>
                    </tbody>

          </table>
            
               
                  </div>
                  <div class="card-footer">
                    说明：待配母牛是指月龄13月龄以上，产后60天以上尚未配种的母牛。
                  </div>
                  </div>
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
