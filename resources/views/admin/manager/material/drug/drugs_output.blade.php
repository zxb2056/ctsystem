@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>药品出库信息</title>
<style>
    #father-div{
        position: relative;
    }
    #drug_info{
        position: absolute;
        z-index:2;
        display: none;
        border: 1px solid sienna;
    }
    </style>
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
          <a class="nav-link  active" href="{{url('/admin/manage/material/drugs/output')}}">药品出库登记</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/ledger')}}">药品台帐</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/remain')}}">药品库存</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository')}}">药品名录</a>
        </li>
    </ul>
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
    @endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>药品出库登记</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-body table-responsive">
                            <div class="card rounded-0 my-3">
                                <div class="card-header">
                                </div>
                                <div class="card-body table-responsive">
                                    <form action="/admin/manage/material/drugs/output/store" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" id="inOrOut" value="out">
                                        <div class="form-group row">
                                            <label for="drugName" class="col-sm-3 col-form-label">药品名称</label>
                                            <div class="col-sm-9">
                                                    <input type="hidden" id="drug_id" name="drug_id">
                                                    <input type="text" class="form-control" id="drug_name"  autocomplete="off" required>
                                                    <select name="" id="drug_info" class="form-control mt-1" multiple="multiple" size="5">
                                                        <option value="">返回的药品信息</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="drugType" class="col-sm-3 col-form-label">药品类别</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="drugType" name="drugType" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Supplier" class="col-sm-3 col-form-label">供货企业</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" id="supplier_id" name="">
                                                <input type="text" class="form-control" id="Supplier"  disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="drug_stored_id" class="col-sm-3 col-form-label">选择价格批次</label>
                                                    <div class="col-sm-9">
                                                    <select name="drug_stored_id" id="drug_stored_id" class="form-control">
                                                        <option value="">选择批次价格</option>
                                                    </select>
                                                    <div class="drug-feed-back text-danger" style="display:none">
                                                            <small>库存剩余量：</small>
                                                        </div>
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                                <label for="amount" class="col-sm-3 col-form-label">数量</label>
                                                <div class="col-sm-9 input-group">
                                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                                    <div class="input-group-append">
                                                            <div class="input-group-text bg-light"><span id="unit">/</span></div>
                                                          </div>
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                            <label for="outDay" class="col-sm-3 col-form-label">出库日期</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="outDay"  name="outDay" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="department" class="col-sm-3 col-form-label">领物部门</label>
                                            <div class="col-sm-9">
                                                <select name="department-0" id="department-0" class="form-control" onchange="get_department(this)" required>
                                                    <option value="">选择部门</option>
                                                    @foreach($departs as $depart)
                                                    <option value="{{$depart->id}}">{{$depart->departName}}</option>
                                                    @endforeach
                                                </select>
        
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="user" class="col-sm-3 col-form-label">领药人</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user" name="user" required>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-outline-primary" role="button">提交</button>
                                        </div>
                                    </form>
                                </div>
                <div class="card-footer">
                    说明：出库单位为入库的时候登记的单位，不可更改。如果登记的大，可以转换成小数，如0.5kg.
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
<script src="/js/autohideerror.js"></script>
<script src="/js/get_drug.js"></script>
<script src="/js/get_department.js"></script>
@stop
