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
<div class="card rounded-0 my-3">
                <div class="card-header">
                        <strong>产后护理数据录入</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <form action="#">
                    <div class="form-group row">
                        <label for="muniuhao" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control form-control-sm" id="muniuhao" name="muniuhao" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="aftercaredate" class="col-sm-2 col-form-label">护理日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="aftercaredate"  name="aftercaredate" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="yunresult" class="col-sm-2 col-form-label">体温</label>
                        <div class="col-sm-10">
                            
                                <input type="number" class="form-control" id="tiwen"  name="tiwen">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="taiyiresult" class="col-sm-2 col-form-label">胎衣是否不下</label>
                        <div class="col-sm-10">
                            <select class="custom-select" required>
                                <option selected>选择是或否</option>
                                <option value="1">是</option>
                                <option value="2">否</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="zigongresult" class="col-sm-2 col-form-label">是否子宫炎</label>
                        <div class="col-sm-10" >
                            <select class="custom-select" id="zigongresult" >
                                <option selected>选择是或否</option>
                                <option value="1">是</option>
                                <option value="2">否</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="shiyu" class="col-sm-2 col-form-label">食欲</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="shiyu"  name="shiyu">
                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="fenbian" class="col-sm-2 col-form-label">粪便</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="fenbian"  name="fenbian">
                            </div>
                          </div>
                      <div class="form-group row">
                        <label for="dairy" class="col-sm-2 col-form-label">哺乳情况</label>
                        <div class="col-sm-10">
                                <select class="custom-select" id="dairy">
                                        <option selected>选择哺乳情况</option>
                                        <option value="1">正常</option>
                                        <option value="2">母性好</option>
                                        <option value="3">母性差</option>
                                    </select>
                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="dairy" class="col-sm-2 col-form-label">泌乳情况</label>
                            <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="miru" id="miru1" value="option1">
                                            <label class="form-check-label" for="miru1">奶水多</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="miru" id="miru2" value="option2">
                                            <label class="form-check-label" for="miru2">奶水正常</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="miru" id="miru3" value="option3" >
                                            <label class="form-check-label" for="miru3">奶水少</label>
                                          </div>
                            </div>
                          </div>
                          <div class="form-group row">
                                <label for="huliyaopin" class="col-sm-2 col-form-label">护理药品或添加剂</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control " id="huliyaopin" ></textarea>
                                </div>
                              </div>
                      <div class="form-group row">
                        <label for="huliyuan" class="col-sm-2 col-form-label">护理人员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="huliyuan"  name="huliyuan">
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

@stop
