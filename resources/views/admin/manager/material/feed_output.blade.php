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
                    <div class="mr-auto"><strong>饲料出库登记</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">饲料名称</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择饲料名称</option>
                                            <option value="1">371E</option>
                                            <option value="2">源动力</option>
                                            <option value="3">582</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                               
                                <div class="form-group row">
                                    <label for="feedClassic" class="col-sm-3 col-form-label">饲料类别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedClassic" value="精饲料" disabled>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">供货单位</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Supplier" value="河南东方正大有限公司" disabled>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputdate" class="col-sm-3 col-form-label">出库日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="inputdate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="chukutotal" class="col-sm-3 col-form-label">出库数量</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="chukutotal">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">负责人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zeren">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">登记人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zeren">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-outline-primary" href="#" role="button">提交</a>
                                  </div>
                            </form>
                    </div>
            <div class="card-footer">
                说明：单位统一为kg。
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
