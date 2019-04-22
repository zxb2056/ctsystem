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
                        <strong>配种数据录入</strong>
                    
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
                        <label for="dongjinghao" class="col-sm-2 col-form-label">冻精号</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="dongjinghao"  name="dongjinghao">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">配种日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="date"  name="matedate">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="matetime" class="col-sm-2 col-form-label">配种时间</label>
                        <div class="col-sm-10">
                          <input type="time" class="form-control" id="matetime"  name="matetime">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">配种员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="date"  name="peizhongyuan">
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


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
