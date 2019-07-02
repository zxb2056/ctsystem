@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>冻精入库</title>
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
      <a class="nav-link active" href="{{url('/admin/manage/material/semen_input')}}">冻精入库登记</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/material/semen_output')}}">冻精出库登记</a>
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
  @if(!empty(session('success')))
  　　<div class="alert alert-success" role="alert">
  　　　　{{session('success')}}
 @if(!empty(session('hadSemen')) && session('hadSemen')->pedigreeStatus == '0')
  <p class="pl-5 ml-5">建议及时完善公牛系谱信息,以方便使用.<a href="/admin/manage/basic/cattle-pedigree">点击去完善</a></p>
  @endif
  　　</div>
  @endif
  <div class="card rounded-0 my-3">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-link btn-sm text-dark " type="button" >
            <strong>冻精入库登记</strong>
          </button>
        </h2>
          
      </div>

      <div class="card-body">
      <form action="/admin/manage/material/semen_input" method="post">
        {{csrf_field()}}
            <div class="form-group row">
              <label for="dongjinghao" class="col-sm-2 col-form-label">冻精号</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="dongjinghao"  name="semenNum" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="breedType" class="col-sm-2 col-form-label">品种</label>
              <div class="col-sm-10">
                <select name="breed" id="breedType" class="form-control">
                  @foreach($breeds as $breed)
                <option value="{{$breed->id}}">{{$breed->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="frozenType" class="col-sm-2 col-form-label">是否性控</label>
              <div class="col-sm-10">
                  <select name="frozenType" id="frozenType" class="form-control">
                    <option value="普精">普精</option>
                    <option value="性控">性控</option>
                    </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="semen_company" class="col-sm-2 col-form-label">所属公司</label>
              <div class="col-sm-10">
                <select name="company" id="semen_company" class="form-control">
                @foreach($companys as $company)
                <option value="{{$company->id}}">{{$company->companyName}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
                <label for="storedDay" class="col-sm-2 col-form-label">入库时间</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="storedDay"  name="storedDay" value=<?php echo date('Y-m-d');?>>
                </div>
              </div>
              <div class="form-group row">
                  <label for="semenAmount" class="col-sm-2 col-form-label">入库数量</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="semenAmount"  name="mount" required>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">单价</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="price"  name="price">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="totalSum" class="col-sm-2 col-form-label">总金额</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="totalSum"  name="totalSum">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="PIC" class="col-sm-2 col-form-label">负责人</label>
                        <div class="col-sm-10">
                          <select name="PIC" id="PIC" class="form-control">
                            @foreach ($staffs as $staff)
                          <option value="{{$staff->id}}">{{$staff->name}}&nbsp{{$staff->telephone}}</option>  
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
<script type="text/javascript" src="/js/semen_input.js"></script>
@stop
