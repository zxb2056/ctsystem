@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>转舍登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
      <a class="nav-link" href="{{url('/admin/manage/feed/sell_batch')}}">整舍出售登记</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{url('/admin/manage/feed/change_barn')}}">转舍登记</a>
    </li>
 </ul>
<div class="card rounded-0 my-3">
  <div class="card-header d-flex">
    <h5><span><strong>单个转舍</strong></h5>

  </div>
  <div class="card-body form-row">
    <div class=" form-group col-md-2">
      <label for="leaveBarn">选择转出牛舍</label>
      <select name="barn" id="leaveBarn" placeholder="选择牛舍" class="form-control">
        @foreach($barns as $barn)
        <option value="{{$barn->id}}">@if($barn->id == '1') {{$barn->barnName}} @else {{$barn->barnID}} @endif </option>
        @endforeach
      </select>

    </div>
    <div class="form-group col-md-2">
      <label for="cattleID">选择牛只<span id="warncattle" hidden="hidden" class="ml-4 text-danger">*必填</span></label>
      <input type="text" id="inputCattle" class="form-control" name="cattleID" onkeyup="showHint(event,this.value)"
        placeholder="搜索牛号">
      <select name="associate_cattleID" id="associate_cattleID" placeholder="选择牛只" class="form-control mt-1"
        multiple="multiple" size="10">

      </select>
    </div>
    <div class=" form-group col-md-2">
      <label for="enterBarn">选择转入牛舍</label>
      <select name="barn" id="enterBarn" placeholder="选择牛舍" class="form-control">
        @foreach($reverseBarns as $barn)
        <option value="{{$barn->id}}">@if($barn->id == '1') {{$barn->barnName}} @else {{$barn->barnID}} @endif </option>
        @endforeach
      </select>
    </div>
    <div class=" form-group col-md-2">
      <label for="reason">转舍原因<span id="changeReason" hidden="hidden" class="ml-4 text-danger">*必填</span></label>
      <input type="text" name="barn" id="reason" data-label="changeReason" class="form-control"
        onkeyup="hiddenwarn(this)">
    </div>
    <div class=" form-group col-md-2">
      <label for="changeDay">转舍日期<span id="changeDaywarn" hidden="hidden" class="ml-4 text-danger">*必填</span></label>
      <input type="datetime-local" name="changeDay" id="changeDay" data-label="changeDaywarn" class="form-control" value="<?php echo date("Y-m-d") ?>"  onkeyup="hiddenwarn(this)">
    </div>
    
    <div class=" form-group col-md-2">
      <label for="personinCharge">负责人</label>
      <select name="PIC" id="personinCharge" class="form-control">
        @foreach($staffs as $staff)
        <option value="{{$staff->id}}">{{$staff->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-1">
      <label for="submit">submit</label>
      <input type="submit" class="btn btn-outline-primary form-control" id="submit" value="提交">
    </div>
  </div>
  <div class="card-footer">
    说明：可以按ctrl或shift进行多选，以点选变色为准。必须点选，在搜索框中提交无效。
  </div>
</div>

<div class="card rounded-0 my-3">
  <div class="card-header d-flex">
    <h5><span><strong>整舍迁移</strong></h5>

  </div>
  <form action="{{url('/admin/manage/feed/cattle_barn/changebar/wholeMigration')}}" method="post" class="needs-validation" novalidate>
    {{csrf_field()}}
    <div class="card-body form-row">
      <div class=" form-group col-md-2">
        <label for="whole_leaveBarn">选择转出牛舍</label>
        <select name="leaveBarn" id="whole_leaveBarn" placeholder="选择牛舍" class="form-control" required>
          @foreach($barns as $barn)
          <option value="{{$barn->id}}">@if($barn->id == '1') {{$barn->barnName}} @else {{$barn->barnID}} @endif
          </option>
          @endforeach
        </select>

      </div>
      <div class=" form-group col-md-1 ">
        <label class="invisible">=====></label>
        <div class="d-none d-lg-block text-center">

          <i class="fa fa-long-arrow-right fa-2x text-info " aria-hidden="true"></i>
        </div>
      </div>
      <div class=" form-group col-md-2">
        <label for="whole_enterBarn">选择转入牛舍</label>
        <select name="enterBarn" id="whole_enterBarn" placeholder="选择牛舍" class="form-control" required>
          @foreach($reverseBarns as $barn)
          <option value="{{$barn->id}}">@if($barn->id == '1') {{$barn->barnName}} @else {{$barn->barnID}} @endif
          </option>
          @endforeach
        </select>
      </div>
      <div class=" form-group col-md-2">
        <label for="whole_reason">转舍原因</label>
        <input type="text" name="reason" id="whole_reason" data-label="changeReason" class="form-control"
         required>
      </div>
      <div class=" form-group col-md-2">
        <label for="changeDay">转舍日期</label>
        <input type="date" name="changeDay" id="whole_changeDay" data-label="changeDaywarn" class="form-control"
           value="<?php echo date("Y-m-d") ?>" required>
      </div>
      <div class=" form-group col-md-2">
        <label for="inCharge">负责人</label>
        <select name="PIC" id="whole_inCharge" class="form-control">
          @foreach($staffs as $staff)
          <option value="{{$staff->id}}">{{$staff->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="submit">submit</label>
        <input type="submit" class="btn btn-outline-primary form-control" id="submit" value="提交">
      </div>
    </div>
  </form>
  <div class="card-footer">
    说明：如果是两舍都转，可以先把一舍牛转到虚拟牛舍。
  </div>

</div>
</div>
</div>




@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/change_barn.js"></script>
@stop