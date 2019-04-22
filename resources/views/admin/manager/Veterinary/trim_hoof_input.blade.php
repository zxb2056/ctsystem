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
                        <div class="mr-auto"><strong>修蹄记录</strong></div>
                       
                    
                </div>
                <div class="card-body table-responsive">
                        <div class="card rounded-0 my-3">
                                <div class="card-header">
                                        <strong>修蹄登记</strong>
                                    
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
                                                  <label for="trimHoofriqi" class="col-sm-3 col-form-label">修蹄日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="trimHoofriqi" >
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="trimHoofriqi" class="col-sm-3 col-form-label">修蹄数量</label>
                                                        <div class="col-sm-9">
                                                           
                                                                      <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="left-front" value="option1">
                                                                            <label class="form-check-label" for="left-front">左前蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="right-front" value="option2">
                                                                            <label class="form-check-label" for="right-front">右前蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="left-back" value="option3" >
                                                                            <label class="form-check-label" for="left-back">左后蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="checkbox" id="right-back" value="option3" >
                                                                                <label class="form-check-label" for="right-back">左后蹄</label>
                                                                              </div>
                                                        </div>
                                                      </div>
                                                <div class="form-group row">
                                                        <label for="diseasename" class="col-sm-3 col-form-label">何种蹄病</label>
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
                                                            <label for="treatMethod" class="col-sm-3 col-form-label">用药方案</label>
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
