@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>蹄病详情</title>
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
        <div class="mr-auto"><strong>{{$trims->cattleID}}--修蹄记录</strong></div>
    </div>
    <div class="card-body table-responsive">
    <p>此牛于{{$trims->trim_date}}进行了修蹄，修了{{$trims->trim_num}}个蹄，分别是{{$trims->which_hoof}}，{{$trims->outcome}}</p>
        <div class="mt-4">
            <h5>病蹄记录</h5>
        </div>
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>牛号</th>
                    <th>修蹄日期</th>
                    <th>蹄子位置</th>
                    <th>蹄病名称</th>
                    <th>病症</th>
                    <th>治疗方式</th>
                    <th>说明</th>
                    <th>治疗是否结束</th>
                    <th>当天状况</th>
                    <th>最终结果</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                @foreach($details as $de)
                <tr>
                        <td>{{++$i}}</td>
                        <td>{{$trims->cattleID}}</td>
                        <td>{{$de->trim_date}}</td>
                        <td>{{$de->which_hoof}}</td>
                        <td>{{$de->disease_name}}</td>
                        <td>{{$de->symptom}}</td>
                        <td><?php
                            echo preg_replace("/药物治疗/","<a href=/admin/manage/Veterinary/trim_hoof/drug_use/".$de->id.">药物治疗</a>",$de->therapeuticWay);
                            ?>
                        </td>
                        <td>{{$de->note}}</td>
                        <td>{{$de->status}}</td>
                        <td>{{$de->dailycondition}}</td>
                        <td>{{$de->outcome}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="card-footer d-flex justify-content-center">

    </div>
</div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')

@stop