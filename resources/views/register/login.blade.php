@extends('layouts.main')

@section('title')
辰涛牧业主页
@stop

@section('specss')
@parent
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/login.css">
@stop

@section('actIndex')

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
                   <span class="h6">用户登陆</span> 
                </div>
                <div class="card-body">
                    <form action="{{url('/login')}}" method="POST">
                    {{csrf_field()}}
                        <div class="form-group row">
                            <label for="phone" class="col-md-3 col-form-label">手机号 </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="phone" placeholder="手机号" name="mobilePhone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-3 col-form-label">密码</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="rememberme" name="is_remember" value="1">
                        <label class="form-check-label" for="rememberme">记住我</label>
                        </div>

                @if(count($errors) >0)
                <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </div>
                @endif

                </div>
                <div class="card-footer d-flex">
                    <button type="submit" class="btn btn-outline-primary">登陆</button>
                    <button type="button" class="btn btn-link mr-auto"><small>忘记密码？</small></button>
                    <button type="button" class="btn btn-link"><small>没有账号？注册</small></button>

                </div>
               
                </div>
                </form>
            </div>
        </div>
        <p class="text-center mt-5">第三方账号登录</p>
<div class="row justify-content-center">

<div class="d-flex justify-content-center my-4">

<span>微信</span><a href="#" class="mx-4 text-info"><i class="fa fa-weixin fa-2x" aria-hidden="true"></i></a>
<span>QQ</span><a href="#" class="mx-4"><i class="fa fa-qq fa-2x" aria-hidden="true"></i></a>
<span>微博</span><a href="#" class="mx-4 text-danger"><i class="fa fa-weibo fa-2x" aria-hidden="true"></i></a>
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