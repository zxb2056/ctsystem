@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>冻精台帐</title>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light mb-4">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/semen_input')}}">冻精入库登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/semen_output')}}">冻精出库登记</a>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            冻精台帐
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/admin/manage/material/semen/store_ledger')}}"><small>冻精入库台帐</small></a>
                <a class="dropdown-item" href="{{url('/admin/manage/material/semen/out_ledger')}}"><small>冻精出库台帐</small></a>
                <a class="dropdown-item" href="{{url('/admin/manage/material/semen/broke_ledger')}}"><small>冻精损坏明细</small></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/admin/manage/breed/mate_ledger')}}"><small>配种记录</small></a>
        </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/semen_remain')}}">冻精库存</a>
        </li>
        
      </ul>
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>冻精入库台帐</strong></div>
                </div>
                        <div class="card-header">
                            <form action="" method="get">
                                    <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <div class="input-group mb-2">
                                                      <div class="input-group-prepend">
                                                        <div class="input-group-text">每页显示</div>
                                                      </div>
                                                      <select name="showitem" id="showitem" class="form-control">
                                                        <option value="10" @if($datas['showitem'] == '10') selected @endif>10条</option>
                                                        <option value="20" @if($datas['showitem'] == '20') selected @endif>20条</option>
                                                        <option value="30" @if($datas['showitem'] == '30') selected @endif>30条</option>
                                                        <option value="50" @if($datas['showitem'] == '50') selected @endif>50条</option>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                    <div class="input-group mb-2">
                                                      <div class="input-group-prepend">
                                                        <div class="input-group-text">冻精号</div>
                                                      </div>
                                                      <input type="text" class="form-control" id="semenNum" name="semenNum">
                                                    </div>
                                            </div>
                                            <div class="col-auto">
                                                    <div class="input-group mb-2">
                                                      <div class="input-group-prepend">
                                                        <div class="input-group-text">起始日期</div>
                                                      </div>
                                                      <input type="date" class="form-control" id="startDate" name="startDate" value="{{$datas['startDate']}}">
                                                    </div>
                                            </div>
                                            <div class="col-auto">
                                                    <div class="input-group mb-2">
                                                      <div class="input-group-prepend">
                                                        <div class="input-group-text">截止日期</div>
                                                      </div>
                                                      <input type="date" class="form-control" id="stopDate" name="stopDate" value="{{$datas['stopDate']}}">
                                                    </div>
                                            </div>
                                            <div class="col-auto">
                                                    <button type="submit" class="btn btn-sm btn-outline-primary mb-2">查询</button>
                                            </div>
                                    </div>                                 
                            </form>
                        </div>
        <div class="card-body table-responsive">       
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>冻精号</th>
                            <th>入库日期</th>
                            <th>入库数量</th>
                            <th>单价</th>
                            <th>总金额</th>
                            <th>负责人</th>
                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                        <tr>
                            <td>{{(($stores->currentPage()-1)*$stores->perPage())+$loop->iteration}}</td>
                            <td>{{$store->linksemen->semenNum}}</td>
                            <td>{{$store->storedDay}}</td>
                            <td>{{$store->mount}}</td>
                            <td>{{$store->price}}</td>
                            <td>{{$store->sum}}</td>
                            <td>{{$store->PIC}}</td>
                        </tr>
                       @endforeach 
                    </tbody>

          </table>
          <div class="card-footer d-flex justify-content-center">
            {{$stores->appends($datas)->links()}}
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
