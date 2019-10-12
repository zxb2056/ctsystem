@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>检疫记录输入</title>
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
                        <div class="mr-auto"><strong>检疫记录</strong></div>
                </div>
                
                                <div class="card-body ">
                                        <form action="/admin/manage/Veterinary/Quarantine_store" method="post" onkeydown="if(event.keyCode==13)return false;" >
                                          {{csrf_field()}}
                                                <div class="form-group row">
                                                  <label for="cattleID" class="col-sm-3 col-form-label">牛号</label>
                                                  <div class="col-sm-9">
                                                      <input type="text" class="form-control form-control-sm" id="cattleID" name="cattleID" required>
                                                    <div class="check-feedback text-danger" hidden> </div>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label for="quarantine_day" class="col-sm-3 col-form-label">检疫日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="quarantine_day" name="quarantine_day" required>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="quarantine_disease" class="col-sm-3 col-form-label">检疫病种</label>
                                                        <div class="col-sm-7">
                                                                <select class="custom-select" name="quarantine_disease" id="quarantine_disease" required>
                                                                  <option value="">选择疫病种类</option>
                                                                  @foreach($epidemics as $e)
                                                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                                                  @endforeach
                                                                    </select>
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#plusEpidemicModal"> 添加疫病</button>
                                                      </div>
                                                <div class="form-group row">
                                                        <label for="quaran_method" class="col-sm-3 col-form-label">检疫方式</label>
                                                        <div class="col-sm-9">
                                                                <select class="custom-select" name="quaran_method" id="quaran_method" required>
                                                                        <option value="">选择方式</option>
                                                                        <option value="皮内">皮内</option>
                                                                        <option value="皮下">皮下</option>
                                                                        <option value="血检">血检</option>
                                                                        <option value="肌注">肌注</option>
                                                                        <option value="组织">组织</option>
                                                                    </select>
                                                        </div>
                                                      </div>
                                                    
                                                      <div class="form-group row">
                                                            <label for="quaran_addr" class="col-sm-3 col-form-label">检疫地点</label>
                                                            <div class="col-sm-9">
                                                              <input type="text"  class="form-control" id="quaran_addr" name="quaran_addr" placeholder="牧场内或实验室所在地" >
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="result" class="col-sm-3 col-form-label">检疫结果</label>
                                                                <div class="col-sm-9">
                                                                    
                                                                  <select class="custom-select" name="result" id="result" required>
                                                                      <option value="-">阴性</option>
                                                                      <option value="+">阳性</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="form-group row">
                                                                    <label for="pic" class="col-sm-3 col-form-label">责任人</label>
                                                                    <div class="col-sm-9">
                                                                      <input type="text" class="form-control" id="pic" name="pic" >
                                                                    </div>
                                                                  </div>
                                  </div>
                                  <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                                      </div>
                                  </div>
                                </form>
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
                    <input type="text" class="form-control" id="name"  name="name" required>
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
<script>
    $(document).ready(function(){
        $("#cattleID").keyup(
          delay(function (e) {
          var cattleID = this.value
          checkCattle(cattleID)
      }, 1000)
     )
    })
    </script>
<script src="/js/autohideerror.js"></script>
<script src="/js/check_cattle.js"></script>
@stop
