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
                    <div class="mr-auto"><strong>饲料库</strong></div>
                    <div><button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#diseaseModal">增加</button></div>

                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>饲料名称</th>
                                <th>饲料类别</th>
                                <th>供货单位</th>
                                <th>操作</th>



                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>371E</td>
                                <td>精饲料</td>
                                <td>河南东方正大有限公司</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>源动力</td>
                                <td>添加剂</td>
                                <td>河南金正大有限公司</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>青贮</td>
                                <td>粗饲料</td>
                                <td>农户</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                        </tbody>

                    </table>


                </div>

            </div>

        </div>
        <!-- Modal -->
    <div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
