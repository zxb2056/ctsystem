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
                    <div class="mr-auto"><strong>器械耗材入库登记</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">器械耗材名称</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择器械耗材</option>
                                            <option value="1">一次性无菌注射器</option>
                                            <option value="2">针头</option>
                                            <option value="3">止血钳</option>
                                            <option value="3">推草车</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-3"><span class="mr-1">不存在？</span>
                                        <a class="btn btn-sm btn-outline-primary" href="#" role="button" data-toggle="modal" data-target="#FeedModal">新增</a>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="instruType" class="col-sm-3 col-form-label">材料类别</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="instruType" required>
                                            <option value="">选择材料类别</option>
                                            <option value="1">生产车辆</option>
                                            <option value="2">通用治疗器械</option>
                                            <option value="3">劳保生活用品</option>
                                            <option value="4">牛舍用具</option>
                                            <option value="5">其它</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">入库数量</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Supplier" value="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">供货单位</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Supplier" value="洛阳洛瑞药业有限公司" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit-price" class="col-sm-3 col-form-label">单价</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="unit-price">
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
                                    <label for="inputdate" class="col-sm-3 col-form-label">入库日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="inputdate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">采购人</label>
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
    说明：单位采用最小使用单位，如一包注射器50支写入库50支，而不是1包。其它类推。
</div>


                </div>

            </div>


        </div>





    </div>

    
<!-- Modal -->
<div class="modal fade" id="FeedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增器械/耗材种类</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增器械/耗材种类</strong>

                </div>
                <div class="card-body ">
                    <form>
                        <div class="form-group row">
                            <label for="feedname" class="col-sm-3 col-form-label">器械/耗材名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="feedname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fabingriqi" class="col-sm-3 col-form-label">器械/耗材类别</label>
                            <div class="col-sm-9">
                                <select class="custom-select" id="feedClassic" required>
                                    <option value="">选择器械耗材类别</option>
                                    <option value="1">生产车辆</option>
                                    <option value="2">通用治疗器械</option>
                                    <option value="3">劳保生活用品</option>
                                    <option value="4">牛舍用具</option>
                                    <option value="5">其它</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supplier" class="col-sm-3 col-form-label">供货单位</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="supplier">
                            </div>
                        </div>



                        

                    </form>



                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary">保存</button>
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
