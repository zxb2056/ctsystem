@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>牛舍信息</title>
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
    <a class="nav-link" href="{{url('/admin/manage/basic/cattleinfo')}}">牛只基本信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/basic/barninfo')}}">牛舍信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/barnmapindividual')}}">配置牛舍</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/sireinfos')}}">公牛信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
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
<div class="card rounded-0 my-3">
  <div class="card-header d-flex">
    <h5><span><strong>牛舍信息表</strong><span><span class="ml-4 text-info"><small>牛场共有牛舍{{$barnNum}}个</small></span></h5>
    <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#addBarnModal"
      title="新增"><i class="fa fa-save mr-1"></i>新增</a>
  </div>
  <div class="card-body table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>序号</th>
          <th>牛舍名</th>
          <th>牛舍号</th>
          <th>说明</th>
          <th>牛舍类型</th>
          <th>地面硬化方式</th>
          <th>面积</th>
          <th>颈夹数</th>
          <th>水槽数量</th>
          <th>水槽容量</th>
          <th>负责人</th>
        </tr>
      </thead>
      <tbody>
        @foreach($barns as $barn)
        <tr>
          <td width="80px">{{(($barns->currentPage() - 1 ) * $barns->perPage() ) + $loop->iteration }}</td>
          <td>{{ $barn->barnName }}</td>
          <td>@if($barn->barnID=='-1') # @else {{ $barn->barnID }} @endif</td>
          <td>{{ $barn->description }}</td>
          <td>{{ $barn->barnStyle }}</td>
          <td>{{ $barn->groundStyle }}</td>
          <td>{{ $barn->acreage }}</td>
          <td>{{ $barn->checkClipNum }}</td>
          <td>{{ $barn->waterTrough }}</td>
          <td>{{ $barn->troughSize }}</td>
          <td>{{ $barn->pic->name }}</td>
        </tr>
        @endforeach

      </tbody>

    </table>
  </div>
  <div class="card-footer d-flex justify-content-center">
    {{$barns->links()}}
  </div>
    </div>
    </div>
</div>

<!-- addBarnModal -->
<div class="modal fade" id="addBarnModal" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header">
          <h5 class="modal-title"><strong>新增牛舍</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body ">
          <form action="{{url('/admin/manage/basic/barninfo/addbarn')}}" method="post">
            {{csrf_field()}}
            <div class="form-group form-row">
              <label for="barnID" class="col-sm-3 col-form-label">牛舍编号</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="barnID" name="barnID">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="barnName" class="col-sm-3 col-form-label">牛舍名称</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="barnName" name="barnName">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="barnStyle" class="col-sm-3 col-form-label">牛舍类型</label>
              <div class="col-sm-9">
                <select name="barnStyle" id="barnStyle" class="form-control">
                  <option value="开放式">开放式</option>
                  <option value="封闭式">封闭式</option>
                  <option value="半开放式">半开放式</option>
                </select>
              </div>
            </div>
            <div class="form-group form-row">
              <label for="groundStyle" class="col-sm-3 col-form-label">地面硬化类型</label>
              <div class="col-sm-9">
                <select name="groundStyle" id="groundStyle" class="form-control">
                  <option value="水泥">水泥地面</option>
                  <option value="砖混">砖混</option>
                  <option value="三合土">三合土</option>
                  <option value="沙土">沙土</option>
                  <option value="沙土">其它</option>
                </select>
              </div>
            </div>
            <div class="form-group form-row">
              <label for="acreage" class="col-sm-3 col-form-label">牛舍面积(㎡)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="acreage" name="acreage">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="checkClipNum" class="col-sm-3 col-form-label">颈夹数</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="checkClipNum" name="checkClipNum">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="waterTrough" class="col-sm-3 col-form-label">水槽数量</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="waterTrough" name="waterTrough">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="troughSize" class="col-sm-3 col-form-label">水槽容量(m³)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="troughSize" name="troughSize">
              </div>
            </div>

            <div class="form-group form-row">
              <label for="description" class="col-sm-3 col-form-label">说明</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="description" name="description">
              </div>
            </div>
            <div class="form-group form-row">
              <label for="PIC" class="col-sm-3 col-form-label">责任兽医</label>
              <div class="col-sm-9">
                <select name="PIC" id="PIC" class="form-control">
                  @foreach($staffs as $staff)
                  <option value="{{$staff->id}}">{{$staff->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer" id="breedinsert">
              <button type="submit" id="add_breed_variety" class="btn btn-primary">保存</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop