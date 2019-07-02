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
    <a class="nav-link " href="{{url('/admin/manage/staff/staff_list')}}">员工列表</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/offWork')}}">请假</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/admin/manage/staff/attendance')}}">考勤</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/partment')}}">部门管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/tmpworker')}}">临时用工</a>
  </li>

</ul>
<div class="card rounded-0 my-3">
                                @if(count($errors) >0)
                                <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                                </div>
                                @endif
                <div class="card-header d-flex">
                    <h5><strong>员工列表</strong></h5>
                    <form action="/admin/manage/staff/uploadattendance" method="POST" enctype="multipart/form-data" class="ml-auto border">
                                {{csrf_field()}}
                                <input type="file" name="attendancexls" >
                                <button type="submit">导入</button>
                                </form>
                   

                </div>
                <form action="{{ url('/admin/manage/staff/attendance')}}" method="get">
                        <div class="card-header">
                        <div class="form-row">
                        <div class="form-group form-row col-lg-3">
                        <label for="showitem" class="col-md-3 col-form-label">每页显示</label>
                        <div class="col-md-9">
                                <select name="showitem" id="showitem" class="form-control" >
                                <option value="10" @if(!$datas || $datas[ 'showitem' ]==10) selected @endif>10</option>
                                <option value="20" @if($datas[ 'showitem' ]==20) selected @endif>20条</option>
                                <option value="30" @if($datas[ 'showitem' ]==30) selected @endif>30条</option>
                                <option value="50" @if($datas[ 'showitem' ]==50) selected @endif>50条</option>
                                </select>
                                </div>
                                </div>
                                <div class="form-group form-row col-lg-3">
                                <label for="staffName" class="col-md-3 col-form-label">姓名</label> 
                            <div class="col-md-9">
                            <input  type="text" class="form-control" id="staffName" name="name" value="{{ $datas['name']}}"> 
                            </div>
                            </div>
                            <div class="form-group form-row col-lg-3">
                                <label for="month" class="col-md-3 col-form-label">月份</label> 
                            <div class="col-md-9">
                            <select name="month" id="month" class="form-control" >
                            <option value="" >指定月份</option>
                            @foreach($months as $month)
                                <option value="{{$month}}" >{{$month}}</option>
                            @endforeach
                            </select>
                            </div>
                            </div>
                                <div class="form-group  form-row col-lg-3" >
                                <div class="col-md-6">
                                <input  type="submit" class="btn btn-sm btn-outline-success form-control">
                                </div>
                            </div>
                            </div>
                                </form>
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-sm table-hover table-bordered" style="font-size:12px;">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>员工姓名</th>
                            <th>年月</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>17</th>
                            <th>18</th>
                            <th>19</th>
                            <th>20</th>
                            <th>21</th>
                            <th>22</th>
                            <th>23</th>
                            <th>24</th>
                            <th>25</th>
                            <th>26</th>
                            <th>27</th>
                            <th>28</th>
                            <th>29</th>
                            <th>30</th>
                            <th>31</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($attends as $attend)
                   <tr>
                            <td>{{ (($attends->currentPage() - 1 ) * $attends->perPage() ) + $loop->iteration}}</td>
                            <td>{{$attend->name}}</td>
                            <td>{{$attend->month}}</td>
                            <td>{{$attend->day1}}</td>
                            <td>{{$attend->day2}}</td>
                            <td>{{$attend->day3}}</td>
                            <td>{{$attend->day4}}</td>
                            <td>{{$attend->day5}}</td>
                            <td>{{$attend->day6}}</td>
                            <td>{{$attend->day7}}</td>
                            <td>{{$attend->day8}}</td>
                            <td>{{$attend->day9}}</td>
                            <td>{{$attend->day10}}</td>
                            <td>{{$attend->day11}}</td>
                            <td>{{$attend->day12}}</td>
                            <td>{{$attend->day13}}</td>
                            <td>{{$attend->day14}}</td>
                            <td>{{$attend->day15}}</td>
                            <td>{{$attend->day16}}</td>
                            <td>{{$attend->day17}}</td>
                            <td>{{$attend->day18}}</td>
                            <td>{{$attend->day19}}</td>
                            <td>{{$attend->day20}}</td>
                            <td>{{$attend->day21}}</td>
                            <td>{{$attend->day22}}</td>
                            <td>{{$attend->day23}}</td>
                            <td>{{$attend->day24}}</td>
                            <td>{{$attend->day25}}</td>
                            <td>{{$attend->day26}}</td>
                            <td>{{$attend->day27}}</td>
                            <td>{{$attend->day28}}</td>
                            <td>{{$attend->day29}}</td>
                            <td>{{$attend->day30}}</td>
                            <td>{{$attend->day31}}</td>
                            <td>
                            <a type="button" href='{{url("/admin/manage/staff/delete_attendance/{$attend->id}")}}' class="btn btn-sm btn-outline-primary mx-1 p-1" onclick="return disp_confirm()">删除</a>
                            </td>
                            </tr>

                   @endforeach
                    </tbody>

          </table>
                    </div>

            <div class="card-footer">
            {{$attends->appends($datas)->links()}}
            </div>
                    </div>
                </div>
            </div>
    </div>
      
