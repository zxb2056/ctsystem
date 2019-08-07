@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>产犊登记</title>
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
        <a class="nav-link" href="{{url('/admin/manage/breed/mateInput')}}" >配种</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
    </li>
    <li class="nav-item">
      <a class="nav-link  active" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/aftercare')}}">产后护理</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/waitmate')}}">待配母牛表</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/fanzhidisease')}}">繁殖病症诊疗卡</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
    </li>
  </ul>
  @if(!empty(session('error')))
    <div class="alert alert-danger autohidereturn">
      {{session('error')}}
    </div>
  @endif
  @if(!empty(session('success')))
    <div class="alert alert-success autohidereturn">
      {{session('success')}}
    </div>
  @endif
<div class="card rounded-0 my-3">
                <div class="card-header">
                        <strong>产犊数据录入</strong>
                    
                </div>
                <div class="card-body table-responsive">

                <form action="{{url('/admin/manamge/breed/calv/calv_store')}}" method="post">
                  {{csrf_field()}}
                    <div class="form-group row">
                        <label for="cowID" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control form-control-sm" id="cowID" name="cowID" value="{{old('cowID')}}" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="calvDate" class="col-sm-2 col-form-label">产犊日期</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="calvDate"  name="calvDate"  @if(empty(old('calvDate'))) value="<?php echo date('Y-m-d'); ?>" @else value="{{old('calvDate')}}" @endif required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="calvStatus" class="col-sm-2 col-form-label">产犊状态</label>
                        <div class="col-sm-10">
                        <select class="custom-select" id="calvStatus" name="calvStatus" required>
                            <option value="">选择产犊状态</option>
                            <option value="正常" @if(old('calvStatus')=='正常') selected @endif>正常</option>
                            <option value="难产" @if(old('calvStatus')=='难产') selected @endif>难产</option>
                            <option value="早产" @if(old('calvStatus')=='早产') selected @endif>早产</option>
                            <option value="流产" @if(old('calvStatus')=='流产') selected @endif>流产</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="calvEarTag" class="col-sm-2 col-form-label">犊牛耳号</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="calvEarTag"  name="calvEarTag" value="{{old('calvEarTag')}}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="calvGender" class="col-sm-2 col-form-label">犊牛性别</label>
                        <div class="col-sm-10">
                          <select name="calvGender" id="calvGender" class="form-control" required>
                            <option value="公" @if(old('calvGender')=='公') selected @endif>公</option>
                            <option value="母" @if(old('calvGender')=='母') selected @endif>母</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="calvWeight" class="col-sm-2 col-form-label">出生重（kg）</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="calvWeight"  name="calvWeight" value="{{old('calvWeight')}}">
                          </div>
                        </div>
                      <div class="form-group row">
                        <label for="Deliveryer" class="col-sm-2 col-form-label">接产员</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Deliveryer"  name="Deliveryer" value="{{old('Deliveryer')}}" required>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                      </div>
                     
                </form>
            
               
                  </div>
                  <div class="card-footer">
            说明：流产的时候，不需要输入犊牛耳号，直接提交即可。
                  </div>
                  </div>
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/autohideerror.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#calvStatus").change(function(){
    var selectText = $("#calvStatus").find("option:selected").val()
    if(selectText == '流产'){
      $("#calvEarTag").attr("disabled",true)
      $("#calvEarTag").removeAttr("required")
    }else{
      $("#calvEarTag").attr("disabled",false)
    }
  })

})
</script>
@stop
