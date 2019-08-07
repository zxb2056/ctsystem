@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>销售登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.must-fill-in{
    color:red;
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
    <ul class="nav nav-tabs bg-light">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/dieOut')}}">淘汰登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{url('/admin/manage/feed/sell_batch')}}">出售登记</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/change_barn')}}">转舍登记</a>
        </li>
    </ul>
@if(!empty(session('success')))
<div class="alert alert-success autohidereturn">
    {{session('success')}}
</div>
@endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>离场登记</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card-header">
                            <strong>批量出售</strong>
                        </div>
                        <div class="card-body ">
                            <form action="/admin/manage/feed/sell_batch" method="POST">
                                {{csrf_field()}}
                            
                                <div class="form-group row">
                                    <label for="saleDay" class="col-sm-2 col-form-label text-right">出售日期<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="saleDay" name="saleDay" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="whichFactory" class="col-sm-2 col-form-label text-right">购买者性质<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="buyerAttribute" id="buyerAttribute" class="form-control" required>
                                            <option value="">选择购买者性质</option>
                                            <option value="单位">单位</option>
                                            <option value="个人">个人</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="buyerName" class="col-sm-2 col-form-label text-right">购买者名称<span class="must-fill-in">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="buyerName" name="buyerName" required>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                        <label for="buyerPhone" class="col-sm-2 col-form-label text-right">购买者电话<span class="must-fill-in">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="buyerPhone" name="buyerPhone" required>
                                        </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="PricePerKg" class="col-sm-2 col-form-label text-right">价格（元/kg）<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="PricePerKg" name="PricePerKg" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="cattleFrom" class="col-sm-2 col-form-label text-right">牛只来源<span class="must-fill-in">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="cattleFrom" id="cattleFrom" class="form-control" required>
                                                <option value="单个出售">单个出售</option>
                                                <option value="整舍">整舍</option>
                                                <option value="组合">组合</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row" id="cattleIDdiv">
                                        <label for="cattleID" class="col-sm-2 col-form-label text-right">牛号<span class="must-fill-in">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cattleID" name="cattleID" required>
                                            <div class="check-feedback text-danger" hidden> </div>
                                        </div>
                                </div>
                                <div class="form-group row" style="display:none" id="barndiv">
                                        <label for="barnID" class="col-sm-2 col-form-label text-right">舍号<span class="must-fill-in">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="barnID" id="barnID" class="form-control">
                                                <option value="">选择舍号</option>
                                                @foreach($barns as $barn)
                                            <option value="{{$barn->id}}">@if($barn->barnID == '-1') #-{{$barn->barnName}} @else {{$barn->barnID}}-{{$barn->barnName}} @endif</option>
                                            @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                        <label for="totalCattleNum" class="col-sm-2 col-form-label text-right">牛头数</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="totalCattleNum" name="totalCattleNum">
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="totalWeight" class="col-sm-2 col-form-label text-right">总体重（kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="totalWeight" name="totalWeight">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="theoryIncome" class="col-sm-2 col-form-label text-right">理论收入（元）</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="theoryIncome" name="theoryIncome">
                                    
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="actualIncome" class="col-sm-2 col-form-label text-right">实际收入（元）</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="actualIncome" name="actualIncome">
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label for="PIC" class="col-sm-2 col-form-label text-right">责任人<span class="must-fill-in">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="PIC" name="PIC" required>
                                    </div>
                                </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-success justify-content-end" id="sell_batch_submit" type="submit">提交</button>
                        </div>
                    </form>
                    </div>
                <div class="card-footer">
                    说明：1、出售前的牛只可以提前集中到一个牛舍。选择牛舍号就可以。2、拼凑出售十几头的，牛号中间以英文逗号隔开，最后一个不需要逗号。
                        3、如果牛号多，可以在word中整理好，复制粘贴。

                </div>
                </div>
            </div>
        </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/sell_batch.js"></script>
<script type="text/javascript" src="/js/autohideerror.js"> </script>
@stop
