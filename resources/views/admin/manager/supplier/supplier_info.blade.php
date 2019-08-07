@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>供货单位信息查看</title>
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
        <div class="mr-auto"><strong>供货公司列表</strong></div>
        <div class="text-danger"><small>目前已经同&nbsp{{$suppliers->total()}}&nbsp家公司产生联系</small></div>
    </div>
    <form action="/admin/manage/supplier/info" method="get">
        <div class="card-header row">
            <div class="col-md-3">
                <div class="form-group row">
                        <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">每页显示</label>
                        <div class="col-md-9">
                            <select name="showitem" id="showitem" class="form-control form-control-sm">
                                <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10条</option>
                                <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                            </select>
                        </div>
                        </div>  
                    </div>      
            <div class="col-md-3">
                <div class="form-group row ">
                    <label for="company_name" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">公司名称</label>
                    <div class="col-md-9 input-group">
                        <input type="text" name="company_name" id="company_name" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row ">
                    <label for="registered_capital" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">注册资本</label>
                    <div class="col-md-9 input-group">
                        <div class="input-group-prepend-sm">
                            <select name="capital_require" id="capital_require" class="custom-select-sm">
                                <option value=">">></option>
                                <option value=">=">>=</option>
                                <option value="=">=</option>
                                <option value="<"><</option> 
                                <option value="<="><=</option>
                            </select> 
                        </div> 
                        <input type="text" name="registered_capital" id="registered_capital" class="form-control form-control-sm">
                        <div class="input-group-append-sm">
                                <span class=" input-group-text"><small>万</small></span>
                        </div>
                        </div>
                    </div>
            </div>
                    <div class="col-md-3">
                             <button type="submit" class="btn btn-sm btn-outline-primary">查询</button>
                    </div>
                </form>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover border">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>公司名称</th>
                        <th>统一社会信用代码</th>
                        <th>公司类型</th>
                        <th>地址</th>
                        <th>注册资本</th>
                        <th>经营范围</th>
                        <th>营业执照图片</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $sup)
                    <tr>
                        <td>{{(($suppliers->currentPage()-1)*$suppliers->perPage()) + $loop->iteration}}</td>
                        <td><a href="/admin/manage/supplier/detail/{{$sup->id}}">{{$sup->company_name}}</a></td>
                        <td>{{$sup->company_license_code}}</td>
                        <td>{{$sup->type}}</td>
                        <td>{{str_limit($sup->addr,20,'...')}}</td>
                        <td>{{$sup->registered_capital}}</td>
                        <td>{{str_limit($sup->scope,20,'...')}}</td>
                        <td><a href="/{{$sup->license_photo}}" alt="">营业执照</a></td>
                        <td>@if($sup->status == '0') 后备 @elseif($sup->status == '1') 合作中 @else 已拉黑 @endif</td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
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