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
                        <strong>牛舍信息表</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <table class="table table-hover">
                  <thead>
                    <tr>
                    <td width="50px">id</td>
                    <td>牛舍号</td>
                    <td>牛舍名</td>
                    <td>说明</td>
                    <td>责任兽医</td>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>1</td>
                      <td>母子舍</td>
                      <td>产后牛+犊牛</td>
                      <td>张三</td>

                    </tr>
                    <tr>
                            <td>2</td>
                            <td>2</td>
                            <td>围产舍</td>
                            <td>产前前后15天牛</td>
                            <td>李四</td>
                    </tr>
                    <tr>
                            <td>3</td>
                            <td>3</td>
                            <td>断奶犊牛舍</td>
                            <td>断奶前犊牛</td>
                            <td>王五</td>
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


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
