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
        <strong class="h5 mr-4">图片管理</strong>
        <button type="button" class="btn btn-sm btn-outline-primary ml-5" data-toggle="modal" data-target="#ADDModal"
                        data-title="输入标题">新增图片</button>
    </div>
    <div class="card-body ">
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>id</th>
                    <th>图片标题</th>
                    <th>图片描述</th>
                    <th>缩略图</th>
                    <th>上传日期</th>
                    <th>操作</th>

                </tr>
            </thead>
            <tbody>
            @foreach($tupians as $tupian)
                <tr>
                    <td>{{ (($tupians->currentPage() - 1 ) * $tupians->perPage() ) + $loop->iteration}}</td>
                    <td>{{ $tupian->photoTitle}}</td>
                    <td>{{ $tupian->description }}</td>
                    <td><img src='{{asset("$tupian->photoLink") }}' style="width:150px;"></td>
                    <td>{{ $tupian->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateModal"
                        data-id="{{$tupian->id}}"   data-title="{{ $tupian->photoTitle}}" data-link="{{$tupian->photoLink }}" data-description="{{ $tupian->description }}">编辑</button>
                        <a type="button" href='{{ asset("/admin/photo/delete/{$tupian->id }") }}' onclick="return disp_confirm();" class="btn btn-sm btn-outline-primary">删除</a>
                    </td>
                </tr>
              @endforeach  
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        {{ $tupians->links()}}
        </div>
    </div>

    <div class="card-footer">
        说明：1. 图片控制在200k以下，上传之前先用ps调整一下。2. 图片可以修改标题和描述，不能直接修改图片。如果需要修改图片，请删除原来的图片和标题，重新上传。
    </div>


</div>


<!-- ADDModal -->
<div class="modal fade" id="ADDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增图片</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">

                    <form action="{{ asset('/admin/photo/store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="card-body ">

                            <div class="form-group row">
                                <label for="photoTitle" class="col-sm-3 col-form-label">图片标题</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="photoTitle" name="photoTitle" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">图片描述</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" rows="4" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="picture" class="col-sm-3 col-form-label">上传图片</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="picture" name="photoLink" required>
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
<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">图片更新</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>图片更新</strong>

                </div>
                <div class="card-body">
                    <form action="{{ asset('/admin/photo/photo-update')}}" method="POST" >
                        {{csrf_field()}}
                    <input type='hidden' id='photoid' name="id" >
                        <div class="form-group row">
                            <label for="photoTitle" class="col-sm-3 col-form-label">图片标题</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="photoTitle" name="photoTitle">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">图片描述</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" rows="4" name="description" required> </textarea>
                                </div>
                            </div>
                            <input type='hidden' id='photoLink' name="photoLink"  >
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
</div>


        

    
@stop

@section('footer')
    @include('admin-layouts.admin-footer')
@stop

@section('js')
<script>
    $(document).ready(function () {
    
    $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id') 
    var title = button.data('title')
    var photoLink = button.data('link')
    var description = button.data('description')
    var modal = $(this)
    modal.find('.modal-title').text('更新图片 ' + '--' + title)
    modal.find('.modal-body #photoTitle').val(title)
    modal.find('.modal-body #description').val(description)
    modal.find('.modal-body #photoLink').val(photoLink)
    modal.find('.modal-body #photoid').val(id)
    })
    })
    </script>
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

