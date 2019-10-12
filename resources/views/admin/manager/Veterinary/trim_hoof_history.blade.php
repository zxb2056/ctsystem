@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>修蹄明细</title>
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
    <div class="mr-auto"><strong>修蹄记录</strong></div>


  </div>
  <div class="card-body table-responsive">


    <div class="mt-4">
      <h5>修蹄历史</h5>
    </div>
    <table class="table table-hover border">
      <thead>
        <tr>
          <th>序号</th>
          <th>牛号</th>
          <th>修蹄日期</th>
          <th>修蹄状况</th>
          <th>修蹄数量</th>
          <th>蹄子明细</th>
          <th>责任兽医</th>
        </tr>
      </thead>
      <tbody>
        @foreach($trims as $trim)
        <tr>
          <td>{{(($trims->currentPage()-1)*$trims->perPage())+$loop->iteration}}</td>
          <td>
            @if($trim->diseaseOrCare =='1')
            <a href="/admin/manage/Veterinary/trim_hoof/detail/{{$trim->id}}">
              {{$trim->cattleID}}
            </a>
            @else
            {{$trim->cattleID}}
            @endif
          </td>
          <td>{{$trim->trim_date}}</td>
          <td>
            @if($trim->diseaseOrCare =='0') 普修 @else 有病蹄 @endif
          </td>
          <td>{{$trim->trim_num}}</td>
          <td>{{$trim->which_hoof}}</td>
          <td>{{$trim->pic}}</td>
        </tr>
        @endforeach

      </tbody>

    </table>


  </div>
  <div class="card-footer d-flex justify-content-center">
    {{$trims->links()}}
  </div>
  <div class="card-footer">
    <p>说明：1 代表左前蹄，2 代表右前蹄，3 代表左后蹄，4 代表右后蹄</p>
  </div>
</div>

</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop