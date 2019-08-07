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
<div class="alert alert-success">
{{session('success')}}
</div>
@endif
<div class="card rounded-0 my-3">
        <div class="card-header d-flex">
            <div class="mr-auto"><strong>联系人信息</strong></div>
    
    
        </div>
        <div class="card-body table-responsive">
            <div class="card rounded-0 my-3">
                <div class="card-header">
    
                </div>
                <div class="card-body table-responsive">
                    <form action="/admin/manage/supplier/contacter/plus" method="post" >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="supplier_id" class="col-sm-3 col-form-label text-right">公司名称<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">选择公司</option>
                                    @foreach ($suppliers as $item)
                                <option value="{{$item->id}}">{{$item->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="contacter" class="col-sm-3 col-form-label text-right">联系人名字<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contacter" name="contacter" required>
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="gender" class="col-sm-3 col-form-label text-right">性别</label>
                                <div class="col-sm-9">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">选择性别</option>
                                        <option value="男">男</option>
                                        <option value="女">女</option>
                                    </select>
                                </div>
                            </div>
    
                        <div class="form-group row">
                            <label for="position" class="col-sm-3 col-form-label text-right">职位</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="position" name="position">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label text-right">电话<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-right">邮箱</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="QQ" class="col-sm-3 col-form-label text-right">QQ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="QQ" name="QQ"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label text-right">目前状态<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select id="status" name="status" class="form-control" required>
                                    <option value="">选择状态</option>
                                    <option value="正常">正常可联系</option>
                                    <option value="不再联系">离职或转岗不再联系</option>
                                </select>
                            </div>
                        </div>
                        @if(count($errors) >0)
                        <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </div>
                        @endif
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary" href="#" role="button">提交</button>
                        </div>
                    </form>
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
