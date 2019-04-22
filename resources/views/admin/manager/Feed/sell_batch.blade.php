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
                            <strong>批量出售</strong>

                        </div>
                        <div class="card-body ">
                            <form>
                                <div class="form-group row">
                                    <label for="niuhao" class="col-sm-3 col-form-label">牛舍号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="niuhao">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sellreason" class="col-sm-3 col-form-label">出售原因</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="sellreason" value="正常出售">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="taotaidate" class="col-sm-3 col-form-label">出售日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="taotaidate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="whereGo" class="col-sm-3 col-form-label">出售去向</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="whereGo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="treatMethod" class="col-sm-3 col-form-label">出售价格（元）</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="treatMethod">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="result" class="col-sm-3 col-form-label">总体重（kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="result">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sellValue" class="col-sm-3 col-form-label">出售价值（元）</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="sellValue">
                                    
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
<div class="card-footer">
    说明：出售前的牛只可以提前集中到一个牛舍。选择牛舍号就可以。少量牛只用离场登记。
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
