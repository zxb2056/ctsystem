@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>药品库查看</title>
<style>
dd{
    padding: 5px 3px;
}
dt{
    padding:5px 3px; 
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
<div class="container">

<div class="h4 text-center mt-4">{{$drug->drugName}}</div>
<dl class="row">
    <dt class="col-sm-3">【名称】</dt>
    <dd class="col-sm-9">{{$drug->drugName}}</dd>
    <dt class="col-sm-3">【类别】</dt>
    <dd class="col-sm-9">{{$drug->drugType}}</dd>
    <dt class="col-sm-3">【计量单位】</dt>
    <dd class="col-sm-9">{{$drug->unit}}</dd>
    <dt class="col-sm-3">【包装规格】</dt>
    <dd class="col-sm-9">{{$drug->pack_size}}</dd>
    <dt class="col-sm-3">【供货公司】</dt>
    <dd class="col-sm-9">{{$drug->supplier}}</dd>
    <dt class="col-sm-3">【主要成分】</dt>
    <dd class="col-sm-9">{{$drug->main_components}}</dd>
    <dt class="col-sm-3">【性状】</dt>
    <dd class="col-sm-9">{{$drug->character}}</dd>
    <dt class="col-sm-3">【药理作用】</dt>
    <dd class="col-sm-9">{{$drug->yaolizuoyong}}</dd>
    <dt class="col-sm-3">【药动学】</dt>
    <dd class="col-sm-9">{{$drug->yao_dong_xue}}</dd>
    <dt class="col-sm-3">【适应症】</dt>
    <dd class="col-sm-9">{{$drug->suit_symptom}}</dd>
    <dt class="col-sm-3">【用法用量】</dt>
    <dd class="col-sm-9">{{$drug->main_usage_dosage}}</dd>
    <dt class="col-sm-3">【不良反应】</dt>
    <dd class="col-sm-9">{{$drug->adverse_reaction}}</dd>
    <dt class="col-sm-3">【注意事项】</dt>
    <dd class="col-sm-9">{{$drug->attention}}</dd>
    <dt class="col-sm-3">【规格】</dt>
    <dd class="col-sm-9">{{$drug->active_ingredient_content}}</dd>
    <dt class="col-sm-3">【贮藏】</dt>
    <dd class="col-sm-9">{{$drug->main_storage_method}}</dd>
    <dt class="col-sm-3">【批准文号】</dt>
    <dd class="col-sm-9">{{$drug->approval_number}}</dd>
    <dt class="col-sm-3">【备注】</dt>
    <dd class="col-sm-9">{{$drug->note}}</dd>
</dl>
    <div class="border p-3 my-1">
        <p>本药品从2019年1月1日开始使用，截止目前共治疗38头牛，治愈率70%。</p>
        <p><a href="#">点击查看，详细治疗历史</a></p>
    </div>
    <div class="border p-3 my-1">
        <div class="h5">库存剩余量报警</div>
        <p>该药品10天内用量为：***</p>
        <p>目前库存量为：***</p>
        <p>如果库存量小于10天用量，建议及时采购。</p>
    </div>
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
