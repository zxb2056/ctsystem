@extends('layouts.main')

@section('title')
辰涛牧业主页
@stop

@section('specss')
@parent
<link rel="stylesheet" href="/css/login.css">
@stop

@section('actIndex')

@stop

@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

@section('content')
<div class="container main">
    <h5>个人中心</h5>
    
        <div class="row my-2">
        <div class="card csize">
                <div class="card-header">
                <h6>评论列表</h6>
                </div>
                <div class="card-body">
                <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>id</th>
                            <th>文章标题</th>
                            <th>评论内容</th>
                            <th>创建时间</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                    
                
                        <tr>
                            <td>1</td>
                            <td>辰涛牧业青贮收获</td>
                            <td>大家辛苦了</td>
                            <td>2019-3-2</td>
                           
                        </tr>
                 
                    </tbody>

          </table>
          
                    
                </div>
                <div class="card-footer d-flex">
                 

                </div>
            </div>
        
          
           
        

    </div>

    </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop

    @section('js')
      <script src="{{ asset('/js/login.js')}}"></script>
    @stop