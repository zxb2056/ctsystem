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
                    <div class="mr-auto"><strong>用户所属角色</strong></div>
                </div>
                @if(!empty(session('success')))
            　　<div class="alert alert-success" role="alert">
            　　　　{{session('success')}}
            　　</div>
                @endif
        <form action="/admin/users/{{ $user->id }}/role" method="post">
        {{csrf_field()}}
                <div class="card-body">
                @foreach($roles as $role)
                <div class="form-check py-1 my-1">
                    <input class="form-check-input" type="checkbox" value="{{ $role->id }}"  @if($myRoles->contains($role)) checked @endif name="roles[]">
                    <label class="form-check-label" for="sys-manager" >
                        {{ $role->name }}
                    </label>
                    </div>
                @endforeach
                  

                    </div>
<div class="card-footer">
   <button class="btn btn-outline-success" type="submit"> 提交</button>    
</div>
</form>

                </div>

            </div>


        </div>
@stop


@section('js')

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

