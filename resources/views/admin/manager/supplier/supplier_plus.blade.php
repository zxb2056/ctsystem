@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>增加供货商</title>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success autohidereturn">
        {{session('success')}} <a href="/admin/manage/supplier/contacter/plus">点击</a>去完善企业联系人
    </div>
@endif
@if(session('errors'))
    <div class="alert alert-danger autohidereturn">
        {{session('errors')}} <a href="/admin/manage/supplier/contacter/plus">点击</a>去完善企业联系人
    </div>
@endif
<div class="card rounded-0 my-3">
        <div class="card-header d-flex">
            <div class="mr-auto"><strong>新增供货商信息</strong></div>
    
    
        </div>
        <div class="card-body table-responsive">
            <div class="card rounded-0 my-3">
                <div class="card-header">
    
                </div>
                <div class="card-body table-responsive">
                    <form action="/admin/manage/supplier/plus" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label text-right">公司名称<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="company_name" name="company_name" class="form-control" required>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="company_license_code" class="col-sm-3 col-form-label text-right">统一社会信用代码<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="company_license_code" name="company_license_code" required>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label text-right">类型</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="type" name="type">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addr" class="col-sm-3 col-form-label text-right">地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addr" name="addr">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="registered_capital" class="col-sm-3 col-form-label text-right">注册资本(万)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="registered_capital" name="registered_capital">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scope" class="col-sm-3 col-form-label text-right">经营范围</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="scope" name="scope"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="license_photo" class="col-sm-3 col-form-label text-right">营业执照图片</label>
                            <div class="col-sm-9">
                                <input type="file"  id="license_photo" name="license_photo">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary" href="#" id="company_submit" role="button">提交</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    说明：
   
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

<script src="/js/check_extension.js"></script>
@stop
