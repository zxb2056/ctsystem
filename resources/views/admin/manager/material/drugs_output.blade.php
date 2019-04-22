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
                    <div class="mr-auto"><strong>药品出库登记</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">药品名称</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择药品名称</option>
                                            <option value="1">盐酸多西环互</option>
                                            <option value="2">头孢噻呋</option>
                                            <option value="3">过氧乙酸</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                               
                                <div class="form-group row">
                                    <label for="feedClassic" class="col-sm-3 col-form-label">药品类别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedClassic" value="消毒制剂" disabled>
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
                                    <label for="chukutotal" class="col-sm-3 col-form-label">计量单位</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="chukutotal" value="ml" disabled>
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
                    说明：出库单位为入库的时候登记的单位，不可更改。如果登记的大，可以转换成小数，如0.5kg.
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
