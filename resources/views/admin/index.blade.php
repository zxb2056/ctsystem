@extends('admin-layouts.admin-main')

@section('head')

    @include('admin-layouts.admin-head')

@stop


@section('topnav')

    @include('admin-layouts.admin-nav')

@stop

@section('sidebar')

    @include('admin-layouts.admin-sidebar')

@stop

@section('content')
    请根据自己需要，从左侧功能菜单中进入对应的界面。
    @show

@section('footer')
    @include('admin-layouts.admin-footer')
@stop
