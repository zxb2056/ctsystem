@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')

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
        <a class="nav-link" href="{{url('/admin/manage/breed/mateInput')}}" >配种</a>
      </li>

        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/yunjianinput')}}">孕检</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/chandu')}}">产犊</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/aftercare')}}">产后护理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/waitmate')}}">待配母牛表</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/fanzhidisease')}}">繁殖病症诊疗卡</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
        </li>
      </ul>
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                       <strong>预产期明细表</strong>
                </div>
                <div class="card-header">
                    <form action="" method="get">
                            <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">每页显示</div>
                                              </div>
                                              <select name="showitem" id="showitem" class="form-control">
                                                <option value="10" @if($datas['showitem'] == '10') selected @endif>10条</option>
                                                <option value="20" @if($datas['showitem'] == '20') selected @endif>20条</option>
                                                <option value="30" @if($datas['showitem'] == '30') selected @endif>30条</option>
                                                <option value="50" @if($datas['showitem'] == '50') selected @endif>50条</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                            <div class="input-group mb-2">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">冻精号</div>
                                              </div>
                                            <input type="text" class="form-control" id="cowid" name="cowID" value="{{$datas['cowID']}}">
                                            </div>
                                    </div>
                                    <div class="col-auto">
                                            <button type="submit" class="btn btn-sm btn-outline-primary mb-2">查询</button>
                                    </div>
                            </div>                                 
                    </form>
                </div>
                <div class="card-body table-responsive">

          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>母牛号</th>
                            <th>配种日期</th>
                            <th>预产日期</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($expectedCattle as $expect)
                        <tr>
                        <td>{{(($expectedCattle->currentPage()-1)*$expectedCattle->perPage())+$loop->iteration}}</td>
                        <td>{{$expect->linkcow->cattleID}}</td>
                        <td>{{$expect->mateDate}}</td>
                        <td><?php echo date('Y-m-d',strtotime("$expect->mateDate + 283 day")) ?></td>
                            
                        </tr>
                       @endforeach
                    </tbody>

          </table>
            <div class="card-footer">
                说明：预产期按283天计算，前后15天都正常范围。
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{$expectedCattle->links()}}
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
