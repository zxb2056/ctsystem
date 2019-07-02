@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>配种计划</title>
<style>
.matePlanList{
    background-color:#CCCC99;
    max-height:600px;
  }
  .year-plan{
  border-bottom: 1px solid #777777;
  padding: 3px;
  width:100%;
}
.year-plan a{
  color:black;
}
.year-plan a:visited{
  font-size: 14px;
  color:black;
}
.year-plan a:hover{ 
text-decoration: none; 
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
          <a class="nav-link" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
        </li>
      </ul>
      <ul class="nav nav-tabs bg-light mt-2">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">月计划</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="{{url('/admin/manage/breed/mateplan/yearly')}}">年计划</a>
          </li>
      </ul>

<div class="container-fluid">
                <div class="row ">
                    <div class="col-md-2 mt-3">
                        <ul class="matePlanList list-unstyled">
                            @foreach ($years as $k=>$item)
                                <li class="year-plan my-2 p-2"> <a href="/admin/manage/breed/mateplan/yearly?year={{$k}}" >{{$k}}年</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-10">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="pane-1" role="tabpanel">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header">
                                    <strong>{{$datas['year']}}年配种计划表</strong>
                                    </div>
                                    <div class="card-body table-responsive">

                                        <table class="table table-hover border">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>类别</th>
                                                    <th>一月</th>
                                                    <th>二月</th>
                                                    <th>三月</th>
                                                    <th>四月</th>
                                                    <th>五月</th>
                                                    <th>六月</th>
                                                    <th>七月</th>
                                                    <th>八月</th>
                                                    <th>九月</th>
                                                    <th>十月</th>
                                                    <th>十一月</th>
                                                    <th>十二月</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <th rowspan="3" width="50px">上年受胎母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>{{$yearPlans[0]['January']}}</td>
                                                    <td>{{$yearPlans[0]['February']}}</td>
                                                    <td>{{$yearPlans[0]['March']}}</td>
                                                    <td>{{$yearPlans[0]['April']}}</td>
                                                    <td>{{$yearPlans[0]['May']}}</td>
                                                    <td>{{$yearPlans[0]['June']}}</td>
                                                    <td>{{$yearPlans[0]['July']}}</td>
                                                    <td>{{$yearPlans[0]['August']}}</td>
                                                    <td>{{$yearPlans[0]['September']}}</td>
                                                    <td>{{$yearPlans[0]['October']}}</td>
                                                    <td>{{$yearPlans[0]['November']}}</td>
                                                    <td>{{$yearPlans[0]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>{{$yearPlans[1]['January']}}</td>
                                                    <td>{{$yearPlans[1]['February']}}</td>
                                                    <td>{{$yearPlans[1]['March']}}</td>
                                                    <td>{{$yearPlans[1]['April']}}</td>
                                                    <td>{{$yearPlans[1]['May']}}</td>
                                                    <td>{{$yearPlans[1]['June']}}</td>
                                                    <td>{{$yearPlans[1]['July']}}</td>
                                                    <td>{{$yearPlans[1]['August']}}</td>
                                                    <td>{{$yearPlans[1]['September']}}</td>
                                                    <td>{{$yearPlans[1]['October']}}</td>
                                                    <td>{{$yearPlans[1]['November']}}</td>
                                                    <td>{{$yearPlans[1]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>合计</td>
                                                    <td>{{$yearPlans[2]['January']}}</td>
                                                    <td>{{$yearPlans[2]['February']}}</td>
                                                    <td>{{$yearPlans[2]['March']}}</td>
                                                    <td>{{$yearPlans[2]['April']}}</td>
                                                    <td>{{$yearPlans[2]['May']}}</td>
                                                    <td>{{$yearPlans[2]['June']}}</td>
                                                    <td>{{$yearPlans[2]['July']}}</td>
                                                    <td>{{$yearPlans[2]['August']}}</td>
                                                    <td>{{$yearPlans[2]['September']}}</td>
                                                    <td>{{$yearPlans[2]['October']}}</td>
                                                    <td>{{$yearPlans[2]['November']}}</td>
                                                    <td>{{$yearPlans[2]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <th rowspan="3" width="50px">本年产犊母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>{{$yearPlans[3]['January']}}</td>
                                                    <td>{{$yearPlans[3]['February']}}</td>
                                                    <td>{{$yearPlans[3]['March']}}</td>
                                                    <td>{{$yearPlans[3]['April']}}</td>
                                                    <td>{{$yearPlans[3]['May']}}</td>
                                                    <td>{{$yearPlans[3]['June']}}</td>
                                                    <td>{{$yearPlans[3]['July']}}</td>
                                                    <td>{{$yearPlans[3]['August']}}</td>
                                                    <td>{{$yearPlans[3]['September']}}</td>
                                                    <td>{{$yearPlans[3]['October']}}</td>
                                                    <td>{{$yearPlans[3]['November']}}</td>
                                                    <td>{{$yearPlans[3]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>{{$yearPlans[4]['January']}}</td>
                                                    <td>{{$yearPlans[4]['February']}}</td>
                                                    <td>{{$yearPlans[4]['March']}}</td>
                                                    <td>{{$yearPlans[4]['April']}}</td>
                                                    <td>{{$yearPlans[4]['May']}}</td>
                                                    <td>{{$yearPlans[4]['June']}}</td>
                                                    <td>{{$yearPlans[4]['July']}}</td>
                                                    <td>{{$yearPlans[4]['August']}}</td>
                                                    <td>{{$yearPlans[4]['September']}}</td>
                                                    <td>{{$yearPlans[4]['October']}}</td>
                                                    <td>{{$yearPlans[4]['November']}}</td>
                                                    <td>{{$yearPlans[4]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>合计</td>
                                                    <td>{{$yearPlans[5]['January']}}</td>
                                                    <td>{{$yearPlans[5]['February']}}</td>
                                                    <td>{{$yearPlans[5]['March']}}</td>
                                                    <td>{{$yearPlans[5]['April']}}</td>
                                                    <td>{{$yearPlans[5]['May']}}</td>
                                                    <td>{{$yearPlans[5]['June']}}</td>
                                                    <td>{{$yearPlans[5]['July']}}</td>
                                                    <td>{{$yearPlans[5]['August']}}</td>
                                                    <td>{{$yearPlans[5]['September']}}</td>
                                                    <td>{{$yearPlans[5]['October']}}</td>
                                                    <td>{{$yearPlans[5]['November']}}</td>
                                                    <td>{{$yearPlans[5]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <th rowspan="5" width="50px">本年配种母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>{{$yearPlans[6]['January']}}</td>
                                                    <td>{{$yearPlans[6]['February']}}</td>
                                                    <td>{{$yearPlans[6]['March']}}</td>
                                                    <td>{{$yearPlans[6]['April']}}</td>
                                                    <td>{{$yearPlans[6]['May']}}</td>
                                                    <td>{{$yearPlans[6]['June']}}</td>
                                                    <td>{{$yearPlans[6]['July']}}</td>
                                                    <td>{{$yearPlans[6]['August']}}</td>
                                                    <td>{{$yearPlans[6]['September']}}</td>
                                                    <td>{{$yearPlans[6]['October']}}</td>
                                                    <td>{{$yearPlans[6]['November']}}</td>
                                                    <td>{{$yearPlans[6]['December']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>{{$yearPlans[7]['January']}}</td>
                                                    <td>{{$yearPlans[7]['February']}}</td>
                                                    <td>{{$yearPlans[7]['March']}}</td>
                                                    <td>{{$yearPlans[7]['April']}}</td>
                                                    <td>{{$yearPlans[7]['May']}}</td>
                                                    <td>{{$yearPlans[7]['June']}}</td>
                                                    <td>{{$yearPlans[7]['July']}}</td>
                                                    <td>{{$yearPlans[7]['August']}}</td>
                                                    <td>{{$yearPlans[7]['September']}}</td>
                                                    <td>{{$yearPlans[7]['October']}}</td>
                                                    <td>{{$yearPlans[7]['November']}}</td>
                                                    <td>{{$yearPlans[7]['December']}}</td>
                                                </tr>

                                                <tr>
                                                    <td>合计</td>
                                                    <td>{{$yearPlans[8]['January']}}</td>
                                                    <td>{{$yearPlans[8]['February']}}</td>
                                                    <td>{{$yearPlans[8]['March']}}</td>
                                                    <td>{{$yearPlans[8]['April']}}</td>
                                                    <td>{{$yearPlans[8]['May']}}</td>
                                                    <td>{{$yearPlans[8]['June']}}</td>
                                                    <td>{{$yearPlans[8]['July']}}</td>
                                                    <td>{{$yearPlans[8]['August']}}</td>
                                                    <td>{{$yearPlans[8]['September']}}</td>
                                                    <td>{{$yearPlans[8]['October']}}</td>
                                                    <td>{{$yearPlans[8]['November']}}</td>
                                                    <td>{{$yearPlans[8]['December']}}</td>

                                                </tr>
                                                <tr>
                                                    <td >预期情期受胎率</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>
                                                    <td>60%</td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pane-2" role="tabpanel">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header">
                                        <strong>**月计划表</strong>
                                    </div>
                                    <div class="card-body table-responsive">

                                        <table class="table table-hover border">
                                            <thead>
                                                <tr>
                                                    <th>类目</th>
                                                    <th>数值</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>上月配种牛数</th>
                                                    <td>25</td>

                                                </tr>
                                                <tr>
                                                    <th>上月定胎牛数</th>
                                                    <td>20</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计配种牛头数</th>
                                                    <td>30</td>
                                                </tr>
                                                <tr>
                                                    <th>本月需要定胎牛头数</th>
                                                    <td>22</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计产犊数</th>
                                                    <td>16</td>
                                                </tr>
                                                <tr>
                                                    <th>本月预计冻精使用量</th>
                                                    <td>58</td>
                                                </tr>
                                                <tr>
                                                    <th>本月繁育可能遇到的问题</th>
                                                    <td>需要人员辅助观察发情</td>
                                                </tr>
                                                <tr>
                                                    <th>本月情期受胎率估测</th>
                                                    <td>60%</td>
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="card-footer">

                                    </div>
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
