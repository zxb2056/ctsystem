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
    <div class="card-header">
        <strong class="h5 mr-4">权限列表</strong>
        <button type="button" class="btn btn-sm btn-outline-primary ml-5" data-toggle="modal" data-target="#ADDModal"
                        data-title="新增角色">新增权限</button>
    </div>
    <div class="card-body ">
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>权限名称</th>
                    <th>权限描述</th>
                     <th>操作</th>

                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ (($permissions->currentPage() - 1 ) * $permissions->perPage() ) + $loop->iteration}}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <button type="button"  class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#updateModal"
                         data-id="{{$permission->id}}"   data-name="{{ $permission->name }}" data-description="{{$permission->description }}">编辑</button>
                    </td>
                </tr>
                @endforeach
               
            </tbody>
   
        </table>
    </div>
<div class="d-flex justify-content-center">
            {{ $permissions->links() }}
</div>
    <div class="card-footer">
       说明：不提供删除权限的操作，通过删除用户来达到目的。
    </div>
    </div>
<!-- ADDModal -->
<div class="modal fade" id="ADDModal" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">添加权限</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>权限信息</strong>

                    </div>
                    <form action="{{ asset('/admin/permissions/store')}}" method="POST" class="was-validated">
                    {{csrf_field()}}
                        <div class="card-body ">

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">权限名字</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">权限描述</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" rows="4" name="description" required></textarea>
                                </div>
                            </div>
                        </div>
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
<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">权限更新</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>权限信息</strong>

                    </div>
                    <form action="{{ asset('/admin/permissions/id/update')}}" method="POST">
                    {{csrf_field()}}
                        <div class="card-body ">
                            <input type='hidden' id='permissionid' name="id" >
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">权限名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">权限描述</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" name="description" rows="3">

                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                        </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@stop


@section('js')
<script>
$('#updateModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var name=button.data('name')
  var description=button.data('description')
  var modal = $(this)
  modal.find('.modal-title').text('更新' + name +'信息')
  modal.find('.modal-body #name').val(name)
  modal.find('.modal-body #description').val(description)
  modal.find('.modal-body #permissionid').val(id)
})
</script>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

