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
                        <div class="mr-auto"><strong>驱虫记录</strong></div>
                     
                    
                </div>
                <div class="card-body table-responsive">
                     

                    <div class="mt-4"><h5>驱虫历史</h5></div>
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>牛号</th>
                            <th>驱虫日期</th>
                            <th>驱虫药品</th>
                            <th>药品厂家</th>
                            <th>用药量</th>
                            <th>操作人员</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>伊维菌素</td>
                            <td>齐鲁药业</td>
                            <td>10ml</td>
                            <td>王五</td>
                        </tr>
                        <tr>
                                <td>2</td>
                                <td>281065</td>
                                <td>2016-5-23</td>
                                <td>伊维菌素</td>
                                <td>齐鲁药业</td>
                                <td>10ml</td>
                                <td>王五</td>

                            </tr>
                            <tr>
                                    <td>3</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>伊维菌素</td>
                            <td>齐鲁药业</td>
                            <td>10ml</td>
                            <td>王五</td>
        
                                    </tr>
                                    <tr>
                                            <td>4</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>伊维菌素</td>
                            <td>齐鲁药业</td>
                            <td>10ml</td>
                            <td>王五</td>
                
                                            </tr>
                    </tbody>

          </table>
            
               
                  </div>
              <div class="card-footer">
                    <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                              <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">前一页</a>
                              </li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item">
                                <a class="page-link" href="#">下一页</a>
                              </li>
                            </ul>
                          </nav>
              </div>
                  </div>
            
        </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
