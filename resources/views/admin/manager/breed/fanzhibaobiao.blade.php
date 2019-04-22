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
                        <div class="mr-auto"><strong>繁殖报表</strong></div>
                        
                    
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex">
                   <div>繁殖月报表</div> 
                   <div class="ml-3"><span>选择</span>
                       <select name="年份" id="year">
                           <option value="1">2019</option>
                           <option value="2">2020</option>
                       </select>
                       <span>年</span>
                   </div>
                   <div class="ml-3">
                        <select name="月份" id="year">
                                <option value="1">1月</option>
                                <option value="2">2月</option>
                                <option value="3">3月</option>
                                <option value="4">4月</option>
                                <option value="5">5月</option>
                                <option value="6">6月</option>
                                <option value="7">7月</option>
                                <option value="8">8月</option>
                                <option value="9">9月</option>
                                <option value="10">10月</option>
                                <option value="11">11月</option>
                                <option value="12">12月</option>
                            </select>
                            
                   </div>
                </div>
                    <table class="table table-hover border">
                            <thead>
                                    <tr>
                                        <th>项目</th>
                                        <th>数据</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>参配母牛数</th>
                                        <td>50</td>
                                       
                                        
                                    </tr>
                                    <tr>
                                            <th>总配种次数</th>
                                            <td>80</td>
                                           
                                    </tr>
                                    <tr>
                                            <th>使用冻精数</th>
                                            <td>90</td>
                                            
                                    </tr>
                                    <tr>
                                        <th>孕检牛头数</th>
                                        <td>30</td>
                                    </tr>
                                  <tr>
                                      <th>定胎头数</th>
                                      <td>20</td>
                                  </tr>
                                  <tr>
                                      <th>受胎率</th>
                                      <td>50%</td>
                                  </tr>
                                  <tr>
                                      <th>情期受胎率</th>
                                      <td>45%</td>
                                  </tr>
                                  <tr>
                                      <th>产犊数</th>
                                      <td>15</td>
                                  </tr>
                                  <tr>
                                      <th>公犊数</th>
                                      <td>8</td>
                                  </tr>
                                  <tr>
                                      <th>母犊数</th>
                                      <td>10</td>
                                  </tr>
                                  <tr>
                                      <th>流产头数</th>
                                      <td>2</td>
                                  </tr>
                                  <tr>
                                      <th>不正产头数</th>
                                      <td>3</td>
                                      
                                  </tr>
                                  <tr>
                                      <th>胎衣不下牛数</th>
                                      <td>5</td>
                                  </tr>
                                </tbody>
            
                      </table>
                      <div class="d-flex">
                            <div>繁殖年报表</div> 
                            <div class="ml-3"><span>选择</span>
                                <select name="年份" id="year">
                                    <option value="1">2019</option>
                                    <option value="2">2020</option>
                                </select>
                                <span>年</span>
                            </div>
                           
                         </div>
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>项目</th>
                            <th>指标值</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>年情期受胎率</th>
                            <td>50%</td>
                        </tr>
                        <tr>
                            <th>年一次受胎率</th>
                            <td>60%</td>
                        </tr>
                        <tr>
                            <th>年总受胎率</th>
                            <td>85%</td>
                        </tr>
                        <tr>
                            <th>年分娩率</th>
                            <td>82%</td>
                        </tr>
                        <tr>
                            <th>不正产率</th>
                            <td>8%</td>
                        </tr>
                        <tr>
                            <th>流产率</th>
                            <td>6%</td>
                        </tr>
                        <tr>
                            <th>年空怀率</th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>平均胎间距</th>
                            <td>400天</td>
                        </tr>
                      <tr>
                          <th>犊牛死亡率</th>
                          <td>8%</td>
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
