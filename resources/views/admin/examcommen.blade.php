@extends('admin-layouts.admin-main')

@section('head')

    @include('admin-layouts.admin-head')

@stop

@section('css')
<meta name="csrf-token" content="{{csrf_token()}}">
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
                    <div class="mr-auto"><strong>文章评论审核</strong></div>
               </div>
                <div class="card-body table-responsive">
                <div class="card-header">
                <span class="h5">文章标题：{{$postTitle}}</span>
                </div>
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>评论内容</th>
                            <th>评论人</th>
                            <th>发表时间</th>
                            <th>通过</th>
                            <th>隐藏</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ (($comments->currentPage() - 1 ) * $comments->perPage() ) + $loop->iteration}}</td>
                            <td>{{ $comment->content}}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->created_at}}</td>
                            
                            
                            <td> <a type="button"  class="btn  btn-outline-primary p-1 mx-1 verifyComment" commentid="{{$comment->id}}" comment-status="1">通过</a> </td>
                            <td><a type="button"  class="btn  btn-outline-primary p-1 mx-1 verifyComment"  commentid="{{$comment->id}}" comment-status="-1">隐藏</a>  </td>
                        </tr>
                    @endforeach
                    </tbody>

          </table>
    </div>
        <div class="card-footer d-flex justify-content-center">
                {{$comments->links()}}
        </div>
</div>
 @stop

 @section('js')
 <script src="{{asset('/js/examcomment.js')}}"></script>
@stop

@section('footer')
    @include('admin-layouts.admin-footer')
@stop
