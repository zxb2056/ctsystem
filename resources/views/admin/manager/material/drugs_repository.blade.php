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
                    <div class="mr-auto"><strong>药品库</strong></div>
                    <div><button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#diseaseModal">增加</button></div>

                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>药品名称</th>
                                <th>药品类别</th>
                                <th>计量单位</th>
                                <th>供货单位</th>
                                <th>操作</th>



                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>头孢噻呋</td>
                                <td>治疗药品</td>
                                <td>ml</td>
                                <td>山东齐鲁药业</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>过氧乙酸</td>
                                <td>消毒剂</td>
                                <td>L</td>
                                <td>河南金正大有限公司</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>BVDV疫苗</td>
                                <td>疫苗</td>
                                <td>ml</td>
                                <td>内蒙古金宇保灵</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>布病检测卡</td>
                                <td>检疫药剂</td>
                                <td>个</td>
                                <td>内蒙古金宇保灵</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">新增药品种类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>新增药品种类</strong>

                        </div>
                        <div class="card-body ">
                            <form>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">药品名称</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fabingriqi" class="col-sm-3 col-form-label">药品类别</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择药品类别</option>
                                            <option value="1">消毒剂</option>
                                            <option value="2">治疗药品</option>
                                            <option value="3">疫苗</option>
                                            <option value="4">检疫</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="feedname" class="col-sm-3 col-form-label">计量单位 </label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="feedClassic" required>
                                            <option value="">选择单位</option>
                                            <option value="1">千克</option>
                                            <option value="2">克</option>
                                            <option value="3">升</option>
                                            <option value="4">毫升</option>
                                            <option value="5">个</option>
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
