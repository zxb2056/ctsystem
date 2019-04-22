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
                    <div class="mr-auto"><strong>药品台账</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>筛选：</span>
                                <span class="mx-1">药品名称：</span>
                                <input type="text" name="feedname"> 
                                <span class="mx-1">类型</span>
                                <select name="operType" >
                                    <option value="1">出库</option>
                                    <option value="2">入库</option>
                                </select>
                                <span class="mx-1">日期</span>
                                <input type="date"><span class="mx-1">到</span><input type="date" name="" id="">
                                <a href="#" class="btn btn-sm btn-outline-success ml-3">查询</a>
                            </div> 
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>药品名称</th>
                            <th>供货单位</th>
                            <th>出入库</th>
                            <th>数量</th>
                            <th>日期时间</th>
                            <th>负责人</th>
                            <th>登记人</th>


                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>头孢</td>
                            <td>山东齐鲁药业</td>
                            <td>出库</td>
                            <td>10ml</td>
                            <td>2019-3-5</td>
                            <td>梁</td>
                            <td>张三</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>酒精</td>
                            <td>河北远征药业</td>
                            <td>出库</td>
                            <td>1kg</td>
                            <td>2019-3-5</td>
                            <td>梁</td>
                            <td>张三</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>庆大霉素</td>
                            <td>郑州百瑞药业</td>
                            <td>入库</td>
                            <td>50ml</td>
                            <td>2019-3-5</td>
                            <td>梁</td>
                            <td>张三</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>盐</td>
                            <td>商丘天邦药业</td>
                            <td>出库</td>
                            <td>10kg</td>
                            <td>2019-3-5</td>
                            <td>梁</td>
                            <td>张三</td>
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
