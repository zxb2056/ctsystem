@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>防疫历史查询</title>
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
                        <div class="mr-auto"><strong>防疫历史记录</strong></div>                    
                </div>
                <div class="card-body">
                <form action="/admin/manage/Veterinary/antiepidemic_history" method="get" class="border p-2">
                  <div class="form-row">
                      <div class="form-group col-md-3">
                          <label for="showitem" >显示条数</label>
                            <select name="showitem" id="showitem" class="form-control form-control-sm" name="showitem">
                              <option value="10" @if(!$datas || $datas['showitem']==10) selected @endif>10条</option>
                              <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                              <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                              <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                            </select>
                        </div>
                    <div class="form-group col-md-3">
                      <label for="cattleID">牛号</label>
                      <input type="text" class="form-control form-control-sm" id="cattleID" name="cattleID" placeholder="牛号">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="querystartdate">开始日期</label>
                      <input type="date" id="querystartdate" class="form-control form-control-sm" name="startdate">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">截止日期</label>
                      <input type="date" id="querystopdate" class="form-control form-control-sm" name="stopdate">
                    </div>

                  <div class="form-group col-md-3">
                    <label for="epidemic_type">疫病名称</label>
                    <input type="text" class="form-control form-control-sm" id="epidemic_type" name="epidemic_type">
                  </div> 
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary">提交</button>
                </form>
              </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>牛号</th>
                            <th>牛只日龄</th>
                            <th>免疫日期</th>
                            <th>免疫疾病</th>
                            <th>牛舍号</th>
                            <th>疫苗名称</th>
                            <th>疫苗使用量</th>
                            <th>疫苗厂家</th>
                            <th>免疫人员</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($epidemics_history as $epidemic)
                        <tr>
                            <td>{{(($epidemics_history->currentPage() - 1)* $epidemics_history->perPage()) + $loop->iteration}}</td>
                            <td>{{$epidemic->linkcattle->cattleID}}</td>
                            <td>{{$epidemic->ageOfDay}}</td>
                            <td>{{$epidemic->anti_day}}</td>
                            <td>{{$epidemic->epidemic_name->name}}</td>
                            <td>{{$epidemic->barnId}}</td>
                            <td>{{$epidemic->drug_name->drugName}}</td>
                            <td>{{$epidemic->use_amount}}</td>
                            <td>{{$epidemic->drug_name->supplier}}</td>
                            <td>{{$epidemic->pic}} </td>
                        </tr>
                      @endforeach
                        
                    </tbody>

          </table>
            
               
                  </div>
              <div class="card-footer d-flex justify-content-center">
                {{$epidemics_history->links()}}
              </div>
                  </div>
            
        </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop
