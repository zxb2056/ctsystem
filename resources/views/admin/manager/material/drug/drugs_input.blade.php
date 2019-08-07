@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>药品登记</title>
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
          <a class="nav-link  active" href="{{url('/admin/manage/material/drugs/input')}}">药品入库登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/output')}}">药品出库登记</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/ledger/store')}}">药品台帐</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/remain')}}">药品库存</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository')}}">药品名录</a>
        </li>
    </ul>
    @if(session('success'))
    <div class="alert alert-success autohidereturn">
        {{session('success')}}
    </div>
    @endif
<div class="card rounded-0 my-3">
    <div class="card-header d-flex">
        <div class="mr-auto"><strong>药品入库登记</strong></div>


    </div>
    <div class="card-body table-responsive">
        <div class="card rounded-0 my-3">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive">
                <form action="/admin/manage/material/drugs/input" method="post">
                    {{csrf_field()}}
                    <input type="hidden" id="inOrOut" value="store">
                    <div class="form-group row">
                        <label for="drugName" class="col-sm-3 col-form-label">药品名称</label>
                        <div class="col-sm-6">
                                <input type="hidden" id="drug_id" name="drug_id">
                                <input type="text" class="form-control" id="drug_name"  required>
                                <select name="" id="drug_info" class="form-control mt-1" multiple="multiple" size="5">
                                    <option value="">返回的药品信息</option>
                                </select>
                        </div>
                        <div class="col-sm-3"><span class="mr-1">不存在？</span>
                            <a class="btn btn-sm btn-link" href="/admin/manage/material/drugs/repository/plus" >新增</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="drugType" class="col-sm-3 col-form-label">药品类别</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="drugType" name="drugType" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Supplier" class="col-sm-3 col-form-label">供货单位</label>
                        <div class="col-sm-9">
                            <input type="hidden" id="supplier_id" name="supplier_id">
                            <input type="text" class="form-control" id="Supplier"  disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit-price" class="col-sm-3 col-form-label">单价</label>
                        <div class="col-sm-9 input-group"> 
                            <input type="number"  step="0.00000001" class="form-control" id="unit-price" name="price" required>
                            <div class="input-group-append">
                                    <div class="input-group-text bg-light"><span id="unit">/</span></div>
                                  </div>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label">数量</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="storedDay" class="col-sm-3 col-form-label">入库日期</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="storedDay"  name="storedDay" required>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="date_of_manufacture"  class="col-sm-3 col-form-label">生产日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="date_of_manufacture" name="date_of_manufacture">
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="retention_period" class="col-sm-3 col-form-label">保质期(天)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="retention_period" name="retention_period" max="100000000">
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="expire_date" class="col-sm-3 col-form-label">截止日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="expire_date" name="expire_date">
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="PIC" class="col-sm-3 col-form-label">负责人</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="PIC" name="PIC" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-primary" role="button">提交</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                说明：
                <p>1、不使用模糊性的盒，包，袋等单位，全部换算成kg,ml等明确单位。如果是检测卡类用单位“个”。</p>
                <p>2、药品如果有重复,供货单位会出现下拉框，选择相应的公司即可。</p>
                <p>3、单价，指的是最小单位价格，例如每ml多少元，每g多少元。</p>
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
@stop