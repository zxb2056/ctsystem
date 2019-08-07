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
          <a class="nav-link active" href="{{url('/admin/manage/feed/eliminate_ledger')}}">淘汰记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/sell_ledger')}}">出售记录</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/feed/change_barn_history')}}">转舍记录</a>
        </li>
    </ul>
    <ul class="nav nav-tabs bg-light mt-3">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/feed/eliminate_ledger')}}">按批次</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/feed/eliminate_ledger/accordCattle')}}">按牛号</a>
          </li>
          <li class="nav-item">
                <a class="nav-link  active" href="{{url('/admin/manage/feed/eliminate_ledger/accordCattle')}}">批次信息</a>
        </li>
    </ul>
<table class="table table-bordered mt-2">
    <thead>
        <tr>
                <th>批次</th>
                <th>淘汰日期</th>
                <th>淘汰牛数</th>
                <th>原因</th>
                <th>淘汰去向</th>
                <th>购买者性质</th>
                <th>购买者名称</th>
                <th>购买者手机</th>
                <th>总重量</th>
                <th>收入</th>
                <th>负责人</th>
                <th>说明</th>
              </tr>
        </thead>
        <tbody>
                <tr>
                    <td><a href="/admin/manage/feed/eliminate/elimiOrder/{{$batch->elimiOrder}}">{{$batch->elimiOrder}}</a></td>
                        <td>{{$batch->elimiDay}}</td>
                        <td>{{$batch->totalNum}}</td>
                        <td>{{$batch->reason}}</td>
                        <td>{{$batch->toWhere}}</td>
                        <td>{{$batch->buyerAttribute}}</td>
                        <td>{{$batch->buyerName}}</td>
                        <td>{{$batch->buyerPhone}}</td>
                        <td>{{$batch->totalWeight}}</td>
                        <td>{{$batch->Income}}</td>
                        <td>{{$batch->PIC}}</td>
                        <td>{{$batch->note}}</td>
                      </tr>
        </tbody>
</table>
<h5 class="mt-2"> 本批次共有{{$batch->totalNum}}头牛,详细如下:</h5>
<table class="table table-bordered mt-2">
        <thead>
            <tr>
                    <th>序号</th>
                    <th>牛号</th>
                    <th>性别</th>
                    <th>淘汰日龄</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($cattles as $cattle)
                    <tr>
                            <td>{{(($cattles->currentPage()-1)*$cattles->perPage()) + $loop->iteration}}</td>
                            <td>{{$cattle->cattleID}}</td>
                            <td>{{$cattle->gender}}</td>
                            <td>{{$cattle->dayAgeOfSold}}</td>
                          </tr>
                @endforeach
            </tbody>
    </table>
    <div class="card-footer d-flex justify-content-center">
        {{$cattles->links()}}
    </div>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/sell_batch.js"></script>
<script type="text/javascript" src="/js/autohideerror.js"> </script>
@stop
