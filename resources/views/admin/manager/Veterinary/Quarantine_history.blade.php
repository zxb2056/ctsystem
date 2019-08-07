@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>检疫历史记录</title>

@section('topnav')
@include('admin-layouts.admin-nav')
@stop

@section('sidebar')
@include('admin-layouts.admin-sidebar')
@stop

@section('content')
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>检疫记录</strong></div>
                       
                    
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
                                                            <div class="input-group-text">牛号</div>
                                                          </div>
                                                        <input type="text" class="form-control" id="cattleID" name="cattleID" value="">
                                                        </div>
                                                </div>
                                                <div class="col-auto">
                                                        <div class="input-group mb-2">
                                                          <div class="input-group-prepend">
                                                            <div class="input-group-text">起始日期</div>
                                                          </div>
                                                        <input type="date" class="form-control" id="startDate" name="startDate" value="{{$datas['startDate']}}">
                                                        </div>
                                                </div>
                                                <div class="col-auto">
                                                        <div class="input-group mb-2">
                                                          <div class="input-group-prepend">
                                                            <div class="input-group-text">截止日期</div>
                                                          </div>
                                                          <input type="date" class="form-control" id="stopDate" name="stopDate" value="{{$datas['stopDate']}}">
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
                                          <th>牛号</th>
                                          <th>检疫日期</th>
                                          <th>检疫类型</th>
                                          <th>检疫方式</th>
                                          <th>检疫地点</th>
                                          <th>检疫结果</th>
                                          <th>责任人</th>
                                          
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($qua_history as $qua)
                                      <tr>
                                      <td>{{(($qua_history->currentPage() - 1)* $qua_history->perPage())+$loop->iteration}}</td>
                                          <td>{{$qua->cattleID}}</td>
                                          <td>{{$qua->quarantine_day}}</td>
                                          <td>{{$qua->quarantine_disease}}</td>
                                          <td>{{$qua->quarantine_method}}</td>
                                          <td>{{$qua->quarantine_addr}}</td>
                                          <td>{{$qua->result}}</td>
                                          <td>{{$qua->pic}}</td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                        {{$qua_history->appends($datas)->links()}}
                        </div>
                  </div>
            
        </div>


@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
