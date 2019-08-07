@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>淘汰登记</title>
<style>
    .must-fill-in{
        color:red;
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
          <a class="nav-link active" href="{{url('/admin/manage/feed/dieOut')}}">淘汰登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/sell_batch')}}">出售登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/change_barn')}}">转舍登记</a>
        </li>
    </ul>
    @if(session('success'))
    <div class="alert alert-success autohidereturn">
        {{session('success')}}
    </div>
    @endif
    @if(session('danger'))
    <div class="alert alert-danger">
        {{session('danger')}}
    </div>
    @endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>离场登记</strong></div>
               </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>淘汰登记</strong>

                        </div>
                        <div class="card-body ">
                            <form action="/admin/manage/feed/dieOut" method="POST">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="cattleFrom" class="col-sm-3 col-form-label text-right">牛只来源<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="cattleFrom" id="cattleFrom" class="form-control" required>
                                            <option value="单个出售">单个淘汰</option>
                                            <option value="拼凑">组合</option>
                                        </select>
                                    </div>
                            </div>
                                <div class="form-group row">
                                    <label for="cattleID" class="col-sm-3 col-form-label text-right">牛号<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="cattleID" name="cattleID" required>
                                        <div class="check-feedback text-danger" hidden> </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="totalCattleNum" class="col-sm-3 col-form-label text-right">牛头数</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="totalCattleNum" name="totalCattleNum" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="reason" class="col-sm-3 col-form-label text-right">淘汰原因</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="reason" name="reason" required>
                                            <option value="">选择类型</option>
                                            <option value="疾病">疾病</option>
                                            <option value="死亡">死亡</option>
                                            <option value="低产">低产</option>
                                            <option value="遗传缺陷">遗传缺陷</option>
                                            <option value="禁配">禁配</option>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="elimiDay" class="col-sm-3 col-form-label text-right">淘汰日期<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="elimiDay" name="elimiDay" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Towhere" class="col-sm-3 col-form-label text-right">淘汰去向<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="ToWhere" name="ToWhere" required>
                                            <option value="">选择类型</option>
                                            <option value="无害化处理">无害化处理</option>
                                            <option value="屠宰场">屠宰场</option>
                                            <option value="农户">农户</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="whichFactory" class="col-sm-3 col-form-label text-right">购买者性质<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="buyerAttribute" id="buyerAttribute" class="form-control" required>
                                            <option value="">选择购买者性质</option>
                                            <option value="单位">单位</option>
                                            <option value="个人">个人</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="buyerName" class="col-sm-3 col-form-label text-right">购买者名称<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="buyerName" name="buyerName" required>
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <label for="buyerPhone" class="col-sm-3 col-form-label text-right">购买者电话<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="buyerPhone" name="buyerPhone" required>
                                    </div>
                            </div> 
                                <div class="form-group row">
                                    <label for="eliminateIncome" class="col-sm-3 col-form-label text-right">淘汰价值（元）</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="eliminateIncome" name="eliminateIncome">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bodyweight" class="col-sm-3 col-form-label text-right">体重（kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bodyweight" name="bodyweight">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="PIC" class="col-sm-3 col-form-label text-right">责任人<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="PIC" name="PIC" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="note" class="col-sm-3 col-form-label text-right">备注说明</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="note" name="note">
                                        </div>
                                    </div>
                                <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                                    </div>
                            </form>
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
<script type="text/javascript" src="/js/autohideerror.js"> </script>
<script type="text/javascript" src="/js/sell_batch.js"></script>
@stop
