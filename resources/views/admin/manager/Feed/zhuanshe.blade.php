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
                    <div class="mr-auto"><strong>牛只转舍</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="niuhao" class="col-sm-3 col-form-label">牛号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="niuhao">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="reason" class="col-sm-3 col-form-label">转入牛舍</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="reason" required>
                                            <option value="">选择牛舍</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="taotaidate" class="col-sm-3 col-form-label">转入日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="taotaidate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">执行人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zeren">
                                    </div>
                                </div>
                            </form>
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
