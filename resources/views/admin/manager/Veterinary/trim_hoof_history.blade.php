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
                        <div class="mr-auto"><strong>修蹄记录</strong></div>
                     
                    
                </div>
                <div class="card-body table-responsive">
                     

                    <div class="mt-4"><h5>修蹄历史</h5></div>
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>牛号</th>
                            <th>修蹄日期</th>
                            <th>修蹄数量</th>
                            <th>何种蹄病</th>
                            <th>症状描述</th>
                            <th>用药方案</th>
                            <th>治疗结果</th>
                            <th>责任兽医</th>
                            <th>更新</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>左前蹄，右后蹄</td>
                            <td>腐蹄</td>
                            <td>严重跛行，流血，肿胀</td>
                            <td>鱼石脂，硫酸铜</td>
                            <td>7天后去除绷带，基本恢复正常</td>
                            <td>李三</td>
                            <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="1" data-target="#diseaseModal">编辑</button></td>
                        </tr>
                        <tr>
                                <td>2</td>
                                <td>281065</td>
                                <td>2016-5-23</td>
                                <td>左前蹄，右后蹄</td>
                                <td>腐蹄</td>
                                <td>严重跛行，流血，肿胀</td>
                                <td>鱼石脂，硫酸铜</td>
                                <td>7天后去除绷带，基本恢复正常</td>
                                <td>李三</td>
                                <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="2" data-target="#diseaseModal">编辑</button></td>

                            </tr>
                            <tr>
                                    <td>3</td>
                                    <td>281065</td>
                                    <td>2016-5-23</td>
                                    <td>左前蹄，右后蹄</td>
                                    <td>腐蹄</td>
                                    <td>严重跛行，流血，肿胀</td>
                                    <td>鱼石脂，硫酸铜</td>
                                    <td>7天后去除绷带，基本恢复正常</td>
                                    <td>李三</td>
                                    <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="3" data-target="#diseaseModal">编辑</button></td>
        
                                    </tr>
                                    <tr>
                                            <td>4</td>
                                            <td>281065</td>
                                            <td>2016-5-23</td>
                                            <td>左前蹄，右后蹄</td>
                                            <td>腐蹄</td>
                                            <td>严重跛行，流血，肿胀</td>
                                            <td>鱼石脂，硫酸铜</td>
                                            <td>7天后去除绷带，基本恢复正常</td>
                                            <td>李三</td>
                                            <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="4" data-target="#diseaseModal">编辑</button></td>
                
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