<!-- listModal -->
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新增员工</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>新增员工</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/add_staff" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="addstaffname" class="col-sm-3 col-form-label">员工姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addstaffname" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label">员工性别</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input class="custom-control-input " type="radio" name="gender" id="addinlineRadio1"
                                            value="1"  checked="checked" >
                                        <label class="custom-control-label " for="addinlineRadio1" >男</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="gender" id="addinlineRadio2"
                                            value="2" >
                                        <label class="custom-control-label" for="addinlineRadio2">女</label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addstaffPhone" class="col-sm-3 col-form-label">员工手机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addstaffPhone" name="telephone" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addbirthDay" class="col-sm-3 col-form-label">出生年月</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addbirthDay" name="birthday">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addenterday" class="col-sm-3 col-form-label">入职日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addenterday" name="entryDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addEducation" class="col-sm-3 col-form-label">学历</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addEducation" name="eduDegree">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addGraduate_school" class="col-sm-3 col-form-label">毕业学校</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addGraduate_school" name="school">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addmajor" class="col-sm-3 col-form-label">所学专业</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addmajor" name="major">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addgradudate" class="col-sm-3 col-form-label">毕业时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="addgradudate" name="gradudate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addspecial" class="col-sm-3 col-form-label">特长爱好</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addspecial" name="special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addPolitical_status" class="col-sm-3 col-form-label">政治面貌</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addPolitical_status" name="Political_status">
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
<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-2" role="dialog"  data-backdrop="static">
<div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">修改员工信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card rounded-0 my-3">
                <div class="card-header">
                    <strong>修改员工信息</strong>
                </div>
                <div class="card-body ">
                    <form action="/admin/manage/staff/edit_staff" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="staffname" class="col-sm-3 col-form-label">员工姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staffname" name="name" required>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-3 col-form-label">员工性别</label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input class="custom-control-input " type="radio" name="gender" id="upinlineRadio1" value="1" >
                                        <label class="custom-control-label " for="upinlineRadio1" >男</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="gender" id="upinlineRadio2"  value="2" >
                                        <label class="custom-control-label" for="upinlineRadio2">女</label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staffPhone" class="col-sm-3 col-form-label">员工手机号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staffPhone" name="telephone" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthDay" class="col-sm-3 col-form-label">出生年月</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birthDay" name="birthday">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="enterDate" class="col-sm-3 col-form-label">入职日期</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="enterDate" name="entryDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Education" class="col-sm-3 col-form-label">学历</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Education" name="eduDegree">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Graduate_school" class="col-sm-3 col-form-label">毕业学校</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Graduate_school" name="school">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="major" class="col-sm-3 col-form-label">所学专业</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="major" name="major">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gradudate" class="col-sm-3 col-form-label">毕业时间</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="gradudate" name="gradudate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="special" class="col-sm-3 col-form-label">特长爱好</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="special" name="special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Political_status" class="col-sm-3 col-form-label">政治面貌</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Political_status" name="Political_status">
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

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/disp_confirm.js"></script>
@stop
