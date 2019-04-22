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
                    <div class="mr-auto"><strong>员工列表</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>每页显示：</span>
                                <select name="pepleNum" >
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                </select>
                                <span class="ml-2">条</span>
                                
                                <a href="" class="btn btn-sm btn-outline-primary ml-auto" data-toggle="modal" data-target="#staffModal">新增</a>
                            </div> 
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
                   
                    </tbody>

          </table>
                    </div>
            <div class="card-footer">
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

@stop
