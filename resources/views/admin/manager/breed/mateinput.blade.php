@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>配种记录</title>
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
        <a class="nav-link active" href="{{url('/admin/manage/breed/mateInput')}}" >配种</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
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
      <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
    </li>
  </ul>
    @if(!empty(session('success')))
　　<div class="alert alert-success autohidereturn" role="alert">
　　　　{{session('success')}}
　　</div>
    @endif
    @if(!empty(session('error')))
　　<div class="alert alert-danger autohidereturn" role="alert">
　　　　{{session('error')}}
　　</div>
    @endif
<div class="accordion" id="matecollapse">
<div class="card rounded-0 my-3">
                <div class="card-header">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-sm text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" >
                      <strong>配种数据录入</strong>
                    </button>
                  </h2>
                    
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#matecollapse">
                <div class="card-body table-responsive">

                <form action="/admin/manage/breed/mate_record" method="post">
                  {{csrf_field()}}
                    <div class="form-group row">
                        <label for="cowID_" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control form-control-sm" id="cowID" name="cowID" value="{{old('cowID')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="semenNum" class="col-sm-2 col-form-label">冻精号</label>
                        <div class="col-sm-10">
                          <select name="semen_id" id="semenNum" class="form-control">
                            @foreach ($semens as $semen)
                              <option value="{{$semen->semen_id}}" @if($semen->semen_id == old('semen_id')) selected @endif>{{$semen->linksemen->semenNum}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="useAmount" class="col-sm-2 col-form-label col-form-label-sm">使用剂量</label>
                          <div class="col-sm-10">
                              <select name="useAmount" id="useAmount" class="form-control">
                                <option value="1" @if(old('useAmount')=='1') selected @endif>1支</option>
                                <option value="2" @if(old('useAmount')=='2') selected @endif>2支</option>
                                <option value="2" @if(old('useAmount')=='3') selected @endif>3支</option>
                              </select>
                          </div>
                        </div>
                      <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">配种日期</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="date"  name="mateDate" @if(empty(old('mateDate'))) value="<?php echo date('Y-m-d'); ?>" @else value="{{old('mateDate')}}" @endif>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="matetime" class="col-sm-2 col-form-label">配种时间</label>
                        <div class="col-sm-10">
                          <input type="time" class="form-control" id="matetime"  name="mateTime" @if(empty(old('mateTime'))) value="<?php echo date('H:i'); ?>" @else value="{{old('mateTime')}}" @endif>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="PIC" class="col-sm-2 col-form-label">配种员</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="PIC"  name="PIC" value="{{old('PIC')}}">
                        </div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                      </div>
                     
                </form>
            
               
                  </div>
                  <div class="card-footer">
   
                  </div>
                  </div>
                </div>
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-sm text-dark collapsed" type="button" data-toggle="collapse" data-target="#semenBrokeRecord" >
                          <strong>冻精损坏登记</strong>
                        </button>
                      </h2>
                    </div>
                  <div id="semenBrokeRecord" class="collapse" data-parent="#matecollapse">
                      <div class="card-body">
                        <form action="/admin/manage/breed/semen_broke_record" method="post" class="needs-validation" novalidate>
                          {{csrf_field()}}
                          <div class="form-group">
                            <label for="brokeSemen">冻精号</label>
                            <select name="semen_id" id="brokeSemen" class="form-control">
                              <option value="">选择冻精号</option>
                              @foreach($semens as $semen)
                            <option value="{{$semen->id}}">{{$semen->semenNum}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="brokenDate">损坏日期</label>
                            <input type="date" name="brokeDate" id="brokenDate" value="<?php echo date('Y-m-d') ?>" class="form-control">
                          </div>
                          <div class="form-group ">
                            <label  class="mr-4">损坏原因</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input mx-2" id="baoGuan" value="爆管" name="reason" required>
                                <label class="form-check-label" for="baoGuan">爆管</label>
                                <input type="radio" class="form-check-input mx-2" id="checkactivity" value="检测活力" name="reason">
                            <label class="form-check-label" for="checkactivity">检测活力</label>
                            <input type="radio" class="form-check-input mx-2" id="other" value="其它" name="reason">
                            <label class="form-check-label" for="other">其它</label>
                           </div>
                          </div>
                          <div class="form-group">
                              <label for="note">备注说明</label>
                              <input name="note" id="note" class="form-control">

                            </div>
                           <div class="form-group">
                            <label for="PIC">负责人</label>
                            <input type="text" name="PIC" id="brokePIC" class="form-control" required>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script src="/js/autohideerror.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
@stop
