@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>药品登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
#father-div{
    position: relative;
}
#supplier_info{
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
          <a class="nav-link active" href="{{url('/admin/manage/material/drugs/repository/plus')}}">药品信息登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/input')}}">药品入库登记</a>
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
    <p><a href="/admin/manage/material/drugs/repository">点击查看</a>全部信息</p>
</div>
@endif
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>新增药品种类</strong>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/manage/material/drugs/repository/store" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="drugName" class="col-sm-2 col-form-label text-right">药品名称<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="drugName" name="drugName" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="drugType" class="col-sm-2 col-form-label text-right">药品类别<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="custom-select" id="drugType" name="drugType" required>
                                        <option value="">选择药品类别</option>
                                        <option value="1">治疗类</option>
                                        <option value="2">输液类</option>
                                        <option value="3">消毒剂</option>
                                        <option value="4">疫苗</option>
                                        <option value="5">检疫类</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-2 col-form-label text-right">供货企业<span class="text-danger">*</span></label>
                                <div class="col-sm-7" id="father-div">
                                    <input type="hidden" id="supplier_id" name="supplier_id">
                                    <input type="text" class="form-control" id="supplier" name="supplier" required>
                                    <select name="" id="supplier_info" class="form-control mt-1" multiple="multiple" size="5">
                                        <option value="">供货商信息</option>
                                    </select>
                                    <div class="feed-back text-danger" id="supplier_back" style="display:none;" ><small>公司不存在，请核对</small></div>
                                </div>
                                <div class="col-sm-3"><span class="mr-1">不存在？</span>
                                    <a class="btn btn-sm btn-link" href="/admin/manage/supplier/plus" >新增</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-2 col-form-label text-right">计量单位<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline py-2">
                                        <input class="form-check-input" type="radio" name="unit" id="unit1" value="千克" required>
                                        <label class="form-check-label" for="unit1">千克</label>
                                    </div>
                                    <div class="form-check form-check-inline py-2">
                                        <input class="form-check-input" type="radio" name="unit" id="unit2" value="克" required>
                                        <label class="form-check-label" for="unit2">克</label>
                                    </div>
                                    <div class="form-check form-check-inline py-2">
                                        <input class="form-check-input" type="radio" name="unit" id="unit3" value="升" required>
                                        <label class="form-check-label" for="unit3">升</label>
                                    </div>
                                    <div class="form-check form-check-inline py-2">
                                        <input class="form-check-input" type="radio" name="unit" id="unit4" value="毫升" required>
                                        <label class="form-check-label" for="unit4">毫升</label>
                                    </div>
                                    <div class="form-check form-check-inline py-2">
                                        <input class="form-check-input" type="radio" name="unit" id="unit5" value="个" required>
                                        <label class="form-check-label" for="unit5">个</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pack_size" class="col-sm-2 col-form-label text-right">包装规格</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pack_size" name="pack_size">
                                    <div class="feed-back text-danger"><small>规格用*号隔开,否则后果不正确。如10ml*20瓶*1箱</small></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="main_components" class="col-sm-2 col-form-label text-right">主要成分</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="main_components" name="main_components">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="character" class="col-sm-2 col-form-label text-right">性状</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="character" name="character">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="active_ingredient_content" class="col-sm-2 col-form-label text-right">规格</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="active_ingredient_content" name="active_ingredient_content">
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="yaolizuoyong" class="col-sm-2 col-form-label text-right">药理作用</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="yaolizuoyong" name="yaolizuoyong"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="yao_dong_xue" class="col-sm-2 col-form-label text-right">药动学</label>
                                <div class="col-sm-10">
                                    <textarea  type="text" class="form-control" id="yao_dong_xue" name="yao_dong_xue"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="suit_symptom" class="col-sm-2 col-form-label text-right">适应症</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="suit_symptom" name="suit_symptom">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="usage_dosage" class="col-sm-2 col-form-label text-right">用法用量</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="usage_dosage" name="usage_dosage">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="adverse_reaction" class="col-sm-2 col-form-label text-right">不良反应</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="adverse_reaction" name="adverse_reaction">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="attention" class="col-sm-2 col-form-label text-right">注意事项</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="attention" name="attention">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="withdrawal_time" class="col-sm-2 col-form-label text-right">休药期</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="withdrawal_time" name="withdrawal_time">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="storage_method" class="col-sm-2 col-form-label text-right">贮藏</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="storage_method" name="storage_method">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="approval_number" class="col-sm-2 col-form-label text-right">批准文号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="approval_number" name="approval_number">
                                </div>
                        </div>
                            <div class="form-group row">
                                <label for="note" class="col-sm-2 col-form-label text-right">备注</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>
                        </div>
                    </div>
           
            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
            </form>
        </div>
    </div>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
{{-- <script src="/js/autohideerror.js"></script> --}}
<script src="/js/get_company.js"></script>
@stop