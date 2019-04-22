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
                    <div class="mr-auto"><strong>离场登记</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>淘汰登记</strong>

                        </div>
                        <div class="card-body ">
                            <form>
                                <div class="form-group row">
                                    <label for="niuhao" class="col-sm-3 col-form-label">牛号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="niuhao">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="reason" class="col-sm-3 col-form-label">淘汰原因</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="reason" required>
                                            <option value="">选择类型</option>
                                            <option value="1">疾病</option>
                                            <option value="2">死亡</option>
                                            <option value="3">低产</option>
                                            <option value="4">遗传缺陷</option>
                                            <option value="5">禁配</option>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="taotaidate" class="col-sm-3 col-form-label">淘汰日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="taotaidate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="whereGo" class="col-sm-3 col-form-label">淘汰去向</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="whereGo" required>
                                            <option value="">选择类型</option>
                                            <option value="1">无害化处理</option>
                                            <option value="2">屠宰场</option>
                                            <option value="3">农户</option>
                                            <option value="4">其他</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="treatMethod" class="col-sm-3 col-form-label">淘汰价值（元）</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="treatMethod">
                                                                  </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="result" class="col-sm-3 col-form-label">体重（kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="result">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">责任人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zeren">
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
