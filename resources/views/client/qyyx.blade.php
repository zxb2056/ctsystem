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
                <div class="list-group sticky-top d-flex flex-row my-4" id="list-tab" role="tablist">
                    <a href="{{asset('/qyyx.html')}}" class="list-group-item list-group-item-action active" >图片</a>
                    <a href="{{asset('/qyyx/video.html')}}" class="list-group-item list-group-item-action" >视频</a>
                </div>
            </div>
</div>
        

                    @foreach ($photos as $key=>$photo)
                    @if ($key%2 == 0)
                        <div class="row">
                           <div class="col-md-6 mb-4 ">
                                <div class="card h-100 box-shadow">
                                    <img src='{{asset("$photo->photoLink")}}' class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $photo->photoTitle }}</h5>
                                        <p class="card-text">{{ $photo->description }}</p>
                                    </div>

                                </div>
                            </div>
                    @else
                    <div class="col-md-6 mb-4 ">
                                <div class="card h-100 box-shadow">
                                    <img src='{{ asset("$photo->photoLink")}}' class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $photo->photoTitle }}</h5>
                                        <p class="card-text">{{ $photo->description }}</p>
                                    </div>

                                </div>
                            </div>
                            </div>          
                    @endif
                    @endforeach
                   
                    </div>
                    <div class="d-flex justify-content-center">
                    {{$photos->links()}}
                    </div>


        
        </div>

        


    </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop

   