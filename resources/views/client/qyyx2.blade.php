@extends('layouts.main')

@section('title')
企业影像
@stop

@section('specss')
@parent
<link rel="stylesheet" href="{{ asset('/css/qyyx.css') }}">
@stop

@section('actVideo')
active
@stop


@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

    @section('content')
    <div class="container main">
        <div class="jumbotron jumbotron-bg d-flex align-items-start">
            <div class="bg-ligther p-3">
                <h1 class="display-5">企业影像</h1>
            </div>


        </div>
        <div class="row">
            <div class="col-6">
                <div class="list-group sticky-top d-flex flex-row my-4" >
                    <a href="{{asset('/qyyx.html')}}" class="list-group-item list-group-item-action " >图片</a>
                    <a href="{{asset('/qyyx/video.html')}}" class="list-group-item list-group-item-action active" >视频</a>
                </div>
            </div>
        </div>
                    @foreach($videos as $key=>$video)
                    @if ($key%2 == 0)
                    <div class="form-row my-4">
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h4 class="text-center">{{ $video->title }}</h4>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{$video->videoLink}}"
                                            scrolling="no" frameborder="no" framespacing="0" allowfullscreen="true">
                                        </iframe>
                                    </div>
                                    <a href="{{ $video->videoLink }}" class="fullscreen btn btn-outline-info ml-auto">全屏观看</a>
                                </div>
                            </div>
                        @else  
                        <div class="col-lg-6">
                                <div class="text-right">
                                    <h4 class="text-center">{{ $video->title }}</h4>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{$video->videoLink}}"
                                            scrolling="no" frameborder="no" framespacing="0" allowfullscreen="true">
                                        </iframe>
                                    </div>
                                    <a href="{{ $video->videoLink }}" class="fullscreen btn btn-outline-info ml-auto">全屏观看</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-center">
                    {{$videos->links()}}
                    </div>
                </div>

        
        </div>

        


    </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop

   