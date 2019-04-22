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
                        <div class="mr-auto"><strong>驱虫记录</strong></div>
                       
                    
                </div>
                <div class="card-body table-responsive">
                 
                    <div><h5>新增单条驱虫记录</h5></div>
                    <form action="#">
                        <div class="form-group row">
                            <label for="niushehao" class="col-sm-2 col-form-label col-form-label-sm">牛号</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control form-control-sm" id="niushehao" name="niushehao" >
                            </div>
                          </div>
                          <div class="form-group row">
                                <label for="date" class="col-sm-2 col-form-label">驱虫日期</label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" id="date"  name="matedate">
                                </div>
                              </div>
                          <div class="form-group row">
                              <label for="jiBing" class="col-sm-2 col-form-label">驱虫药品</label>
                              <div class="col-sm-10">
                                    <input type="number" class="form-control form-control-sm" id="niushehao" name="niushehao" >     
                              </div>
                            </div>
                                                    
                          <div class="form-group row">
                            <label for="manufacturers" class="col-sm-2 col-form-label">药品厂家</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="manufacturers"  name="manufacturers">
                            </div>
                          </div>
                          <div class="form-group row">
                                <label for="dosage" class="col-sm-2 col-form-label">用药量（ml)</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="dosage"  name="dosage">
                                </div>
                              </div>
                              <div class="form-group row">
                                    <label for="Operator" class="col-sm-2 col-form-label">操作人员</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="Operator"  name="Operator">
                                    </div>
                                  </div>
                          <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                          </div>
                         
                    </form>

          
               
                  </div>
              
                  </div>
            
        </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
