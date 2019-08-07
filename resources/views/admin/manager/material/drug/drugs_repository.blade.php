@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>药品库查看</title>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/repository/plus')}}">药品信息登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/material/drugs/input')}}">药品入库登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{url('/admin/manage/material/drugs/output')}}">药品出库登记</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/ledger/store')}}">药品台帐</a>
        </li>
        <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/manage/material/drugs/remain')}}">药品库存</a>
        </li>
        <li class="nav-item">
                <a class="nav-link  active" href="{{url('/admin/manage/material/drugs/repository')}}">药品名录</a>
        </li>
</ul>
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                <div class="mr-auto"><strong>药品库</strong><small>--共有{{$repos->total()}}个药品</small></div>
                    <div><a type="button" class="btn btn-sm" href="/admin/manage/material/drugs/repository/plus">增加</a></div>

                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover table-sm border">
                        <thead>
                            <tr>
                                <th>序号</th>
                                <th>药品名称</th>
                                <th>药品类别</th>
                                <th>计量单位</th>
                                <th>包装规格</th>
                                <th>供货公司</th>
                                <th>主要成分</th>
                                <th>性状</th>
                                <th>药理作用</th>
                                <th>药动学</th>
                                <th>适应症</th>
                                <th>用法用量</th>
                                <th>不良反应</th>
                                <th>注意事项</th>
                                <th>休药期</th>
                                <th>有效成分含量</th>
                                <th>贮藏方法</th>
                                <th>批准文号</th>
                                <th>备注说明</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($repos as $repo)
                            <tr>
                                <td>{{(($repos->currentPage()-1)*$repos->perPage()) + $loop->iteration }}</td>
                            <td><a href="/admin/manage/material/drugs/repo/detail/{{$repo->id}}">{{str_limit($repo->drugName,20,'...')}}</a></td>
                                <td>{{str_limit($repo->drugType,10,'...')}}</td>
                                <td>{{str_limit($repo->unit,10,'...')}}</td>
                                <td>{{str_limit($repo->pack_size,10,'...')}}</td>
                                <td>{{str_limit($repo->supplier,10,'...')}}</td>
                                <td>{{str_limit($repo->main_components,10,'...')}}</td>
                                <td>{{str_limit($repo->character,10,'...')}}</td>
                                <td>{{str_limit($repo->yaolizuoyong,10,'...')}}</td>
                                <td>{{str_limit($repo->yao_dong_xue,10,'...')}}</td>
                                <td>{{str_limit($repo->suit_symptom,10,'...')}}</td>
                                <td>{{str_limit($repo->usage_dosage,10,'...')}}</td>
                                <td>{{str_limit($repo->adverse_reaction,10,'...')}}</td>
                                <td>{{str_limit($repo->attention,10,'...') }}</td>
                                <td>{{str_limit($repo->withdrawal_time,10,'...')}}</td>
                                <td>{{str_limit($repo->active_ingredient_content,10,'...')}}</td>
                                <td>{{str_limit($repo->storage_method,10,'...')}}</td>
                                <td>批准文号</td>
                                <td>{{str_limit($repo->note,10,'...')}}</td>
                                <td><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-id="1" data-target="#diseaseModal">编辑</button></td>
                            </tr>
                            @endforeach
                            
                        </tbody>

                    </table>


                </div>
                <div class="card-footer d-flex justify-content-center">
                    {{$repos->links()}}
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
