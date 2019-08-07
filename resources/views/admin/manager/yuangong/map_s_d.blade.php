@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>设置员工所属部门</title>
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
    <a class="nav-link " href="{{url('/admin/manage/staff/staff_list')}}">员工列表</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/offWork')}}">请假</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/attendance')}}">考勤</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/partment')}}">部门管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" href="{{url('/admin/manage/staff/map_s_d')}}">设置员工部门</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/tmpworker')}}">临时用工</a>
  </li>
</ul>
@if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-danger">
    {{session('error')}}
  </div>
@endif
    <div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>设置员工所属部门</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <form action="/admin/manage/staff/stroe_map_s_d" method="POST">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-md-3">
                            <label for="#department">选择部门</label>
                            <select name="department-0" id="department-0" class="form-control" onchange="get_department(this)">
                                <option value="">选择部门</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->departName}}</option>
                                @endforeach
                            </select>
                        </div>
                           <div class="col-md-3">
                                <label for="#department">员工姓名</label>
                                <input type="hidden" name="staff_id" id="staff_id">
                                <input type="text" name="staff" id="staff" class="form-control">
                                <select name="" id="staff_select" class="form-control" style="display:none" multiple="multiple" SIZE="8">
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                    <label for="#department">岗位名称</label>
                                   <input type="text" id="position" name="position" class="form-control" requir>
                                </div>
                                <div class="col-md-1">
                                   <label for="" style="visibility:hidden;">提交按键</label>
                                   <button type="submit" class="btn btn-outlin-secondary form-control">提交</button>
                                </div>
                      </div>
                    </form>
                    @if(count($errors) >0)
                    <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                    </div>
                    @endif
                  </div>
            <div class="card-footer">
                说明：
            </div>
    </div>

      

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/get_department.js"></script>
<script type="text/javascript" src="/js/get_staff.js"></script>
@stop

