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
                        <strong>产犊数据录入</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <form action="#">
                    <div class="form-group row">
                        <label for="muniuhao" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control form-control-sm" id="muniuhao" name="muniuhao" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="yunjiandate" class="col-sm-2 col-form-label">产犊日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="date"  name="yunjiandate">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="yunresult" class="col-sm-2 col-form-label">产犊状态</label>
                        <div class="col-sm-10">
                        <select class="custom-select" id="yunresult" name="matetime">
                            <option selected>选择产犊状态</option>
                            <option value="1">正常</option>
                            <option value="2">难产</option>
                            <option value="3">早产</option>
                            <option value="4">流产</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="yunresult" class="col-sm-2 col-form-label">犊牛编号</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="yunresult"  name="matetime">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="yunresult" class="col-sm-2 col-form-label">犊牛性别</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="yunresult"  name="matetime">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="yunjianyuan" class="col-sm-2 col-form-label">接产员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="yunjianyuan"  name="yunjianyuan">
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
