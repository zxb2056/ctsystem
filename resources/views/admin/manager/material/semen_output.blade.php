@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>冻精出库</title>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light mb-4">
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/material/semen_input')}}">冻精入库登记</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{url('/admin/manage/material/semen_output')}}">冻精出库登记</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        冻精台帐
    </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{url('/admin/manage/material/semen/store_ledger')}}"><small>冻精入库台帐</small></a>
            <a class="dropdown-item" href="{{url('/admin/manage/material/semen/out_ledger')}}"><small>冻精出库台帐</small></a>
            <a class="dropdown-item" href="{{url('/admin/manage/material/semen/broke_ledger')}}"><small>冻精损坏明细</small></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('/admin/manage/breed/mate_ledger')}}"><small>配种记录</small></a>
    </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/material/semen_remain')}}">冻精库存</a>
    </li>
    
  </ul>
  @if(!empty(session('error')))
  　　<div class="alert alert-danger" role="alert">
  　　　　{{session('error')}}
  　　</div>
  @endif
  @if(!empty(session('success')))
  　　<div class="alert alert-success" role="alert">
  　　　　{{session('success')}}
  　　</div>
  @endif
  <div class="card rounded-0 my-3">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-link btn-sm text-dark " type="button" >
            <strong>冻精出库登记</strong>
          </button>
        </h2>
      </div>
      <div class="card-body">
      <form action="/admin/manage/material/semen_output" method="post">
        {{csrf_field()}}
            <div class="form-group row">
              <label for="semen_id" class="col-sm-2 col-form-label">冻精号</label>
              <div class="col-sm-10">
                  <select name="semen_id" id="semen_id" class="form-control" required>
                      <option value="">选择冻精号</option>
                      @foreach($semens as $semen)
                      <option value="{{$semen->semen_id}}" data-remain="{{$semen->remain}}" @if($semen->id == old('semen_id')) selected @endif>{{$semen->linksemen->semenNum}}</option>
                      @endforeach
                  </select>
                  <div>
                  <small class="text-danger" id="alert-remain" style="display:none;">该冻精号目前库存数量为：<span id="return-remain"></span></small>
                  </div>
              </div>
            </div>

            <div class="form-group row">
                <label for="outDay" class="col-sm-2 col-form-label">出库时间</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="outDay"  name="outDay" value=<?php echo date('Y-m-d');?> required>
                </div>
              </div>
              <div class="form-group row">
                  <label for="semenAmount" class="col-sm-2 col-form-label">出库数量</label>
                  <div class="col-sm-10">
                  <input type="number" class="form-control" id="semenAmount"  name="amount" required value="{{old('amount')}}">
                  </div>
                </div>
                
                    <div class="form-group row">
                        <label for="PIC" class="col-sm-2 col-form-label">库管员</label>
                        <div class="col-sm-10">
                          <select name="PIC" id="PIC" class="form-control" required>
                            @foreach($staffs as $staff)
                          <option value="{{$staff->id}}">{{$staff->name}}&nbsp {{$staff->telephone}}</option>
                            @endforeach
                          </select>

                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="user" class="col-sm-2 col-form-label">领物人</label>
                            <div class="col-sm-10">
                              <select name="user" id="user" class="form-control" required>
                                @foreach($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->name}}&nbsp {{$staff->telephone}}</option>
                                @endforeach
                                </select>
    
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

          
 
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){
  $("#semen_id").change(function(){
    var remain=$('#semen_id').find("option:selected").attr("data-remain")
    $("#return-remain").html(remain)
    $("#alert-remain").show()

  })
 })
</script>
@stop
