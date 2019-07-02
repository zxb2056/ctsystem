@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>异常信息</title>
<style>
table i{
    cursor:pointer;
}
thead td:hover{
    cursor:pointer;
    color:red;
    
}
thead td{
    font-weight:bold;
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
<div class="container">
    <div class="row">
        <h5 class="text-center my-4">错误信息提示</h5>
        <div class="alert alert-danger">
            {{$errors}}
        </div>
    </div>



</div>
  
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/cattleinput.js"></script>
<script type="text/javascript" src="/js/resetinput.js"></script>

@stop
