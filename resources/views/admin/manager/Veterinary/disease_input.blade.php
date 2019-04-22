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
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>诊疗记录表</strong></div>
                       
                    
                </div>
                <div class="card-body table-responsive">
                        <div class="card rounded-0 my-3">
                                <div class="card-header">
                                        <strong>增加疾病诊疗记录</strong>
                                    
                                </div>
                                <div class="card-body ">
                                        <form>
                                                <div class="form-group row">
                                                  <label for="niuhao" class="col-sm-3 col-form-label">牛号</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="niuhao" >
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label for="fabingriqi" class="col-sm-3 col-form-label">发病日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="fabingriqi" >
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="diseasename" class="col-sm-3 col-form-label">何种疾病</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" id="diseasename" >
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                            <label for="diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                            <div class="col-sm-9">
                                                                    <textarea  class="form-control" id="treatMethod" >
                                                                        </textarea>
                                                            </div>
                                                          </div>
                                                      <div class="form-group row">
                                                            <label for="treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                            <div class="col-sm-9">
                                                              <textarea  class="form-control" id="treatMethod" >
                                                                  </textarea>
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="result" class="col-sm-3 col-form-label">治疗结果</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" id="result" >
                                                                </div>
                                                              </div>
                                                              <div class="form-group row">
                                                                    <label for="zeren" class="col-sm-3 col-form-label">责任兽医</label>
                                                                    <div class="col-sm-9">
                                                                      <input type="text" class="form-control" id="zeren" >
                                                                    </div>
                                                                  </div>
            
                                              </form>
                
                            
                               
                                  </div>
                                  <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
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
