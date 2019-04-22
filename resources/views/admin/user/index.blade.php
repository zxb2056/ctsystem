@extends('admin-layouts.admin-main')

@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')

@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop


@section('sidebar')

@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<div class="card rounded-0 my-3">
            @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
        　　　　{{session('success')}}
        　　</div>
            @endif
                <div class="card-header d-flex">
                    <div class="mr-5"><strong>用户列表</strong></div>
                    <button type="button" class="btn btn-sm btn-outline-primary ml-5" data-toggle="modal" data-target="#ADDModal"
                        data-name=""  data-title="新增角色">新增用户</button>

                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-body table-responsive">
                      
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>用户名</th>
                            <th>用户角色</th>
                            <th>操作</th>
                              
                        </tr>
                    </thead>
                    <tbody>
                    
                  @foreach($users as $user)
                        <tr>
                            <td> 1</td>
                            <td>{{$user->username}}</td>
                            <td>@if($user->isSuperAdmin == 1) 超级管理员@else
                            <a type="button" class="btn btn-sm" href='{{url("/admin/users/{$user->id}/role")}}'>角色管理</a> @endif
                            </td>
                           
                            <td class="d-flex" width="150">
                            @if($user->isSuperAdmin != 1) 
                            <a type="button"  href='{{ url("/admin/users/{$user->id}/edit")}}' class="btn btn-sm btn-outline-primary p-1 mx-1">编辑</a>
                           
                            <a type="button" href='{{ url("/admin/users/{$user->id}/delete")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm();">删除</a>
                            @endif
                            </td>
                        </tr>
                 @endforeach
                    </tbody>
    {{ $users->links()}}
          </table>
                    </div>
<div class="card-footer d-flex justify-content-center">
       
</div>


                </div>

            </div>


        </div>
    <!-- ADDModal -->
<div class="modal fade" id="ADDModal" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增用户</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>用户信息</strong>

                    </div>
                    <form action="{{ asset('/admin/users/store')}}" method="POST">
                    {{csrf_field()}}
                        <div class="card-body ">
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label">用户名</label>
                            <input type="text" class="form-control col-md-9" id="username" name="username" required>
                        </div>
                        <div class="form-group row">
                            <label for="mobilePhone" class="col-md-3 col-form-label">手机号</label>
                            <input type="number" class="form-control col-md-9" id="mobilePhone" name="mobilePhone" required>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label">邮箱</label>
                            <input type="email" class="form-control col-md-9" id="email" name="email">
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label">密码</label>
                            <input type="password" class="form-control col-md-9" id="password" name="password" required>
                        </div> 
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-md-3 col-form-label">确认密码</label>
                            <input type="password" class="form-control col-md-9" id="confirmPassword" name="password_confirmation" required>
                           
                       </div>
                @if(count($errors) >0)
                <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </div>
                @endif
                  <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                        </form>
                        <div>
                            
                        </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@stop


@section('js')
<script type="text/javascript">
        function disp_confirm()
        {
        var r=confirm("您确认要删除吗？")
       
        if (r==true)
            {
          
           return true;
            }
        else
            {
           return false;
            }
        }
</script>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

