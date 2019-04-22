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
                    <div class="mr-auto"><strong>公告板列表</strong></div>
                            

                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                   
                        <div class="card-body table-responsive">
                           
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>id</th>
                            <th>公告标题</th>
                            <th>公告内容</th>
                            <th>公告图片</th>
                            <th>操作</th>
                              
                        </tr>
                    </thead>
                    <tbody>
                    
                   @foreach($bulletins as $bulletin)
                        <tr>
                            <td>{{ (($bulletins->currentPage() - 1 ) * $bulletins->perPage() ) + $loop->iteration}}</td>
                            <td>{{ $bulletin->bulletinTitle }}</td>
                            <td>{{ $bulletin->bulletinContent}}</td>
                            <td><img src='{{ asset($bulletin->bulletinPhoto )}}' style="width:150px;"></td>
                            <td class="d-flex" width="150">
                            <a type="button"  href='{{ url("/admin/post/{$bulletin->id}/bulletin-edit")}}' class="btn btn-sm btn-outline-primary p-1 mx-1">编辑</a>
                            <a type="button" href='{{ url("/admin/post/{$bulletin->id}/bulletin-delete")}}' class="btn btn-sm btn-outline-primary mx-1 p-1">删除</a>
                            </td>
                        </tr>
                 @endforeach
                    </tbody>

          </table>
                    </div>
<div class="card-footer d-flex justify-content-center">
   {{ $bulletins->links()}}
</div>


                </div>

            </div>


        </div>
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

