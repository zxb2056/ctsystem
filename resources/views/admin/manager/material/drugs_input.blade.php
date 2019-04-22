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
                    <div class="mr-auto"><strong>药品入库登记</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">药品名称</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择药品名称</option>
                                            <option value="1">盐酸多西环素</option>
                                            <option value="2">头孢噻呋</option>
                                            <option value="3">碘伏</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-3"><span class="mr-1">不存在？</span>
                                        <a class="btn btn-sm btn-outline-primary" href="#" role="button" data-toggle="modal" data-target="#FeedModal">新增</a>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="feedClassic" class="col-sm-3 col-form-label">药品类别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedClassic" value="治疗类药" disabled>
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
                                            <label class="form-check-label" for="inlineRadio3">千克</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">克</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">升</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">毫升</label>
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
                                    <label for="validity" class="col-sm-3 col-form-label">有效期至</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="validity">
                                    </div>
                                </div>
                               
                                
                               
                                
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">执行人</label>
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
    说明：不使用模糊性的盒，包，袋等单位，全部换算成kg,ml等明确单位。如果是检测卡类用单位“个”。
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
            <h5 class="modal-title" id="exampleModalLabel">新增饲料种类</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增饲料种类</strong>
                </div>
                <div class="card-body ">
                    <form>
                        <div class="form-group row">
                            <label for="feedname" class="col-sm-3 col-form-label">饲料名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="feedname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fabingriqi" class="col-sm-3 col-form-label">饲料类别</label>
                            <div class="col-sm-9">
                                <select class="custom-select" id="feedClassic" required>
                                    <option value="">选择饲料类别</option>
                                    <option value="1">精饲料</option>
                                    <option value="2">粗饲料</option>
                                    <option value="3">添加剂</option>
                                    <option value="4">其它</option>
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
