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
                    <div class="mr-auto"><strong>超级管理员</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>文章分类</strong>

                        </div>
                        <div class="card-body ">
                            <form action="{{ url('/admin/post/settype')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="type1">文章类别1</label>
                                    <input type="text" class="form-control-file col-md-10" id="type1" name="type1" >
                            </div>
                               
                          
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="type2">文章类别2</label>
                                    <input type="text" class="form-control-file col-md-10" id="type2" name="type2" >
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="type3">文章类别3</label>
                                    <input type="text" class="form-control-file col-md-10" id="type3" name="type3" >
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="type4">文章类别3</label>
                                    <input type="text" class="form-control-file col-md-10" id="type4" name="type4" >
                            </div>
                            
                             <div class="row d-flex justify-content-center">
                            <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                        
                             </div>  
                         


                            </form>



                        </div>
                      
                    </div>
<div class="card-footer">
    note:.....
</div>


                </div>

            </div>
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

