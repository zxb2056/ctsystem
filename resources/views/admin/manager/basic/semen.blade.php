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
                                                        <span class="h4">场内冻精列表</span>
                                                        <form class="form-inline my-2 my-lg-0 ml-5">
                                                                <input class="form-control mr-sm-2" type="search" placeholder="输入冻精号" aria-label="Search">
                                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">查询</button>
                                                        </form>
                                                    </div>
                                                    <div class="card-body table-responsive">
                                    
                                                        <table class="table table-hover border">
                                                            <thead>
                                                                <tr>
                                                                    <td>序号</td>
                                                                    <td>冻精号</td>
                                                                    <td>提供厂家</td>
                                                                    
                        
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td><a href="#">41109231</a></td>
                                                                    <td>河南省鼎元种牛育种有限公司</td>
                                                                                                                                  
                                                                </tr>
                                                                <tr>
                                                                        <td>2</td>
                                                                        <td><a href="#">41109235</a></td>
                                                                        <td>美国环球种畜</td>
                                                                                                                                      
                                                                    </tr>
                                                               
                                    
                                                            </tbody>
                                    
                                                        </table>
                                    
                                                    </div>
                                                    <div class="card-footer">
                                                       
                                                    </div>
                                                </div>

            </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
