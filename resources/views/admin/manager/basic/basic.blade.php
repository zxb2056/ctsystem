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
<div class="row">
                <div class="ml-5 mr-auto">
                    <a class="btn btn-sm btn-outline-primary" title="刷新"><i class="fa fa-refresh"></i><span class="hidden-xs"> 刷新</span></a>
                    <a class="btn btn-sm btn-outline-primary" title="筛选" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i><span class="hidden-xs"> 筛选</span></a>
                    <a class="btn btn-sm btn-outline-primary" title="排序" data-toggle="collapse" data-target=""><i class="fa fa-sort" aria-hidden="true"></i><span class="hidden-xs"> 排序</span></a>
                </div>
                <div class="mr-4">
                    <a class="btn btn-sm btn-outline-primary" title="新增"><i class="fa fa-save"></i><span class="hidden-xs"> 新增</span></a> 
                    <a class="btn btn-sm btn-outline-primary" title="新增"><i class="fa fa-upload" aria-hidden="true"></i><span class="hidden-xs"> 导入</span></a> 
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          导出
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#"><small>全部</small></a>
                          <a class="dropdown-item" href="#"><small>当前页</small></a>
                          <a class="dropdown-item" href="#"><small>选择的行</small></a>
                                              
                        </div>
                      </div>
                      
                  
                </div>
            </div>
            <div class="row collapse" id="filter">
                <div class="row w-100">
                    
                        <div class="col-md-3">
                                <label for="inputId">Id</label>
                                <input type="text" class="form-control" id="inputId">
                                <label for="inputNum">牛号</label>
                                <input type="text" class="form-control" id="inputNum">
                            </div>
                            <div class="col-md-3">
                                <label for="inputPz">品种</label>
                                <input type="text" class="form-control" id="inputPz">
                                <label for="inputBirth">出生日期</label>
                                <input type="text" class="form-control" id="inputBirth">
                            </div>
                            <div class="col-md-3">
                                <label for="inputTci">胎次</label>
                                <input type="text" class="form-control" id="inputTci">
                                <label for="inputNshe">牛舍</label>
                                <input type="text" class="form-control" id="inputNshe">
                            </div>
                            <div class="col-md-3">
                                <label for="inputRuchang">入场类型</label>
                                <input type="text" class="form-control" id="inputRuchang">
                                <label for="inputSire">父亲号</label>
                                <input type="text" class="form-control" id="inputSire">
                            </div>
                        
                </div>
                
                    <div class="my-3">
                            <button type="submit" class="btn btn-outline-info btn-sm" >查询</button> 
                            <button type="reset" class="btn btn-outline-secondary btn-sm" >重置</button> 
                            <button type="reset" class="btn btn-outline-secondary btn-sm" >显示所有</button>
                            <button type="reset" class="btn btn-outline-secondary btn-sm" >只在群</button>
                    </div>
                
            </div>
            <div class="card rounded-0 my-3">
                <div class="card-header">
                        <strong>牛只信息表</strong>

                        <span class="ml-4 mr-2">每页显示</span><select class="input-sm grid-per-pager" name="per-page">
                                <option value="http://test.com/admin/cattleinfos?per_page=10" >10</option>
                    <option value="20" selected>20</option>
                    <option value="30" >30</option>
                    <option value="50" >50</option>
                    <option value="100" >100</option>
                            </select><span class="ml-2">条</span>
                    
                </div>
                <div class="card-body table-responsive">

                <table class="table table-hover">
                  <thead>
                    <tr>
                    <td width="30">id</td>
                    <td>牛号</td>
                    <td>性别</td>
                    <td>品种</td>
                    <td>出生日期</td>
                    <td>生长阶段</td>
                    <td>初生重</td>
                    <td>胎次</td>
                    <td >牛舍</td>
                    <td >牛舍负责人</td>
                    <td >负责兽医</td>
                    <td >入场类型</td>
                    <td >父亲号</td>
                    <td >母亲号</td>
                    <td >入场体重</td>
                    <td >在群状态</td>
                    <td >备注</td>
                    <td >created_at</td>
                    <td>Updated_at</td>
                    <td>操作</td>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><a href="/individual/186601.html">1806601</a></td>
                      <td>母</td>
                      <td>安格斯</td>
                      <td>2017-12-03</td>
                      <td>育肥</td>
                      <td>42</td>
                      <td>0</td>
                      <td>6</td>
                      <td>张三</td>
                      <td>李四</td>
                      <td>自繁</td>
                      <td><a href="/sire/41109231.html">41109231</a></td>
                      <td>18567</td>
                      <td>236</td>
                      <td>是</td>
                      <td></td>
                      <td>2019-01-11 03:16:50</td>
                      <td>2019-01-19 05:04:29</td>
                      <td><button type="button" class="btn btn-sm btn-outline-info p-0">编辑</button> </td>
                      

                    </tr>
                    <tr>
                            <td>2</td>
                            <td><a href="/individual/186602.html">1806602</a></td>
                            <td>公</td>
                            <td>西杂牛</td>
                            <td>2019-2-6</td>
                            <td>犊牛</td>
                            <td>35</td>
                            <td>2</td>
                            <td>2</td>
                            <td>张三</td>
                            <td>李四</td>
                            <td>外购</td>
                            <td><a href="/sire/11013842.html">11013842</a></td>
                            <td>1652</td>
                            <td>301</td>
                            <td>是</td>
                            <td></td>
                            <td>2019-01-23</td>
                            <td>2019-01-19 05:04:29</td>
                            <td><button type="button" class="btn btn-sm btn-outline-info p-0">编辑</button>  </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><a href="/individual/186603.html">1806603</a></td>
                        <td>母</td>
                        <td>安格斯</td>
                        <td>2019-2-6</td>
                        <td>犊牛</td>
                        <td>35</td>
                        <td>2</td>
                        <td>2</td>
                        <td>张三</td>
                        <td>李四</td>
                        <td>外购</td>
                        <td><a href="/sire/11013842.html">11013842</a></td>
                        <td>1652</td>
                        <td>301</td>
                        <td>是</td>
                        <td></td>
                        <td>2019-01-23</td>
                        <td>2019-01-19 05:04:29</td>
                        <td> <button type="button" class="btn btn-sm btn-outline-info p-0">编辑</button> </td>
                    </tr>
                  </tbody>
            
                </table>
                  </div>
                  <div class="card-footer">
                        <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                      <span aria-hidden="true">&laquo;</span>
                                    </a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                      <span aria-hidden="true">&raquo;</span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
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
