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
                    <div class="mr-auto"><strong>离场登记</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>离场历史记录</strong>

                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover border">
                                <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>牛号</th>
                                            <th>离场日期</th>
                                            <th>离场原因</th>
                                            <th>离场去向</th>
                                            <th>执行人</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>281065</td>
                                            <td>2016-5-23</td>
                                            <td>正常出售</td>
                                            <td>屠宰场</td>
                                            <td>张三</td>
                                           
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>281065</td>
                                            <td>2016-5-23</td>
                                            <td>疾病</td>
                                            <td>农户</td>
                                            
                                            <td>王五</td>
                                            
                                            </tr>
                                    </tbody>
                
                          </table>
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
