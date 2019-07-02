@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>外购怀孕牛配种记录</title>
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
      <a class="nav-link" href="{{url('/admin/manage/basic/cattleinfo')}}">牛只基本信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/barninfo')}}">牛舍信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/barnmapindividual')}}">配置牛舍</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/sireinfos')}}">公牛信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/admin/manage/basic/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
      </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/cattle-eliminate')}}">牛只淘汰</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/basic/cattle-sale-common')}}">牛只出栏</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/manage/basic/breed_code')}}">品种代码</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">公牛查询结果</a>
    </li>
  </ul>
  @if(!empty(session('mateSuccess')))
  　　<div class="alert alert-success" role="alert">
  　　　　{{session('mateSuccess')}}
  　　</div>
     @endif
      @if(!empty(session('success')))
  　　<div class="alert alert-success" role="alert">
  　　　　{{session('success')}}
  <br>请及时完善系谱信息，没有系谱也要完善基本信息，才能进行后续工作。<a href="/admin/manage/basic/cattle-pedigree">点击完善</a>
  　　</div>
     @endif
    @if(!empty(session('prompt')))
    　　<div class="alert alert-success" role="alert">
    　　　　{{session('prompt')}}
    　　</div>
        @endif
    @if(!empty(session('error')))
　　<div class="alert alert-danger" role="alert">
　　　　{{session('error')}}
      
　　</div>
    @endif

<div class="accordion" id="matecollapse">
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                     <h5 class="mr-auto"><strong>外购及现有怀孕牛配种数据录入</strong></h5> 
                      <a href="" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addSemenModal" title="新增"><i class="fa fa-save"></i><span class="hidden-xs">冻精信息录入</span></a> 
                  </div>
                <div class="card-body table-responsive">
                <form action="/admin/manage/basic/outpreg/mate_record_store" method="post">
                  {{csrf_field()}}
                    <div class="form-group row">
                        <label for="cowID_" class="col-sm-2 col-form-label col-form-label-sm">母牛号</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="cowID" name="cowID" value="{{old('cowID')}}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="semenNum" class="col-sm-2 col-form-label">冻精号</label>
                        <div class="col-sm-10">
                          <select name="semen_id" id="semenNum" class="form-control">
                            <option value="1">不知道</option>
                            @foreach($semens as $semen)
                          <option value="{{$semen->id}}">{{$semen->semenNum}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">配种日期</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="date"  name="mateDate" @if(empty(old('mateDate'))) value="" @else value="{{old('mateDate')}}" @endif required>
                        </div>
                      </div>
                       <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success justify-content-end" type="submit">提交</button>
                      </div>
                     
                </form>
            
               
                  </div>
                  <div class="card-footer">
   
                  </div>
                  </div>
                </div>
                <div class=" bg-light my-2">
                  <h5>说明：</h5>
                  <p style="color:red">冻精提交后，必须完善公牛库才能选择！！</p>
                  <p>外购怀孕牛的配种记录往往不全.如果有冻精号，点击右上角，录入冻精信息，然后完善牧场公牛库，尽量提供系谱。</p>
                  <p>配种日期写个大概日期就可以,不能空。</p>
                  <p>牧场现有牛只的配种记录，也在这里输入,先完善冻精信息，公牛库，才能选择。</p>
              </div>

 <!-- addcattleModal -->
 <div class="modal fade" id="addSemenModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">冻精信息录入</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header">
                        <strong>冻精信息录入</strong>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/manage/basic/outpreg/semen_store" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group form-row">
                                <label for="semenNum" class="col-sm-3 col-form-label">冻精号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="semenNum" name="semenNum" required>
                                </div>
                            </div>                     
                            <div class="form-group form-row">
                                <label for="company" class="col-sm-3 col-form-label">所属公司</label>
                                <div class="col-sm-9">
                                  <select name="company" id="company" class="form-control">
                                    <option value="">选择公司</option>
                                      @foreach ($companys as $company)
                                        <option value="{{$company->id}}">{{$company->companyName}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label for="frozenType" class="col-sm-3 col-form-label">精液类型</label>
                                <div class="col-sm-9">
                                <select name="frozenType" id="frozenType" class="form-control">
                                <option value="普精">普精</option>
                                <option value="性控">性控</option>
                                </select>
                                </div>
                            </div>   

                            <div class="form-group form-row">
                                <label for="breed" class="col-sm-3 col-form-label">品种</label>
                                <div class="col-sm-9">
                                  <select name="breed" id="breed" class="form-control">
                                      <option value="">选择品种</option>
                                    @foreach ($breedvarieties as $breed)
                                    <option value="{{$breed->id}}">{{$breed->name}}</option>
                                    @endforeach
                                  </select>
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
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
@stop
