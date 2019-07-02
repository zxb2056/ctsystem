@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>产后护理情况</title>
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
      <a class="nav-link" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
    </li>
    <li class="nav-item">
      <a class="nav-link  active" href="{{url('/admin/manage/breed/aftercare')}}">产后护理</a>
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
      <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
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
                        <strong>产后护理数据录入</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <form action="/admin/manage/breed/aftercare/store" method="post">
                  {{csrf_field()}}
                    <div class="form-group row">
                        <label for="cowID" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="cowID" name="cowID" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="careDate" class="col-sm-2 col-form-label">护理日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="careDate"  name="careDate" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="temperature" class="col-sm-2 col-form-label">体温</label>
                        <div class="col-sm-10">
                            
                                <input type="text" class="form-control" id="temperature"  name="temperature">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Retention" class="col-sm-2 col-form-label">胎衣是否不下</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="Retention"  id="Retention" required>
                                <option selected>选择是或否</option>
                                <option value="是">是</option>
                                <option value="否">否</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="metritis" class="col-sm-2 col-form-label">是否子宫炎</label>
                        <div class="col-sm-10" >
                            <select class="custom-select" id="metritis" name="metritis" required>
                                <option selected>选择是或否</option>
                                <option value="是">是</option>
                                <option value="否">否</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="appetite" class="col-sm-2 col-form-label">食欲</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="appetite"  name="appetite">
                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="cowDung" class="col-sm-2 col-form-label">粪便</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="cowDung"  name="cowDung">
                            </div>
                          </div>
                      <div class="form-group row">
                        <label for="maternity" class="col-sm-2 col-form-label">母性好坏</label>
                        <div class="col-sm-10">
                                <select class="custom-select" id="maternity" name="maternity">
                                        <option selected>选择哺乳情况</option>
                                        <option value="正常">正常</option>
                                        <option value="母性好">母性好</option>
                                        <option value="母性差">母性差</option>
                                    </select>
                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="lactation" class="col-sm-2 col-form-label">泌乳情况</label>
                            <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lactation" id="lactation1" value="奶水多">
                                            <label class="form-check-label" for="miru1">奶水多</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lactation" id="lactation2" value="奶水正常">
                                            <label class="form-check-label" for="miru2">奶水正常</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lactation" id="lactation3" value="奶水少" >
                                            <label class="form-check-label" for="miru3">奶水少</label>
                                          </div>
                            </div>
                          </div>
                          <div class="form-group row">
                                <label for="careDrug" class="col-sm-2 col-form-label">护理药品或添加剂</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control " id="careDrug" name="careDrug"></textarea>
                                </div>
                              </div>
                      <div class="form-group row">
                        <label for="PIC" class="col-sm-2 col-form-label">护理人员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="PIC"  name="PIC">
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
