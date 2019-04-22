@extends('admin-layouts.admin-main')

@section('head')
@include('admin-layouts.admin-head')

@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <div class="mr-auto"><strong>文章管理</strong></div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>文章发布</strong>
                        </div>
                        <div class="card-body ">
                            <form action="{{ url('/admin/post/update')}}" method="POST" enctype="multipart/form-data" class="was-validated">
                            
                            {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="title" class="col-md-2 col-form-label">文章标题</label>
                                    <input type="text" class="form-control col-md-10" id="title" name="title"  value="{{ $posts->title }} " required>
                                    <input type="hidden" name="id" value="{{ $posts->id }}" />
                                </div>
                                <div class="form-group row">
                                        <label for="posttype" class="col-md-2 col-form-label">选择分类</label>
                                        <div class="col-md-10">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input class="custom-control-input " type="radio" name="posttype_id" id="inlineRadio1"
                                            value="1" @if($posts->posttype_id == 1) checked @endif required>
                                        <label class="custom-control-label " for="inlineRadio1">新闻动态</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="posttype_id" id="inlineRadio2"
                                            value="2" required @if($posts->posttype_id == 2) checked @endif>
                                        <label class="custom-control-label" for="inlineRadio2">专业技术</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="posttype_id" id="inlineRadio3"
                                            value="3" required @if($posts->posttype_id == 3) checked @endif>
                                        <label class="custom-control-label" for="inlineRadio3" >党建扶贫</label>
                                       
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="posttype_id" id="inlineRadio3"
                                            value="4" required @if($posts->posttype_id == 4) checked @endif>
                                        <label class="custom-control-label" for="inlineRadio3" >人才招聘</label>
                                       
                                    </div>
                                    </div> 
                                
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="lunboLink">轮播图片</label>
                                   @if($posts->lunboLink) <img src="{{$posts->lunboLink}}" style="width:200px;height:200px" title="原先的图片，更换请上传新图片"> @endif
                                    <input type="file" class="form-control-file col-md-3" id="lunboLink" name="lunboLink">
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="lunbotitle">轮播图标题</label>
                                    <input type="text" class="form-control-file col-md-10" id="lunbotitle" name="lunboTitle" maxlength="30" value="{{ $posts->lunboTitle }}">
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="lunboCaption">轮播图文字</label>
                                    <input type="text" class="form-control-file col-md-10" id="lunboCaption" name="lunboCaption" maxlength="200" value="{{ $posts->lunboCaption }}">
                            </div>

                            <div class="form-group row">
                            <label class="col-form-label col-md-2" for="postcontent">文章内容</label>
                         
                            <div class="col-md-10 p-0" id="postcontent" contenteditable="true" > 
                             {!! $posts->content !!}
                            </div>
                            <input type="hidden" name="content" id="subcontent">
                            <input type="hidden" name="piclink" id="piclink">
                            </div>
                            
                            </div> 
                            <div class="row d-flex justify-content-center">
                            <button class="btn btn-outline-success justify-content-end" type="submit" onclick="getContent()">提交</button>

                            </div>
                            </form>


                        </div>
                      
                    </div>
<div class="card-footer">
    注：轮播图标题最大长度20个字符；轮播图文字最多200个字。首页轮播图大小最好先调整为宽800*高400
</div>
                </div>

            </div>

@stop



@section('js')


<script src="{{ asset('/js/wangEditor.min.js')}}"></script>
<script src="{{ asset('/js/posteditor.js')}}"></script>

@stop

@section('footer')
@include('admin-layouts.admin-footer')

@stop

