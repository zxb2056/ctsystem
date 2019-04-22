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
                    <div class="mr-auto"><strong>饲料库存</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>筛选：</span>
                                <span class="mx-1">饲料名称：</span>
                                <input type="text" name="feedname"> 
                                <a href="#" class="btn btn-sm btn-outline-success ml-3">查询</a>
                            </div> 
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>饲料名称</th>
                            <th>供货单位</th>
                            <th>剩余数量</th>
                            <th>前1天用量</th>
                            <th>前7天平均用量</th>
                            <th style="color:red;">剩余天数</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>371E</td>
                            <td>河南东方正大有限公司</td>
                            <td>28000</td>
                            <td>300kg</td>
                            <td>306</td>
                            <td>15</td>
                            
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>582</td>
                            <td>河南东方正大有限公司</td>
                            <td>28000</td>
                            <td>300kg</td>
                            <td>306</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>霉立净</td>
                            <td>德国明威药业</td>
                            <td>28000</td>
                            <td>300kg</td>
                            <td>306</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>盐</td>
                            <td>平顶山深井盐</td>
                            <td>28000</td>
                            <td>300kg</td>
                            <td>306</td>
                            <td>15</td>
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
