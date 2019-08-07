@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>供货商详情页</title>
<style>
dt{
    padding: 5px;
}
dd{
    padding: 5px;
}
</style>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<div class="card rounded-0 my-3">
        <h5 class="card-title">{{$suppliers->company_name}} <small>--详细信息</small></h5>
        {{-- 基本信息 --}}
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>基本信息</strong></div>
                @if($suppliers->status != '-1')
                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#forbiddenModal">加入黑名单</button>
                @else 
                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#forbiddenModal">解除黑名单</button>
                @endif
                </div>
                <div class="card-body row">
                 <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-3">企业名称: </dt>
                        <dd class="col-md-9">{{$suppliers->company_name}} </dd>
                        <dt class="col-md-3">统一社会信用代码:</dt>
                        <dd class="col-md-9">{{$suppliers->company_license_code}}</dd>
                        <dt class="col-md-3">企业类型:</dt>
                        <dd class="col-md-9">{{$suppliers->type}}</dd>
                        <dt class="col-md-3">企业地址:</dt>
                        <dd class="col-md-9">{{$suppliers->addr}}</dd>
                        <dt class="col-md-3">注册资本:</dt>
                        <dd class="col-md-9">{{$suppliers->registered_capital}}&nbsp 万元</dd>
                        <dt class="col-md-3">经营范围:</dt>
                        <dd class="col-md-9">{{$suppliers->scope}}</dd>
                        <dt class="col-md-3">合作状态:</dt>
                        <dd class="col-md-9">@if($suppliers->status == '0') 后备 @elseif($suppliers->status == '1') 合作中 @else 已拉黑 @endif</dd>
                    </dl>

                 </div>
                 <div class="col-md-6">
                 <img src="/{{$suppliers->license_photo}}" alt="营业执照" class="img-fluid max-width:100%">
                </div>
                </div>
                <div class="card-footer">
                        <form action="/admin/manage/supplier/update/license" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" value="<?php echo $suppliers->id; ?>" name="id">
                            <label for="license_photo" class="cusom-label mr-4">更新营业执照</label>
                            <input type="file"  id="license_photo" name="license_photo">
                        <button type="submit" class="btn btn-sm btn-outline-secondary" id="company_submit">提交</button>
                    </form>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <hr>
        {{-- 历史使用统计 --}}
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>历史使用统计</strong></div>
                    </div>
                    <div class="card-body table-responsive">
                      @if(!empty($first))
                    <p>从&nbsp{{$first }}&nbsp开始合作，共进货{{$total_batchs}}次，总价值{{$total_sum}}元</p>
                      @endif
                       <p>所进的商品共有{{$counts}}类,分别是</p>
                       <ul>
                         @foreach ($items as $item)
                       <li>{{$item->type_name}} &nbsp&nbsp&nbsp&nbsp<a href="{{$item->query_link}}?company_name={{$item->linkcompany->company_name}}">查看详情</a></li>
                         @endforeach
                       </ul>
                    </div>
                    <div class="card-footer">
                        
                    </div>
        {{-- 各种明细表链接，如药品类，冻精类，饲料类，技术服务类 --}}

</div>

{{-- modal 黑白名单 --}}
<div class="modal" tabindex="-1" role="dialog" id="forbiddenModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">@if($suppliers->status != '-1')
                    加入黑名单
                    @else 
                    解除黑名单
                    @endif
                </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <form action="/admin/manage/supplier/forbidden/{{$suppliers->id}}" method="get">
            <div class="modal-body">
                    <div class="form-group row">
                            <label for="scope" class="col-sm-3 col-form-label text-right">生效日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="happen_date" name="happen_date" value="<?php echo date('Y-m-d'); ?>"></input>
                            </div>
                    </div>
                    <div class="form-group row">
                                <label for="reason" class="col-sm-3 col-form-label text-right">原因</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="reason" name="reason" ></input>
                                </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
          </div>
        </div>
      </div>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script src="/js/check_extension.js"></script>
@stop
