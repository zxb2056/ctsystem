@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>批量新增防疫记录</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success autohidereturn mt-1">
    {{session('success')}}
</div>
@endif
@if(session('danger'))
<div class="alert alert-danger autohidereturn mt-1">
    {{session('danger')}}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger autohidereturn mt-1">
    {{session('error')}}
</div>
@endif
<div class="card rounded-0 my-3">
    @if ($errors->any())
    <div class="alert alert-danger autohidereturn">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="card-header d-flex">
    <div class="mr-auto"><strong>批量新增防疫记录</strong></div>
  </div>
  <div class="card-body">
    <form action="/admin/manage/Veterinary/antiepidemic/store" method="post">
      {{csrf_field()}}
      <div class="form-group row">
        <label for="barn_id" class="col-md-2 col-form-label col-form-label-sm">牛舍号</label>
        <div class="col-md-10">
          <select class="custom-select" id="barn_id" name="barn_id" required>
            <option value="">选择牛舍</option>
            @foreach($barns as $barn)
            <option value="{{$barn->id}}">{{$barn->barnName}}</option>
            @endforeach
          </select>
          <div class="text-danger" id="cattle_num_div" style="display:none">
            本舍共有<span id="barn_cattle_num">100</span>头牛
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="epidemic_type" class="col-md-2 col-form-label">免疫疾病</label>
        <div class="col-md-7">
          <select class="custom-select" id="epidemic_type" name="epidemic_type" required>
            <option value="">选择疫病种类</option>
            @foreach($epidemics as $epi)
            <option value="{{$epi->id}}">{{$epi->name}}</option>
            @endforeach

          </select>
        </div>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#plusEpidemicModal"> 添加疫病</button>
      </div>
      <div class="form-group row">
        <label for="anti_day" class="col-md-2 col-form-label">免疫日期</label>
        <div class="col-md-10">
          <input type="date" class="form-control" id="anti_day" name="anti_day">
        </div>
      </div>
      <div class="form-group row">
        <label for="drugName" class="col-md-2 col-form-label">药品名称</label>
        <div class="col-md-6">
          <input type="hidden" id="drug_id" name="drug_id">
          <input type="text" class="form-control" id="drug_name" required>
          <select name="" id="drug_info" class="form-control mt-1" multiple="multiple" size="5" style="display: none">
            <option value="">返回的药品信息</option>
          </select>
        </div>
        <div class="col-md-3"><span class="mr-1">不存在？</span>
          <a class="btn btn-sm btn-link" href="/admin/manage/material/drugs/repository/plus">新增</a>
        </div>
      </div>

      <div class="form-group row">
        <label for="drugType" class="col-md-2 col-form-label">药品类别</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="drugType" name="drugType" disabled>
        </div>
      </div>

      <div class="form-group row">
        <label for="Supplier" class="col-md-2 col-form-label">供货单位</label>
        <div class="col-md-10">
          <input type="hidden" id="supplier_id" name="supplier_id">
          <input type="text" class="form-control" id="Supplier" disabled>
        </div>
      </div>
      <div class="form-group row ">
        <label for="use_amount" class="col-md-2 col-form-label">用药量（ml/头)</label>
        <div class="col-md-10 input-group">
          <input type="text" class="form-control" id="use_amount" name="use_amount" required>
          <div class="input-group-append">
            <div class="input-group-text bg-light"><span id="unit">/</span></div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="pic" class="col-md-2 col-form-label">操作人员</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="pic" name="pic">
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
      </div>

    </form>





  </div>

</div>

</div>
<!-- Modal -->
<div class="modal fade" id="plusEpidemicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="plusEpidemicModalLabel">添加疫病</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/admin/manage/Veterinary/epidemic/plus_type" method="get">
        <div class="modal-body">
                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">疫病名称</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name"  name="name" >
                  </div>
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script src="/js/get_barn_cattle_num.js"></script>
<script src="/js/get_drug.js"></script>
<script src="/js/autohideerror.js"></script>
@stop