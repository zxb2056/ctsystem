@extends('layouts.main')

@section('title')
文章详情页
@stop

@section('specss')
@parent
<style>
   .textarea-inherit {
        width: 100%;
        overflow: auto;
        word-break: break-all; //解决兼容问题
    }
</style>
@stop

@section('actVideo')

@stop


@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

    @section('content')
    <div class="container main px-0 ">
        <div class="h3 text-center" >{{$posts->title}}</div>
        <div class="text-center"><span class="mr-5"><small>洛阳辰涛牧业科技有限公司</small></span><span><small>{{ $posts->created_at->format('Y-m-d') }}</small></span></div>
        <div class="text-right mr-5"><p>阅读数<span class="ml-1 text-danger">{{visits($posts)->count() }}</span> | 点赞数<span class="ml-1 text-danger">{{ $zans_count }}</p></div>
        <div style="font-size:1.2rem;line-height:30px;" name="article-content">
      
       {!! $posts->content !!} 
       <div class="d-flex mb-3">
       <div class="mr-auto">
       @if($posts->zan(\Auth::id())->exists())
      <a href='{{ url("/posts/{$posts->id}/unzan")}}' type="button" class="btn btn-sm"> 取消赞</a>
      @else
       <a href='{{ url("/posts/{$posts->id}/zan")}}' type="button" class="btn btn-sm btn-outline-info"> 赞一下</a>
      @endif
       </div>
        <small>文章发布人：{{ $posts->user->username}}  </small></div> 
          
        </div>
        
        <div class="card">
      <div class="card-header">
        留言回复
      </div>
      <div class="card-body">
          <div class="media mb-4">
             <div class="media-body">
                <p class="mt-0">张三，有什么想说的</p>
        <form action='{{url("/posts/{$posts->id}/comment")}}' method="POST">
        {{csrf_field()}}
               <textarea   class="textarea-inherit" name="content" id="content" rows="5"  @auth placeholder="回复最多120字" maxlength="120" @endauth @guest placeholder="回复需要先登录" disabled="disabled" @endguest ></textarea>
               @if(count($errors) >0)
                <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </div>
                @endif

               <button type="submit" class="button btn btn-light btn-block mt-2" @guest disabled="disabled" @endguest>提交</div>
              </button>
        </form>
          </div>
          @foreach($posts->comments as $comment)
          <div class="mb-4 border-top">
             
              <div class="media-body ">
                <p class="mt-0 small"><span class="text-primary ">{{$comment->user->name}}</span> 发表于 {{$comment->created_at->format('Y-m-d h:i:s')}}</p>
                <p>{{$comment->content}}</p>
               
              </div>
          </div>
          @endforeach
   
      </div>
</div>
   

    @stop

    @section('footer')
    @include('layouts.footer')
    @stop
    @section('js')
    @stop

   