@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>B超检查结果</title>
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
        <a class="nav-link" href="{{url('/admin/manage/breed/mateInput')}}" >配种</a>
      </li>
    <li class="nav-item">
      <a class="nav-link  active" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/aftercare')}}">产后护理</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/waitmate')}}">待配母牛表</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/fanzhidisease')}}">繁殖病症诊疗卡</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
    </li>
  </ul>
  
  @if(!empty(session('error')))
    <div class="alert alert-danger autohidereturn">
      {{session('error')}}
    </div>
  @endif
  @if(!empty(session('success')))
    <div class="alert alert-success autohidereturn">
      {{session('success')}}
    </div>
  @endif
<div class="card rounded-0 my-3">
                <div class="card-header">
                        <strong>孕检数据录入</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <form action="{{url('/admin/manage/breed/pregnancy_check_store')}}" method="post">
                  {{csrf_field()}}
                    <div class="form-group row">
                        <label for="cowID" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control form-control-sm" id="cowID" name="cowID" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="checkDate" class="col-sm-2 col-form-label">孕检日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="checkDate"  name="checkDate"  value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="checkResult" class="col-sm-2 col-form-label">孕检结果</label>
                        <div class="col-sm-10">
                          <select name="checkResult" id="checkResult" class="form-control">
                              <option value="怀孕">怀孕</option>
                              <option value="未孕">未孕</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="related_disease" class="col-sm-2 col-form-label">异常诊断</label>
                        <div class="col-sm-10">
                          <select name="related_disease" id="related_disease" class="form-control">
                            <option value="正常">正常</option>
                            <option value="子宫炎">子宫炎</option>
                            <option value="卵巢囊肿">卵巢囊肿</option>
                            <option value="卵巢静止">卵巢静止</option>
                            <option value="子宫畸形">子宫畸形</option>
                            <option value="子宫缺失">子宫缺失</option>
                            <option value="其它">其它</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="note" class="col-sm-2 col-form-label">备注说明</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="note"  name="note">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="checker" class="col-sm-2 col-form-label">孕检员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="checker"  name="checker" required>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                      </div>
                     
                </form>
            
               
                  </div>
                  <div class="card-footer">
   
                  </div>
                  </div>
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/autohideerror.js"></script>
@stop
