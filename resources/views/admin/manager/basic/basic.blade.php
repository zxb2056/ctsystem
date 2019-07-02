@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>牛只基本信息</title>
<style>
table i{
    cursor:pointer;
}
thead td:hover{
    cursor:pointer;
    color:red;
    
}
thead td{
    font-weight:bold;
}
</style>
@stop

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<ul class="nav nav-tabs bg-light">
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/basic/cattleinfo')}}">牛只基本信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/barninfo')}}">牛舍信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/barnmapindividual')}}">配置牛舍</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/sireinfos')}}">公牛信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
  </li>
  <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="{{url('/admin/manage/basic/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
      </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-eliminate')}}">牛只淘汰</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-sale-common')}}">牛只出栏</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/manage/basic/breed_code')}}">品种代码</a>
  </li>
</ul>
            @if(!empty($hasRepeat))
        　　<div class="alert alert-danger" role="alert">
        　　　　<strong>系统检测到牛号有重复，请用<a href="/admin/manage/basic/cattleinfo/lookrepeat">查重功能</a>查看并删除相应牛号</strong>
        　　</div>
            @endif
<div class="row mt-3">
                <div class="ml-5 mr-auto">
                    <a href="" class="btn btn-sm btn-outline-primary" title="筛选" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i><span class="hidden-xs"> 筛选</span></a>
                <a href="{{url('/admin/manage/basic/cattleinfo/lookrepeat')}}" class="btn btn-sm btn-outline-primary" title="查重" ><i class="fa fa-files-o" aria-hidden="true"></i><span class="hidden-xs"> 查重</span></a>
                </div>
                <div class="mr-4">
                    <a href="" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addCattleModal" title="新增"><i class="fa fa-save"></i><span class="hidden-xs"> 新增</span></a> 
                    <a href="" class="btn btn-sm btn-outline-primary"  data-toggle="modal" data-target="#importCattleModal" ><i class="fa fa-upload" aria-hidden="true"></i><span class="hidden-xs"> 导入</span></a> 
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          导出
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?php 
                          if(preg_match("/\?/",Request::getRequestUri())=='0')
                          {echo Request::getRequestUri().'?export=all';}
                          else{echo Request::getRequestUri().'&amp;export=all';}
                          ?>"><small>全部</small></a>
                        <a class="dropdown-item" href="<?php 
                          if(preg_match("/\?/",Request::getRequestUri())=='0')
                          {echo Request::getRequestUri().'?export=fromview';}
                          else{echo Request::getRequestUri().'&amp;export=fromview';}
                          ?>"><small>当前页</small></a>
                                                 
                        </div>
                      </div>
                      
                      </div> 
                </div>
                @if(!empty(session('warn')))
        　　<div class="alert alert-warning" role="alert">
        　　　　<strong>{{session('warn')}}</strong>
        　　</div>
            @endif
           
            <div class="card rounded-0 my-3"> 
            
            <div class="card-body">
            <div class="row collapse" id="filter">
            <form action="{{url('/admin/manage/basic/cattleinfo')}}" method="get" id="form1">  
                <div class="row w-100">
                        <div class="col-md-3">
                                <label for="inputId">每页显示数</label>
                                <select class="form-control" name="showitem">
                                <option value="10" selected >10条</option>
                                <option value="20" >20条</option>
                                <option value="30" >30条</option>
                                <option value="50" >50条</option>
                                <option value="100" >100条</option>
                            </select>
                            <label for="inputNum">牛号</label>
                                <input type="text" class="form-control" id="inputNum" name="cattleID" value="{{ $datas['cattleID'] }}">
                            </div>
                            <div class="col-md-3">
                                <label for="inputPz">品种</label>
                                <input type="text" class="form-control" id="inputPz" name="whichBreed" value="{{ $datas['whichBreed'] }}">
                                 <label for="inputBirth">出生日期</label>
                                 <div class="d-flex form-row">
                                 <input type="date" class="col-6 form-control" id="startBirth" name="birthday1" value="{{$datas['birthday1']}}">
                                 <input type="date" class="col-5  form-control" id="endBirth" name="birthday2" value="{{$datas['birthday2']}}">
                                 </div>
                                
                            </div>
                            <div class="col-md-3">
                                <label for="inputTci">胎次</label>
                                <input type="text" class="form-control" id="inputTci" name="pregnancyNum" value="{{ $datas['pregnancyNum'] }}">
                                <label for="inputNshe">牛舍</label>
                                <input type="text" class="form-control" id="inputNshe" name="belongBarn" value="{{ $datas['belongBarn']}}">
                            </div>
                            <div class="col-md-3">
                                <label for="inputRuchang">来源地</label>
                                <input type="text" class="form-control" id="inputRuchang" name="whereComefrom" value="{{ $datas['whereComefrom']}}">
                                <label for="inputSire">在群状态</label>
                                <select name="status" id="status" class="form-control" >
                                <option value="">选择状态</option>
                                <option value="在群" @if($datas['status'] == '在群') selected @endif>在群</option>
                                <option value="不在群" @if($datas['status'] == '不在群') selected @endif>不在群</option>
                                </select>
                            </div>
                                <div class="col-md-3">
                                <label for="inputgender">性别</label>
                                <select name="gender" id="gender" class="form-control" >
                                <option value="">选择状态</option>
                                <option value="公" @if($datas['gender'] == '公') selected @endif>公</option>
                                <option value="母" @if($datas['gender'] == '母') selected @endif>母</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                <label for="inputenterday">入场日期</label>
                                <div class="d-flex form-row">
                                 <input type="date" class="col-6 form-control" id="startenterday" name="enterday_start" value="{{$datas['enterday_start']}}">
                                 <input type="date" class="col-5  form-control" id="endenterday" name="enterday_end" value="{{$datas['enterday_end']}}">
                                 </div>
                                </div>
                                
                </div>
                    <div class="my-3 ml-auto">
                            <button type="submit" class="btn btn-outline-info btn-sm" >提交</button> 
                            <button type="reset" class="btn btn-outline-secondary btn-sm" id="resetinput">重置</button> 
                            <button type="reset" class="btn btn-outline-secondary btn-sm" id="showall">显示所有</button>
                    </div>
                </form> 
            </div>
            </div>
            </div>
           
            <div class="card rounded-0 my-3">
            @if($need_barn->isNotEmpty())
            <div class="alert-danger py-2 text-center">
            有牛只没有分配牛舍，<a href="/admin/manage/basic/barnmapindividual">点击此处</a>进行分配。
            </div>
            @endif
                <div class="card-header d-flex">
                        <h5><strong>牛只信息表</strong></h5><span class="ml-auto">提示：点击标题栏可排序.#代表虚拟牛舍。</span>
                </div>
                <div class="card-body table-responsive">

               @include('admin.manager.basic.cattletable')
                  </div>
                  <div class="card-footer d-flex justify-content-center">
                    {{$allCattles->appends($datas)->links()}}
                  </div>
                  </div>
        </div>

    </div>
    <!-- addcattleModal -->
