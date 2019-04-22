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
                    <div class="mr-auto"><strong>公告修改</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <strong>公告板内容</strong>

                        </div>
                        <div class="card-body ">
                            <form action="{{ url('/admin/post/bulletin/update')}}" method="POST" enctype="multipart/form-data" class="was-validated">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{ $bulletins->id }}" />
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="bulletinPhoto">公告板图片</label>
                                    <img src="{{ asset($bulletins->bulletinPhoto) }}" style="width:200px;height:200px" title="原先的图片，更换请上传新图片">
                                    <input type="file" class="form-control-file col-md-4" id="bulletinPhoto"  name="bulletinPhoto" >
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="bulletintitle">公告板标题</label>
                                    <input type="text" class="form-control-file col-md-10" id="bulletinTitle" name="bulletinTitle" maxlength="20" value="{{$bulletins->bulletinTitle}}" required>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="bulletinContent">公告板文字</label>
                                    <textarea type="text" class="form-control-file col-md-10" id="bulletinContent" name="bulletinContent" maxlength="35" rows="3" required>{{$bulletins->bulletinContent}}
                                    </textarea>
                            </div>
                        <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                        </div>
                            </form>
                        </div>
                        
                    </div>
<div class="card-footer">
    说明：可以不写标题。
</div>


                </div>

            </div>
    @show

@section('footer')
    @include('admin-layouts.admin-footer')
@stop