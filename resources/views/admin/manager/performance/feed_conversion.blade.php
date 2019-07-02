@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('title')
<title>育肥性状测定</title>
@stop
@section('css')
<style>
.experiments{
    display:inline-block;
    width:150px;
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
    <a class="nav-link" href="{{url('/admin/manage/performance/growth')}}">生长发育性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/fatten')}}">育肥性状测定</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="{{url('/admin/manage/performance/feed_conversion')}}">饲料转化率</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/carcass')}}">胴体性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/meat_quality')}}">肉质性状</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/report')}}">测定报告</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/performance/query&update')}}">数据库查询修改</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{asset('/file/NYT 2660-2014 肉牛生产性能测定技术规范.pdf')}}">生产性能测定技术规范</a>
  </li>
</ul>
<div class="fluid-container">
    <div class="row my-4">
        <div class="col-md-9">
        <h5>实验组情况</h5>
        <p>目前共存在{5}个饲料转化率实验组,进行中的2个，已经完成的3个</p>
        <div class="row">
        <div class="col-md-2"><h6>进行中的实验组：</h6></div>
        <div class="col-md-10">
        @foreach($experimentings as $experiment)
            
            <a href='{{url("/admin/manage/performance/feed_conversion/experi/{$experiment->id}")}}' class="mx-2 my-2 experiments" >{{$experiment->experimentName}}</a>
            
        @endforeach
          </div>
        </div>
        <div class="row">
        <div class="col-md-2"><h6>已完成的实验组：</h6></div>
        <div class="col-md-10">
        @foreach($experimented as $experi)
            <a href='{{url("/admin/manage/performance/feed_conversion/experi_done/{$experi->id}")}}' class="mx-2 my-2 experiments" >{{$experi->experimentName}}</a>
        @endforeach
        </div>
        </div>
        <div class="row mt-5">
        <div class="col">
        <p>建议实验组命名规范：开始时间加上精料名称，如190511玉米豆粕。代表2019年5月11日开始的玉米豆粕精饲料实验</p>
        </div>
       
        </div>
        </div>
        <div class="col-md-3">
        <div class="text-right border">
        <h5 class="text-left">新建实验组</h5>
        <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#groupfeedConversionModal">新建群体实验组</a>
        <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#singlefeedConversionModal">新建个体实验组</a>
        </div>
        </div>
    </div>


     
</div>


<!-- listModal -->
<div class="modal fade" id="groupfeedConversionModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增群体实验组</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增群体实验组</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/performance/feed_conversion/plusexperiment" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="experiname" class="col-sm-3 col-form-label">实验组名字</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="experiname" name="experimentName" required>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="startDate" class="col-sm-3 col-form-label">开始时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="startDate" name="startDate" >
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="cattle_quantity" class="col-sm-3 col-form-label">开始牛只数量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cattle_quantity" name="cattle_quantity">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="startWeight" class="col-sm-3 col-form-label">开始总重</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="startWeight" name="startWeight">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="concentrate" class="col-sm-3 col-form-label">精料配方</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="concentrate" name="concentrate">
                            </div>
                        </div>
                        <input type="hidden" id="grouporSingle" name="grouporSingle" value="0">
                                               
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
<!-- singleModal -->
<div class="modal fade" id="singlefeedConversionModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">精确个体实验组</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>精确个体实验组</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/performance/feed_conversion/plusexperiment" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="singleexperiname" class="col-sm-3 col-form-label">实验组名字</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="singleexperiname" name="experimentName" required>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="singlestartDate" class="col-sm-3 col-form-label">开始时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="singlestartDate" name="startDate" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="singlecattle_quantity" class="col-sm-3 col-form-label">开始牛只数量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="singlecattle_quantity" name="cattle_quantity">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="singleconcentrate" class="col-sm-3 col-form-label">精料配方</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="singleconcentrate" name="concentrate">
                            </div>
                        </div>
                        <input type="hidden" id="singlegrouporSingle" name="grouporSingle" value="1">
                                               
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

@stop
