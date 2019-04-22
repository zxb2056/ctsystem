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
                        <div class="mr-auto"><strong>检疫记录</strong></div>
                       
                    
                </div>
                <div class="card-body table-responsive">
                        <div class="card rounded-0 my-3">
                                <div class="card-header">
                                        <strong>增加检疫记录</strong>
                                    
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
                                                  <label for="jianyiriqi" class="col-sm-3 col-form-label">检疫日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="jianyiriqi" >
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="inspectname" class="col-sm-3 col-form-label">检疫类型</label>
                                                        <div class="col-sm-9">
                                                                <select class="custom-select" name="inspectType" id="inspectType">
                                                                        <option value="1">结核病</option>
                                                                        <option value="2">布氏杆菌病</option>
                                                                        <option value="3">口蹄疫</option>
                                                                        <option value="4">副结核</option>
                                                                        <option value="5">病毒性腹泻</option>
                                                                        <option value="6">粘膜病</option>
                                                                        <option value="7">牛传染性鼻气管炎</option>
                                                                    </select>
                                                        </div>
                                                      </div>
                                                <div class="form-group row">
                                                        <label for="inspecttype" class="col-sm-3 col-form-label">检疫方式</label>
                                                        <div class="col-sm-9">
                                                                <select class="custom-select" name="inspectType" id="inspectType">
                                                                        <option value="1">皮内</option>
                                                                        <option value="2">皮下</option>
                                                                        <option value="3">血检</option>
                                                                        <option value="4">肌注</option>
                                                                    </select>
                                                        </div>
                                                      </div>
                                                    
                                                      <div class="form-group row">
                                                            <label for="inspectAddr" class="col-sm-3 col-form-label">检疫地点</label>
                                                            <div class="col-sm-9">
                                                              <input type="text"  class="form-control" id="inspectAddr" placeholder="牧场内或实验室所在地" >
                                                            </input>
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="result" class="col-sm-3 col-form-label">检疫结果</label>
                                                                <div class="col-sm-9">
                                                                    
                                                                  <select class="custom-select" name="inspectResult" id="inspectResult">
                                                                      <option value="1">阴性</option>
                                                                      <option value="2">阳性</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="form-group row">
                                                                    <label for="zeren" class="col-sm-3 col-form-label">责任人</label>
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
