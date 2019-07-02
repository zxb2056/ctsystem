@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>饲料转化率明细页</title>
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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">首页</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/growth">生产性能测定</a></li>
    <li class="breadcrumb-item"><a href="/admin/manage/performance/feed_conversion">饲料转化率</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$experiName->experimentName}}</li>
  </ol>
</nav>
<div class="card rounded-0 my-3 ">
<div class="card-header d-flex">
    <h4 class="text-center"><strong>{{$experiName->experimentName}}</strong></h4> 
    <a  href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#closeExperiModal" >结束实验</a>
</div>
    <div class="card-body">
    <div class="d-flex">
    <span class="mr-4 p-1"><strong>实验组信息</strong></span><span class="mx-1 p-1">开始日期：{{$experiName->startDate}}</span><span class="mx-1 p-1">开始牛头数：{{$experiName->cattle_quantity}}</span>
    <span class="mx-1 p-1">开始总体重：{{$experiName->startWeight}}kg</span><span class="mx-1 p-1">精料配方：{{$experiName->concentrate}}</span>
    </div>
    <div class="row mt-5">
        <div class="col-md-6  ">
        <h6 class="text-center my-2"><strong>精料用量记录</strong></h6>
        <form action="{{url('/admin/manage/performance/feed_conversion/experi/feedRecord_add')}}" method="post">
        {{csrf_field()}}
        @if($experiName->grouporSingle==0)
            <div class="form-group form-row ">
                                <label for="cattleName" class="col-md-3 col-form-label">牛只信息</label> 
                            <div class="col-md-7">
                            <input type="hidden" id="experiment_id" name="experiment_id" value="{{ $experiName->id }}">
                            <input  type="text" class="form-control" id="cattleName" name="cattleName" value="全部牛只"  readonly> 
                            </div>
        </div>
  
        @else
        <div class="form-group form-row ">
                                <label for="cattleName" class="col-md-3 col-form-label">牛耳号</label> 
                            <div class="col-md-7">
                            <input type="hidden" id="experiment_id" name="experiment_id" value="{{ $experiName->id }}">
                            <input  type="text" class="form-control" id="cattleName" name="cattleName" value="{{old('cattleName')}}"> 
                            </div>
        </div>
        @endif

        <div class="form-group form-row ">
                            <label for="days" class="col-md-3 col-form-label">日&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp期</label> 
                            <div class="col-md-7">
                            <input  type="date" class="form-control" id="days" name="days" value="<?php echo date('Y-m-d'); ?>" required> 
                            </div>
        </div>
        <div class="form-group form-row ">
                            <label for="feedAmount" class="col-md-3 col-form-label">精料用量</label> 
                            <div class="col-md-7">
                            <input  type="number" class="form-control" id="feedAmount" name="feedAmount" value="{{old('feedAmount')}}" required> 
                            </div>
        </div>
        <div class="form-group form-row">
        <div class="col-md-3"></div>
            <div class="col-md-7">
                                @if(count($errors) >0)
                                <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                                </div>
                                @endif
            <input  type="submit" class="btn btn-sm btn-outline-success form-control">
            </div>
        </div>
        </form>
        @if(!empty(session('failure')))
        　　<div class="alert alert-danger" role="alert">
        　　　　{{session('failure')}}
        　　</div>
            @endif
        </div>

    </div>
    </div>


</div>
<hr>
<div class="card rounded-0 my-3 ">
<div class="card-header d-flex">
    <h5 class="text-center"><strong>每日饲喂量明细</strong></h5> 
    
</div>
<div class="card-body table-responsive">
              
              <table class="table table-hover border">
                    <thead>
                            <tr>
                                <th>序号</th>
                                <th>牛只信息</th>
                                <th>饲喂日期</th>
                                <th>饲喂量</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($feedRecords as $feedRecord)
                        <tr>
                        <td>{{ (($feedRecords->currentPage() - 1 ) * $feedRecords->perPage() ) + $loop->iteration}}</td>
                        <td>{{$feedRecord->cattleName}}</td>
                        <td>{{$feedRecord->days}}</td>
                        <td>{{$feedRecord->feedAmount}}</td>
                        <td>编辑</td>
                        </tr>
                        @endforeach
                        </tbody>
</table>
</div>
<div class="card-footer d-flex justify-content-center">
           {{$feedRecords->links()}}
</div>
</div>

<!-- listModal -->
<div class="modal fade" id="closeExperiModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">关闭实验</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>关闭实验</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/performance/feed_conversion/closeExperiment" method="POST" class="was-validated" >
                    {{ csrf_field() }}
                        <div class="form-group row" id="experiname">
                            <label for="licensePlate" class="col-sm-3 col-form-label">实验名称</label>
                            <div class="col-md-9">
                            <input type="hidden" id="experiment_id" name="id" value="{{ $experiName->id }}">
                            <input type="text" id="experiment_name" value="{{$experiName->experimentName}}"  class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  for="endDate" class="col-md-3 col-form-label">结束日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="endDate" name="endDate" required>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_quantity" class="col-sm-3 col-form-label">结束牛头数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="end_quantity" name="end_quantity" required>
                            </div>
                        </div>
                        @if($experiName->grouporSingle==0)
                        <div class="form-group row">
                            <label for="endWeight" class="col-sm-3 col-form-label">结束总体重</label>
                            <div class="col-sm-9">
                                <input type="string" class="form-control" id="endWeight" name="endWeight" required>
                            </div>
                        </div>
                        @endif
                                                
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
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
<script type="text/javascript" src="/js/checkfeedrecord.js"></script>

@stop
