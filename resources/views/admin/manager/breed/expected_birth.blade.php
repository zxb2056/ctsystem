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
                <div class="card-header d-flex">
                       <strong>预产期明细表</strong>
                </div>
                <div class="card-body table-responsive">

          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>母牛号</th>
                            <th>预产日期</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                           
                            </tr>
                    </tbody>

          </table>
            <div class="card-footer">
                说明：预产期按283天计算，前后15天都正常范围。
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
