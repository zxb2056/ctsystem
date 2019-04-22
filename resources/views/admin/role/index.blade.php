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
    <div class="card-header">
        <strong class="h5 mr-4">角色列表</strong>
        <button type="button" class="btn btn-sm btn-outline-primary ml-5" data-toggle="modal" data-target="#ADDModal"
                        data-title="新增角色">新增角色</button>
    </div>
    <div class="card-body ">
            @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
        　　　　{{session('success')}}
        　　</div>
            @endif
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>角色名称</th>
                    <th>角色描述</th>
                    <th>拥有权限</th>
                     <th>操作</th>

                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ (($roles->currentPage() - 1 ) * $roles->perPage() ) + $loop->iteration}}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td><a type="button" class="btn btn-sm" href="/admin/roles/{{$role->id}}/permission">权限管理</a></td>
                    <td>
                        <button type="button"  class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#updateModal"
                         data-id="{{$role->id}}"   data-name="{{ $role->name }}" data-description="{{$role->description }}">编辑</button>
                        <a type="button" href='{{asset("/admin/roles/{$role->id}/delete")}}' onclick="return disp_confirm();" class="btn btn-sm btn-outline-primary">删除</a>
                    </td>
                </tr>
                @endforeach
               
            </tbody>
   
        </table>
    </div>
<div class="d-flex justify-content-center">
            {{ $roles->links() }}
</div>
    <div class="card-footer">
       说明：角色在保证没有用户绑定的情况下可以删除。尽量不删除，靠删除用户来实现功能。
    </div>
    </div>
<!-- ADDModal -->
<div class="modal fade" id="ADDModal" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">角色编辑</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>角色编辑</strong>

                    </div>
                    <form action="{{ url('/admin/roles/store')}}" method="POST" class="was-validated">
                    {{csrf_field()}}
                        <div class="card-body ">

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">角色名字</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">角色描述</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" rows="4" name="description"></textarea>
                                </div>
                            </div>

                            @if(count($errors) >0)
                            <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            </div>
                            @endif
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
                    <form action="{{ asset('/admin/roles/update')}}" method="POST">
                    {{csrf_field()}}
                        <div class="card-body ">
                            <input type='hidden' id='roleid' name="id" >
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">角色名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">角色描述</label>
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
  modal.find('.modal-body #roleid').val(id)
})
</script>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