<div class="modal fade" id="addCattleModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增牛只信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增牛只信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/basic/cattleinfo/pluscattle" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="cattleID" class="col-sm-3 col-form-label">牛耳号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cattleID" name="cattleID" required>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="birthday" class="col-sm-3 col-form-label">出生日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birthday" name="birthday" >
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="birthWeight" class="col-sm-3 col-form-label">出生重</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="birthWeight" name="birthWeight">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="gender" class="col-sm-3 col-form-label">性别</label>
                            <div class="col-sm-9">
                            <select name="gender" id="gender" class="form-control">
                            <option value="公">公</option>
                            <option value="母">母</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="whichBreed" class="col-sm-3 col-form-label">品种</label>
                            <div class="col-sm-6">
                              <select name="whichBreed" id="whichBreed" class="form-control">
                                @foreach($breedvarieties as $breedvariety)
                                <option value="{{$breedvariety->id}}">{{$breedvariety->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-3">
                              
                              <a type="button" class="btn btn-sm btn-outline-light form-control" data-toggle="modal" data-target="#addBreedModal">添加新品种</a>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="whereComefrom" class="col-sm-3 col-form-label ">来源地</label>
                            <div class="col-sm-9">
                              <div class="custom-control custom-radio custom-control-inline pt-2">
                                  <input class="custom-control-input " type="radio" name="whereComefrom" id="inlineRadio1" value="自繁" checked>
                                  <label class="custom-control-label" for="inlineRadio1">自繁</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline pt-2">
                                  <input class="custom-control-input " type="radio" name="whereComefrom" id="inlineRadio2" value="外购">
                                  <label class="custom-control-label" for="inlineRadio2">外购</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="enterDayOut" class="col-sm-3 col-form-label">进场时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="enterDayOut" name="enterDay" disabled>
                            </div>
                        </div>  
                        <div class="form-group form-row">
                            <label for="enterWeightOut" class="col-sm-3 col-form-label">进场体重</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="enterWeightOut" name="enterWeight" disabled>
                            </div>
                        </div>  
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>

    <!-- addBreedModal -->
    <div class="modal fade" id="addBreedModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增牛品种</strong>
                </div>
                <div class="card-body ">
                        <div class="form-group form-row">
                            <label for="breedName" class="col-sm-3 col-form-label">牛品种名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="breedName" name="name">
                            </div>
                        </div>                 
                        <div class="modal-footer" id="breedinsert">                      
                        <button type="submit" id="add_breed_variety" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
 </div>
 </div>
<!-- importCattleModal -->
<div class="modal fade" id="importCattleModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
    <div class="modal-header">
            <h5><strong>导入牛只信息</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header d-flex justify-content-center">                   
                    <div class="ml-auto">
                    <a href="" class="btn btn-sm btn-outline-primary " ><i class="fa fa-refresh"></i><span class="hidden-xs">下载导入模板</span></a>
                    </div>
                </div>
                <div class="card-body ">
                <form action="{{url('/admin/manage/basic/cattleinfo/import_cattle')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field()}}
                        <div class="form-group form-row">
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="cattleinfo_sheet" name="cattleinfo">
                            </div>
                        </div>                 
                        <div class="modal-footer" id="breedinsert">                      
                        <button type="submit" id="add_breed_variety" class="btn btn-primary">导入</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/cattleinput.js"></script>
<script type="text/javascript" src="/js/resetinput.js"></script>

@stop
