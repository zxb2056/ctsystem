@extends('layouts.main')

@section('title')
辰涛牧业主页
@stop

@section('specss')
@parent
<link rel="stylesheet" href="/css/login.css">
@stop

@section('actIndex')
active
@stop

@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

@section('content')
<div class="container main">
        <div class="row my-5 justify-content-center">
            <div class="card csize">
                <div class="card-header">
                    用户注册
                </div>
                <div class="card-body">
                    <form action="{{url('/register')}}" method="POST" >
                    {{csrf_field()}}
                        <div class="form-group form-row">
                            <label for="username" class="col-md-4 col-form-label">用户名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" placeholder="注册个昵称" name="name">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="phone" class="col-md-4 col-form-label">手机号 </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="phone" placeholder="phone" name="mobilePhone">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="sjyzm" class="col-md-4 col-form-label">手机验证码</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sjyzm" placeholder="验证码">
                            </div>
                            <div class="col-sm-4">
                                <input type="button" class="btn btn-outline-secondary" name="sjyzm" id="yzphone" value="获取手机验证码"
                                    onClick="sendMessage()" />
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="inputPassword" class="col-md-4 col-form-label">密码</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="inputPassword" class="col-md-4 col-form-label">确认密码</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password_confirmation">
                            </div>
                        </div>

                    

                </div>
                <div class="card-footer d-flex">
                    <button type="submit" class="btn btn-outline-primary mr-auto">注册</button>
                   
                    <button type="button" class="btn btn-link"><small>没有账号？注册</small></button>


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
        </div>


    </div>

    </div>

    </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop

    @section('js')
      <script src="{{ asset('/js/login.js')}}"></script>
    @stop