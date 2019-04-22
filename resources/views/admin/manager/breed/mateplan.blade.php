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
<div class="container-fluid">
                <h5 class="my-3">繁殖计划表</h5>
                <div class="row ">
                    <div class="col-md-4">
                        <div class="list-group sticky-top " id="mylist" role="tablist">

                            <a href="#pane-1"  class="list-group-item list-group-item-action active" data-toggle="list">年计划表</a>
                            <a href="#pane-2" class="list-group-item list-group-item-action" data-toggle="list">月计划表</a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="pane-1" role="tabpanel">
                                <div class="card rounded-0 my-3">
                                    <div class="card-header">
                                        <strong>年配种计划表</strong>
                                    </div>
                                    <div class="card-body table-responsive">

                                        <table class="table table-hover border">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>月份</th>
                                                    <th>1月</th>
                                                    <th>2月</th>
                                                    <th>3月</th>
                                                    <th>4月</th>
                                                    <th>5月</th>
                                                    <th>6月</th>
                                                    <th>7月</th>
                                                    <th>8月</th>
                                                    <th>9月</th>
                                                    <th>10月</th>
                                                    <th>11月</th>
                                                    <th>12月</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <th rowspan="3" width="50px">上年受胎母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>合计</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <th rowspan="3" width="50px">本年产犊母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>合计</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <th rowspan="5" width="50px">本年配种母牛数</th>
                                                    <td>成年母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>头胎母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>育成母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>复配母牛</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                </tr>
                                                <tr>
                                                    <td>合计</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>

                                                </tr>
                                                <tr>
                                                    <td colspan="2">预期情期受胎率</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                    <td>11</td>
                                                    <td>12</td>

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
