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
                    <div class="mr-auto"><strong>器械耗材盘点</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">器械耗材名称</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择器械耗材名称</option>
                                            <option value="1">一次性注射器</option>
                                            <option value="2">针头</option>
                                            <option value="3">修蹄刀</option>
                                            
                                        </select>
                                    </div>
                                   
                                </div>
                               
                                <div class="form-group row">
                                    <label for="feedClassic" class="col-sm-3 col-form-label">器械耗材类别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedClassic" value="通用治疗器械" disabled>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">供货单位</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Supplier" value="洛阳洛瑞药业有限公司" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="Supplier" class="col-sm-3 col-form-label">库内数量</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="Supplier" value="" >
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">库外数量</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="Supplier" value="" >
                                    </div>
                                </div>
                               <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label">单位</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">支</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">个</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">辆</label>
                                          </div>
                                         
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="Supplier" class="col-sm-3 col-form-label">系统显示库内数量</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="Supplier" value="20" disabled>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">系统显示库外数量</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="Supplier" value="10" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdate" class="col-sm-3 col-form-label">盘点日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="inputdate">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">盘点人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zeren" placeholder="可以多人，逗号隔开">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-outline-primary" href="#" role="button">提交</a>
                                  </div>
                            </form>
                    </div>
<div class="card-footer">
   
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
