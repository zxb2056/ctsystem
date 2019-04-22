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
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>增加用户</strong></div>
                    </div>
                <div class="card-body ">
                    <form action='{{ url("/admin/users/{$adminUsers->id}/update")}}' method="POST" class="was-validated">
                    {{csrf_field()}}
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label">用户名</label>
                            <input type="text" class="form-control col-md-10" id="username" name="username" value="{{$adminUsers->username}}" required>
                        </div>
                        <div class="form-group row">
                            <label for="mobilePhone" class="col-md-2 col-form-label">手机号</label>
                            <input type="number" class="form-control col-md-10" id="mobilePhone" name="mobilePhone" value="{{$adminUsers->mobilePhone }}" required>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">邮箱</label>
                            <input type="email" class="form-control col-md-10" id="email" name="email" value="{{$adminUsers->email }}">
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">新密码</label>
                            <input type="password" class="form-control col-md-10" id="password" name="password"  required>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-md-2 col-form-label">确认密码</label>
                            <input type="password" class="form-control col-md-10" id="confirmPassword" name="password_confirmation" required>
                           
                       </div>
                @if(count($errors) >0)
                <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </div>
                @endif
                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-outline-success justify-content-end" type="submit" >提交</button>
                        </div>
                    </form>
                    </div>
                   
                <div class="card-footer d-flex justify-content-center">
       
</div>


                </div>

            </div>


        </div>
@stop


@section('js')

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

