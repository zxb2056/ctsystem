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
        <strong class="h5 mr-4">视频管理</strong>
        <button type="button" class="btn btn-sm btn-outline-primary ml-5" data-toggle="modal" data-target="#ADDModal"
                        data-title="输入标题">新增视频</button>
    </div>
    <div class="card-body ">
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>id</th>
                    <th>视频标题</th>
                    <th>视频地址</th>
                    <th>上传日期</th>
                    <th>操作</th>

                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                <tr>
                    <td>{{ (($videos->currentPage() - 1 ) * $videos->perPage() ) + $loop->iteration}}</td>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->videoLink }}</td>
                    <td>{{$video->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button type="button"  class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#updateModal"
                         data-id="{{$video->id}}"   data-title="{{ $video->title}}" data-link="{{$video->videoLink }}">编辑</button>
                        <a type="button" href='{{ asset("/admin/video/delete/{$video->id }") }}' onclick="return disp_confirm();" class="btn btn-sm btn-outline-primary">删除</a>
                    </td>
                </tr>
                @endforeach
               
            </tbody>
   
        </table>
    </div>
<div class="d-flex justify-content-center">
            {{ $videos->links() }}
</div>
    <div class="card-footer">
        说明：建议视频上传到B站，然后用嵌入代码中的网址。
    </div>


</div>

<!-- ADDModal -->
<div class="modal fade" id="ADDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">视频编辑</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>视频编辑</strong>

                    </div>
                    <form action="{{ asset('/admin/video/store')}}" method="POST">
                    {{csrf_field()}}
                        <div class="card-body ">

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">视频标题</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Title" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="videoLink" class="col-sm-3 col-form-label">视频链接</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="videoLink" rows="4" name="videoLink"></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                        </form>
                        <div>
                            <small>视频链接的形式示例：//player.bilibili.com/player.html?aid=34609924&cid=60633892&page=1。如果是B站，选择里面embed格式，截取如例所示内容，上传即可。</small>
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
                <h5 class="modal-title">视频编辑</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>视频编辑</strong>

                    </div>
                    <form action="{{ asset('/admin/video/video-update')}}" method="POST">
                    {{csrf_field()}}
                        <div class="card-body ">
                            <input type='hidden' id='videoid' name="id" >
                            <div class="form-group row">
                                <label for="videotitle" class="col-sm-3 col-form-label">视频标题</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="videotitle" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="videoLink" class="col-sm-3 col-form-label">视频链接</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="videoLink" name="videoLink">
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
    var videoLink = button.data('link')
    var modal = $(this)
    modal.find('.modal-title').text('更新视频 ' + '--' + title)
    modal.find('.modal-body #videotitle').val(title)
    modal.find('.modal-body #videoLink').val(videoLink)
    modal.find('.modal-body #videoid').val(id)
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


