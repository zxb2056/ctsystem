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
                    <div class="mr-auto"><strong>文章列表</strong></div>
               </div>
                <div class="card-body table-responsive">
                    <form action="{{ url('/admin/post/postlist')}}" method="get">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                            <label for="showitem">每页显示：</label>
                            <select name="showitem" id="showitem">
                            <option value="6"  @if(!$datas || $datas[ 'showitem' ]==6) selected @endif) >6条</option>
                            <option value="10" @if($datas[ 'showitem' ]==10) selected @endif>10条</option>
                            <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                            <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                            <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                            </select>
                                <span class="ml-5">筛选：</span>
                                <span class="mx-1">文章标题：</span>
                                <div class="align-self-baseline mr-4">
                                <input  type="text" name="posttitle" value="{{ $datas[ 'posttitle' ]}}"> 
                                </div>
                                <span class="mx-1">日期</span>
                                <input type="date" name="startdate" value="{{ $datas[ 'startdate' ]}}"><span class="mx-1">到</span><input type="date" name="stopdate"  value="{{ $datas[ 'stopdate' ]}}">
                                <button  type="submit" class="btn btn-sm btn-outline-success ml-3">查询</button>
                           
                            </div> 
                            
                        </div>
                        </form>

                
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>id</th>
                            <th>文章标题</th>
                            <th>文章分类</th>
                            <th>轮播图片</th>
                            <th>轮播标题</th>
                            <th>轮播文字</th>
                            <th>文章内容</th>
                            <th>评论数</th>
                            <th>创建时间</th>
                            <th>操作</th>
                              
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ (($posts->currentPage() - 1 ) * $posts->perPage() ) + $loop->iteration}}</td>
                            <td>{{ $post->title}}</td>
                            <td>{{ $post->posttype->name}}</td>
                            <td>@if($post->lunboLink) <img src='{{asset("$post->lunboLink")}}' style="width:150px;"> @else 没有上传图片 @endif</td>
                            <td>{{ $post->lunboTitle}}</td>
                            <td>{{ $post->lunboCaption}}</td>
                            <td><button type="button"  class="btn btn-sm btn-outline-primary p-1 mx-1 text-dark" value='{{asset("/new/{$post->id}")}}' onclick="open_win(this)" >查看</button>
                             </td>
                            <td>
                            <a type="button" class="btn btn-sm btn-outline-info text-dark"  href='{{url("/admin/post/{$post->id}/examcommen")}}'>
                            {{ $post->comments_count }}
                                </a>
                            </td>
                            <td>{{ $post->created_at }}</td>
                            
                            <td class="d-flex" width="150">
                            
                            <a type="button"  href='{{ url("/admin/post/{$post->id}/edit")}}' class="btn btn-sm btn-outline-primary p-1 mx-1">编辑</a>
                            <a type="button" href='{{ url("/admin/post/{$post->id}/delete")}}' class="btn btn-sm btn-outline-primary mx-1 p-1">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

          </table>
    </div>
<div class="card-footer d-flex justify-content-center">
        {{$posts->appends($datas)->links()}}
</div>
</div>
    
 
@stop


@section('js')
<script src="{{ asset('/js/open_win.js')}}"></script>
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

