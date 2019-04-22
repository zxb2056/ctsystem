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
                    <div class="mr-auto"><strong>药品库存</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>筛选：</span>
                                <span class="mx-1">药品名称：</span>
                                <input type="text" name="feedname"> 
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
                            <th>剩余数量</th>
                            <th>计量单位</th>
                            <th>前1天用量</th>
                            <th>前7天平均用量</th>
                            <th style="color:red;">剩余天数</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>头孢噻呋</td>
                            <td>山东齐鲁药业</td>
                            <td>280</td>
                            <td>kg</td>
                            <td>30</td>
                            <td>15</td>
                            <td>20</td>
                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>过氧乙酸</td>
                            <td>郑州卫民药业</td>
                            <td>280</td>
                            <td>kg</td>
                            <td>30</td>
                            <td>15</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>口蹄疫苗</td>
                            <td>内蒙古金宇保灵</td>
                            <td>280</td>
                            <td>ml</td>
                            <td>0</td>
                            <td>0</td>
                            <td>--</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>检测卡</td>
                            <td>美国希杰</td>
                            <td>280</td>
                            <td>ml</td>
                            <td>0</td>
                            <td>0</td>
                            <td>--</td>
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
