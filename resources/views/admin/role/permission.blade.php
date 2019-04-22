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
            @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
        　　　　{{session('success')}}
        　　</div>
            @endif
                <div class="card-header d-flex">
                    <div class="mr-auto"><strong>角色拥有的权限</strong></div>
                </div>
        <form action='{{ url("/admin/roles/{$role->id}/permission")}}' method="post">
        {{csrf_field()}}
                <div class="card-body">
                @foreach($permissions as $permission)
                <div class="form-check py-1 my-1">
                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"  @if ($myPermissions->contains($permission)) checked @endif name="permissions[]">
                    <label class="form-check-label" for="sys-manager" >
                        {{ $permission->name }}
                    </label>
                    </div>
                @endforeach
     @include('admin-layouts.error-alert')       

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

