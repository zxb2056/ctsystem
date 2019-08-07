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
<ul class="nav nav-tabs bg-light">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository/plus')}}">药品信息登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/input')}}">药品入库登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{url('/admin/manage/material/drugs/output')}}">药品出库登记</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/ledger/store')}}">药品台帐</a>
        </li>
        <li class="nav-item">
                <a class="nav-link  active" href="{{url('/admin/manage/material/drugs/remain')}}">药品库存</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository')}}">药品名录</a>
        </li>
</ul>
<div class="card rounded-0 my-3">
            <div class="card-header d-flex">
                    <div class="mr-auto"><strong>药品库存</strong></div>
            </div>
                    <form action="/admin/manage/material/drugs/remain">
                        <div class="card-header form-row">
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
                                            <button type="submit" class="btn btn-sm btn-outline-primary">查询</button>
                                    </div>      
                        </div>
                    </form>  
            <div class="card-body table-responsive">               
                <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>药品名称</th>
                            <th>供货单位</th>
                            <th>剩余数量</th>
                            <th>计量单位</th>
                            <th style="color:red;">剩余天数</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($remains as $remain)
                        <tr>
                            <td>{{ (($remains->currentPage()-1)*$remains->perPage()) + $loop->iteration }}</td>
                            <td><a href="/admin/manage/material/drugs/repo/detail/{{$remain->drug_id}}">{{ $remain->linkdrug->drugName}}</a></td>
                            <td>{{ $remain->linkdrug->supplier}}</td>
                            <td>{{ $remain->remain }}</td>
                            <td>{{ $remain->linkdrug->unit }}</td>
                            <td>20</td>
                        </tr>
                        @endforeach
                       
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                {{$remains->links()}}
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
