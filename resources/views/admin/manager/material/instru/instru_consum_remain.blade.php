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
                    <div class="mr-auto"><strong>器械耗材库存</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>筛选：</span>
                                <span class="mx-1">器械耗材名称：</span>
                                <input type="text" name="feedname"> 
                                <a href="#" class="btn btn-sm btn-outline-success ml-3">查询</a>
                            </div> 
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>器械耗材名称</th>
                            <th>供货单位</th>
                            <th>总入库量</th>
                            <th>库存数量</th>
                            <th>库外量</th>
                            <th>消耗数量</th>
                           
                                                                                
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>修蹄刀</td>
                            <td>河北正义</td>
                            <td>5</td>
                            <td>2</td>
                            <td>2</td>
                            <td>1</td>
                                                      
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>牛体刷</td>
                            <td>河北威远</td>
                            <td>7</td>
                            <td>1</td>
                            <td>6</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>一次性注射器</td>
                            <td>德国明威药业</td>
                            <td>5000</td>
                            <td>1000</td>
                            <td>100</td>
                            <td>3900</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>推草机</td>
                            <td>内蒙古通辽机械</td>
                            <td>1</td>
                            <td>0</td>
                            <td>1</td>
                            <td>0</td>
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
