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
                        <div class="mr-auto"><strong>检疫记录</strong></div>
                       
                    
                </div>
                <div class="card-body table-responsive">
                    <div class="mb-3">

                    
                        <div class="mt-4"><h5>检疫历史</h5></div>
                        <div><span>筛选</span><span class="ml-4">按日期</span><input type="text" name="date"><span class="ml-3">疫病类型</span><input type="text" name="type"><span class="ml-3">送检地点</span><input type="text" name="address">
                            <a class="btn btn-sm btn-outline-success ml-4">提交</a>
                        </div>
                    </div>
                        <table class="table table-hover border">
                              <thead>
                                      <tr>
                                          <th>序号</th>
                                          <th>牛号</th>
                                          <th>检疫日期</th>
                                          <th>检疫类型</th>
                                          <th>检疫方式</th>
                                          <th>检疫地点</th>
                                          <th>检疫结果</th>
                                          <th>责任人</th>
                                          
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>1</td>
                                          <td>281065</td>
                                          <td>2016-5-23</td>
                                          <td>口蹄疫</td>
                                          <td>血检</td>
                                          <td>河南DHI</td>
                                          <td>阴性</td>
                                          <td>张三</td>
                                      </tr>
                                      <tr>
                                            <td>1</td>
                                            <td>281065</td>
                                            <td>2016-5-23</td>
                                            <td>口蹄疫</td>
                                            <td>血检</td>
                                            <td>西北农林科技大学</td>
                                            <td>阴性</td>
                                            <td>张三</td>
              
                                          </tr>
                                          <tr>
                                                <td>1</td>
                                                <td>281065</td>
                                                <td>2016-5-23</td>
                                                <td>口蹄疫</td>
                                                <td>血检</td>
                                                <td>西北农林科技大学</td>
                                                <td>阴性</td>
                                                <td>张三</td>
                      
                                                  </tr>
                                                  <tr>
                                                        <td>1</td>
                                                        <td>281065</td>
                                                        <td>2016-5-23</td>
                                                        <td>口蹄疫</td>
                                                        <td>血检</td>
                                                        <td>西北农林科技大学</td>
                                                        <td>阴性</td>
                                                        <td>张三</td>
                                                          </tr>
                                  </tbody>
              
                        </table>
       
            
               
                  </div>
              
                  </div>
            
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
