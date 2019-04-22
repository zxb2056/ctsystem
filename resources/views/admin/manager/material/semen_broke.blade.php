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
                    <div class="mr-auto"><strong>冻精损坏登记</strong></div>
        </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body table-responsive">
                            <form>
                                    <div class="form-group row">
                                            <label for="semenNum" class="col-sm-3 col-form-label">冻精号</label>
                                            <div class="col-sm-6">
                                                <select class="custom-select" id="semenNum" required>
                                                    <option value="">选择冻精号</option>
                                                    <option value="1">41109231</option>
                                                    <option value="2">1145625</option>
                                                    <option value="3">51118056</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-3"><span class="mr-1">不存在？</span>
                                                <a class="btn btn-sm btn-outline-primary" href="#" role="button" data-toggle="modal" data-target="#SemenModal">新增</a>
                                            </div>
                                        </div>
                               
                                <div class="form-group row">
                                    <label for="Supplier" class="col-sm-3 col-form-label">供货单位</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Supplier" value="河南省鼎元种牛育种有限公司" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit-price" class="col-sm-3 col-form-label">数量</label>
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
                                    
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdate" class="col-sm-3 col-form-label">损坏日期</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="inputdate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="inputdate" class="col-sm-3 col-form-label">损坏原因</label>
                                        <div class="col-sm-9">
                                                <select class="custom-select" id="semenNum" required>
                                                        <option value="">选择损坏原因</option>
                                                        <option value="1">爆管</option>
                                                        <option value="2">液氮少，精子死亡</option>
                                                        <option value="3">其它原因</option>
                                                        
                                                    </select>
                                        </div>
                                    </div>
                               
                                <div class="form-group row">
                                    <label for="zeren" class="col-sm-3 col-form-label">负责人</label>
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
                说明：单位按支算。
            </div>
                </div>
            </div>
       </div>
   </div>

   
<!-- Modal -->
<div class="modal fade" id="SemenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增冻精到公牛库</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增冻精到公牛库</strong>

                </div>
                <div class="card-body ">
                    <form>
                        <div class="form-group row">
                            <label for="semenNum" class="col-sm-3 col-form-label">冻精号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="semenNum">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="supplier" class="col-sm-3 col-form-label">供货单位</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="supplier">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="sire" class="col-sm-3 col-form-label">父亲号</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="sire">
                                </div>
                                <div class="col-sm-3">
                                    <input type="button" class="btn btn-sm btn-outline-warning" value="ajax判断">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="dam" class="col-sm-3 col-form-label">母亲号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="dam">
                                    </div>
                                </div>
                                                      

                    </form>



                </div>
        <div class="card-footer">
            说明：冻精的父亲号系谱单独再添加进公牛库。
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
