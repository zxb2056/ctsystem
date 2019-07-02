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
    <a class="nav-link active" href="{{url('/admin/manage/staff/staff_list')}}">员工列表</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/offWork')}}">请假</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/staff/attendance')}}">考勤</a>
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
                    <a href="" class="btn btn-sm btn-outline-primary ml-auto " data-toggle="modal" data-target="#staffModal">新增</a>

                </div>
                        
                        <form action="{{ url('/admin/manage/staff/staff_list')}}" method="get">
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
                            <input  type="text" class="form-control" id="staffName" name="name" value="{{ $datas[ 'name' ]}}"> 
                            </div>
                            </div>
                            <div class="form-group form-row col-lg-3">
                            <label for="querydate" class="col-sm-3 col-form-label">入职日期</label>
                            <div class="col-md-9">
                            <input type="date" class="form-control" name="startdate" value="{{ $datas[ 'startdate' ]}}" id="querydate">
                            </div> 
                            </div>
                            <div class="form-group form-row col-lg-3">
                                <label for="enddate" class="col-sm-3 col-form-label">截止日期</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" name="stopdate"  id="enddate" value="{{ $datas[ 'stopdate' ]}}"> 
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
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>员工姓名</th>
                            <th>性别</th>
                            <th>手机号</th>
                            <th>出生年月</th>
                            <th>入职日期</th>
                            <th>学历</th>
                            <th>毕业学校</th>
                            <th>所学专业</th>
                            <th>毕业日期</th>
                            <th>特长爱好</th>
                            <th>政治面貌</th>
                            <th>所属部门</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($staffs as $staff)
                        <tr>
                            <td>{{ (($staffs->currentPage() - 1 ) * $staffs->perPage() ) + $loop->iteration}}</td>
                            <td>{{$staff->name}}</td>
                            <td>{{$staff->gender}}</td>
                            <td>{{$staff->telephone}}</td>
                            <td>{{$staff->birthday}}</td>
                            <td>{{$staff->entryDate}}</td>
                            <td>{{$staff->eduDegree}}</td>
                            <td>{{$staff->school}}</td>
                            <td>{{$staff->major}}</td>
                            <td>{{$staff->gradudate}}</td>
                            <td>{{$staff->special}}</td>
                            <td>{{$staff->Political_status}}</td>
                            <td>部门是：</td>
                            <td class="d-flex" width="150">
                            <a type="button"  href='' class="btn btn-sm btn-outline-primary p-1 mx-1" data-toggle="modal" data-target="#updateModal" data-id="{{$staff->id}} " data-name="{{$staff->name}}" data-gender="{{ $staff->gender}}" data-telephone="{{ $staff->telephone }}" data-birthday ="{{ $staff->birthday }}" data-entrydate="{{ $staff->entryDate }}" data-edudegree="{{ $staff->eduDegree }}" data-school="{{ $staff->school }}" data-major="{{ $staff->major }}" data-gradudate="{{ $staff->gradudate }}" data-special="{{ $staff->special }}" data-political_status="{{$staff->Political_status }}">编辑</a>
                            <a type="button" href='' class="btn btn-sm btn-outline-primary mx-1 p-1">删除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
   
          </table>
          
                    </div>
            <div class="card-footer d-flex justify-content-center">
            {{$staffs->appends($datas)->links()}}
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
<script type="text/javascript">
$('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id=button.data('id')
    var name=button.data('name')
    var gender=button.data('gender')
    var telephone=button.data('telephone')
    var birthday=button.data('birthday')
    var entryDate=button.data('entrydate')
    var eduDegree=button.data('edudegree')
    var school=button.data('school')
    var major=button.data('major')
    var gradudate=button.data('gradudate')
    var special=button.data('special')
    var Political_status=button.data('political_status')
    var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #staffname').val(name)
  modal.find('.modal-body #staffPhone').val(telephone)
  modal.find('.modal-body #birthDay').val(birthday)
  modal.find('.modal-body #enterDate').val(entryDate)
  modal.find('.modal-body #Education').val(eduDegree)
  modal.find('.modal-body #Graduate_school').val(school)
  modal.find('.modal-body #major').val(major)
  modal.find('.modal-body #gradudate').val(gradudate)
  modal.find('.modal-body #special').val(special)
  modal.find('.modal-body #Political_status').val(Political_status)
  if(gender == '男'){
    modal.find('.modal-body input#upinlineRadio1').prop('checked','checked')
  }else{
    modal.find('.modal-body input#upinlineRadio2').prop('checked','checked')
  }
 

})
</script>
@stop
