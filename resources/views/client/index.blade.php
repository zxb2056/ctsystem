@extends('layouts.main')

@section('title')
辰涛牧业主页
@stop

@section('specss')
@parent
<link rel="stylesheet" href="{{ asset('/css/djfp.css') }}">
@stop

@section('actIndex')
active
@stop

@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

@section('content')
<div class="container main px-0">
            <div class="form-row">
                <div class="col-md-8">
                    <div class="h-100">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade h-100" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                            <li data-target="#carouselExampleFade" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner h-100">

                        @foreach($posts as $post)
                            <div class="carousel-item header-carousel-item bg-cover h-100 @if($loop->first) active @endif" data-interval="3000" style='background-image:url("{{ $post->lunboLink }}")'>
                            <a href='{{url("/post/{ $post->id }")}}'>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $post->lunboTitle }}</h5>
                                    <p>{{ $post->lunboCaption }}</p>
                                </div>
                            </a>
                            </div>
                         @endforeach   
                          
                        
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon arrow bg-dark p-1" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next " href="#carouselExampleFade" role="button" data-slide="next">
                            <span class="carousel-control-next-icon arrow bg-dark p-1" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                </div>
            <div class="col-md-4">
                <div class="card w-100 h-100" ">
                @foreach($bulletins as $bulletin)
                            <img src="{{ $bulletin->bulletinPhoto }} " class="card-img-top" alt="...">
                            <div class="card-body pb-1">
                            <h5 class="text-center"><strong>{{ $bulletin->bulletinTitle }}</strong></h5>
                              <p class="card-text">{{ $bulletin->bulletinContent }}</p>
                            </div>
                @endforeach
                </div>
            </div>

        </div>
        <div class="form-row mt-3">
        <div class="col-md-4">
                <div class="card w-100 h-100">
                <div class="card-body bg-light">
                    <h5 class="card-title">新闻动态</h5>
    
                <ul class="list-group list-group-flush">
                @foreach($news as $new)
                    <li class="list-group-item d-flex">
                        <div class="mr-auto"> <a href='{{url("/news/{$new->id}")}}' >{{ str_limit($new->title,30,'......') }}</a> </div>
                        <div > {{ $new->created_at->format('Y-m-d') }}   </div>
                    </li>
                 @endforeach   
                </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{asset('/news.html')}}" class="card-link btn btn-primary">了解更多</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="card w-100 h-100">
                        <div class="card-body bg-light">
                            <h5 class="card-title ">专业技术</h5>
                      
                        <ul class="list-group list-group-flush">
                        @foreach($techs as $tech)
                                <li class="list-group-item d-flex">
                                    <div class="mr-auto"> <a href='{{asset("/tech/{$tech->id}")}}' >{{ str_limit($tech->title,26,'......')}}</a> </div>
                                    <div >{{ $tech->created_at->format('Y-m-d') }} </div>
                                    </li>
                        @endforeach      
                            </ul>
                            </div>
                            <div class="card-footer text-center">
                                    <a href="{{ asset('/tech.html')}}" class="card-link btn btn-primary">了解更多</a>
                                </div>
                    </div>
        </div>
        <div class="col-md-4">
                <div class="card w-100 h-100">
                        <div class="card-body bg-light">
                            <h5 class="card-title">党建扶贫</h5>
        
                       
                        <ul class="list-group list-group-flush">
                        @foreach($partys as $party)
                                <li class="list-group-item d-flex ">
                                    <div class="mr-auto ellipsis"> <a href='{{asset("/djfp/{$party->id}")}}' >{{ str_limit($party->title,26,'......')}}</a> </div>
                                    <div >{{ $party->created_at->format('Y-m-d') }} </div>
                                    </li>
                        @endforeach        
                            </ul>
                            </div>
                            <div class="card-footer text-center">
                                    <a href="{{ asset('/djfp.html')}}" class="card-link btn btn-primary">了解更多</a>
                                </div>
                    </div>
        </div>
        </div>
        <div class="form-row mt-2">
            <div class="col-md-4">
                    <div class="card h-100">
                            <div class="card-body">
                              <h5 class="card-title text-center">肉牛养殖</h5>
                              <p class="card-text">公司的智能化牛舍，占地面积35000平方，为国内最大圆形牛圈。</p>
                              
                            </div>
                            <img src="image/niushe.jpg" class="card-img-top" alt="辰涛牧业牛舍">
                            <p class="card-text"><small class="text-muted">公司奉行生态养殖，肉牛听音乐，喝啤酒，自由采食，自由饮水，快乐成长。</small></p>
                          </div>

            </div>
            <div class="col-md-4">
                    <div class="card h-100">
                            <div class="card-body">
                              <h5 class="card-title text-center">种养结合</h5>
                              <p class="card-text">公司流转两千多亩土地作为粮改饲项目基地，配套种植青贮玉米、牧草。</p>
                            </div>
                            <img src="image/Food_reform.jpg" class="card-img-top" alt="辰涛牧业种养结合">
                            <p class="card-text"><small class="text-muted">公司致力于营造高效循环的农业生产体系，牛粪到田地，秸秆再喂牛。</small></p>
                          </div>

            </div>
            <div class="col-md-4">
                    <div class="card h-100">
                            <div class="card-body">
                              <h5 class="card-title text-center">打造伊川牛肉品牌</h5>
                              <p class="card-text">公司带动伊川县内30多个肉牛合作社，形成万头全产业链安格斯繁育基地，打造伊川牛肉品牌。</p>
                            </div>
                            <img src="image/beef.jpg" class="card-img-top" alt="伊川牛肉品牌" style="min-height:278px">
                            <p class="card-text"><small class="text-muted">路漫漫其修远，唯有心无旁骛，努力创新创造，才能踏踏实实办好企业。</small></p>
                          </div>

            </div>
        </div>

        </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop