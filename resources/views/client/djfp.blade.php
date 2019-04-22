@extends('layouts.main')

@section('title')
人才招聘
@stop

@section('specss')
@parent
<link rel="stylesheet" href="{{ asset('/css/djfp.css') }}">
@stop

@section('actDjfp')
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
                <h1 class="display-5">党建扶贫</h1>
        </div>
      

    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="w-100" src="{{ asset('/image/xiyu1.jpg') }}" alt="习大大谈党建">
        </div>
        <div class="col-md-8">
            <div class="d-flex align-items-center border-bottom border-warning mb-2">
                    <div >您现在的位置：</div>
                    <nav aria-label="breadcrumb">
                           <ol class="breadcrumb bg-transparent pl-1 mb-0">
                                  <li class="breadcrumb-item"><a href="{{ asset('/')}}">首页</a></li>
                                  <li class="breadcrumb-item"><a href="{{ asset('/djfp.html')}}">党建扶贫</a></li>
                                  
                            </ol>
                            </nav>
            </div>
<ul class="list-group mb-4" >
@foreach($posts as $post)
        <li class="list-group-item">
             <a href='{{ asset("/djfp/{$post->id}")}}' class="text-dark"><span>{{$post->title}}</span></a> <span class="float-right">{{$post->created_at}}</span>
        </li>
        
@endforeach
        
</ul >
          <div class="d-flex justify-content-center">
               {{$posts->links()}}
          </div>

        </div>
    </div>




</div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop