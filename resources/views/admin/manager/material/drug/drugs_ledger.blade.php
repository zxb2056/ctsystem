@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>药品入库台帐</title>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository/plus')}}">药品信息登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/input')}}">药品入库登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/output')}}">药品出库登记</a>
        </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        药品台帐
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('/admin/manage/material/drugs/ledger/store')}}"><small>入库明细</small></a>
                <a class="dropdown-item" href="{{url('/admin/manage/material/drugs/ledger/output')}}"><small>出库明细</small></a>          
                </div>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/remain')}}">药品库存</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository')}}">药品名录</a>
        </li>
    </ul>
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>药品入库台账</strong></div>
                </div>
                <form action="/admin/manage/material/drugs/ledger/store" method="get">
                <div class="card-header row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                    <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">每页显示</label>
                                    <div class="col-md-9">
                                        <select name="showitem" id="showitem" class="form-control form-control-sm">
                                            <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                                            <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                            <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                            <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                        </select>
                                    </div>
                                    </div>  
                                </div>      
                        <div class="col-md-3">
                            <div class="form-group row ">
                                <label for="drug_name" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">药品名称</label>
                                <div class="col-md-9 input-group">
                                <input type="text" name="drug_name" id="drug_name" class="form-control form-control-sm" value="{{$datas['drug_name']}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group row ">
                                    <label for="company_name" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">公司名称</label>
                                    <div class="col-md-9 input-group">
                                    <input type="text" name="company_name" id="company_name" class="form-control form-control-sm" value="{{$datas['company_name']}}">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                            <div class="form-group row ">
                                <label for="stored_day_require" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">入库日期</label>
                                <div class="col-md-9 input-group">
                                    <div class="input-group-prepend-sm">
                                        <select name="stored_day_require" id="stored_day_require" class="custom-select-sm">
                                            <option value=">" @if(!$datas || $datas[ 'stored_day_require' ]=='>') selected @endif>></option>
                                            <option value=">=" @if($datas[ 'stored_day_require' ]=='>=') selected @endif >>=</option>
                                            <option value="=" @if($datas[ 'stored_day_require' ]=='=') selected @endif>=</option>
                                            <option value="<" @if($datas[ 'stored_day_require' ]=='<') selected @endif><</option> 
                                            <option value="<=" @if($datas[ 'stored_day_require' ]=='<=') selected @endif><=</option>
                                        </select> 
                                    </div> 
                                    <input type="date" name="storedDay" id="storedDay" class="form-control form-control-sm" value="{{ $datas['storedDay'] }}">
                                     </div>
                                </div>
                        </div>
                                <div class="col-md-3">
                                         <button type="submit" class="btn btn-sm btn-outline-primary">查询</button>
                                </div>
                            </form>
                        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>药品名称</th>
                            <th>供货单位</th>
                            <th>入库日期</th>
                            <th>批次</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>价格</th>
                            <th>生产日期</th>
                            <th>保质期</th>
                            <th>过期日期</th>
                            <th>负责人</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($store_history as $store)
                        <tr>
                            <td>{{ (($store_history->currentPage()-1)*$store_history->perPage()) + $loop->iteration }}</td>
                            <td>{{$store->linkdrug->drugName}}</td>
                            <td>{{$store->linkdrug->supplier}}</td>
                            <td>{{$store->storedDay}}</td>
                            <td>{{$store->batch_order}}</td>
                            <td>{{$store->amount}}</td>
                            <td>{{$store->unit}}</td>
                            <td>{{$store->price}}</td>
                            <td>{{$store->date_of_manufacture}}</td>
                            <td>{{$store->retention_period}}</td>
                            <td>{{$store->expire_date}}</td>
                            <td>{{$store->PIC}}</td>
                        </tr>
                        @endforeach
                    </tbody>

          </table>

                    </div>
            <div class="card-footer w-100">
                {{$store_history->appends($datas)->links()}}
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
