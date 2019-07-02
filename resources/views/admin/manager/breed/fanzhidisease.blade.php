@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>繁殖疾病诊疗</title>
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
      <a class="nav-link  active" href="{{url('/admin/manage/breed/fanzhidisease')}}">繁殖病症诊疗卡</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/expected_birth')}}">预产期明细</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/manage/breed/mateplan')}}">配种计划表</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/manage/breed/fanzhibaobiao')}}">繁殖报表</a>
    </li>
  </ul>
    @if(!empty(session('success')))
  　　<div class="alert alert-success autohidereturn" role="alert">
  　　　　{{session('success')}}
  　　</div>
      @endif
          @if(!empty(session('error')))
      　　<div class="alert alert-danger autohidereturn" role="alert">
      　　　　{{session('error')}}
      　　</div>
          @endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>繁殖疾病表</strong></div>
                        <div><button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#diseaseModal">增加</button></div>
                </div>
                <div class="card-header">
                    <form action="/admin/manage/breed/fanzhidisease" method="get">
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
                                                <div class="input-group-text">冻精号</div>
                                              </div>
                                            <input type="text" class="form-control" id="getCowID" name="cowID" value="{{$datas['cowID']}}">
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
                            <th>母牛号</th>
                            <th>发病日期</th>
                            <th>何种疾病</th>
                            <th>症状描述</th>
                            <th width="200px">治疗方案</th>
                            <th>治疗结果</th>
                            <th>责任兽医</th>
                            <th>操作</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($fanzhiDiseases as $fanzhiDisease)
                        <tr>
                            <td>{{(($fanzhiDiseases->currentPage()-1)*$fanzhiDiseases->perPage())+$loop->iteration}}</td>
                        <td>{{$fanzhiDisease->cowID}}</td>
                        <td>{{$fanzhiDisease->dayOfOnset}}</td>
                        <td>{{$fanzhiDisease->diseaseName}}</td>
                            <td>{{$fanzhiDisease->symptom}}</td>
                            <td>{{$fanzhiDisease->therapeutic}}</td>
                            <td>{{$fanzhiDisease->result}}</td>
                            <td>{{$fanzhiDisease->PIC}}</td>
                        <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="{{$fanzhiDisease->id}}" data-cowid="{{$fanzhiDisease->cowID}}" data-onsetday="{{$fanzhiDisease->dayOfOnset}}" data-diseasename="{{$fanzhiDisease->diseaseName}}" data-symptom="{{$fanzhiDisease->symptom}}" data-therapeutic="{{ $fanzhiDisease->therapeutic }}" data-result="{{$fanzhiDisease->result}}" data-pic="{{$fanzhiDisease->PIC}}" data-target="#UpdiseaseModal">编辑</button></td>
                        </tr>
                      @endforeach
                    </tbody>
          </table>
                  </div>
              <div class="card-footer d-flex justify-content-center">
                {{$fanzhiDiseases->appends($datas)->links()}}
              </div>
                  </div>
<!-- Modal -->
<div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">繁殖疾病诊疗卡</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="card rounded-0 my-3">
                            <div class="card-header">
                                    <strong>繁殖疾病诊疗卡</strong> 
                            </div>
                            <div class="card-body ">
                                    <form action="/admin/manage/breed/disease/store" method="post">
                                      {{csrf_field()}}
                                            <div class="form-group row">
                                              <label for="cowID" class="col-sm-3 col-form-label">牛号</label>
                                              <div class="col-sm-9">
                                                <input type="text" class="form-control" id="cowID" name="cowID" required>
                                                <input type="hidden" name="id" id="fanzhiID">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="dayOfOnset" class="col-sm-3 col-form-label">发病日期</label>
                                              <div class="col-sm-9">
                                                <input type="date" class="form-control" id="dayOfOnset" name="dayOfOnset" value="<?php echo date('Y-m-d'); ?>" required>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="diseaseName" class="col-sm-3 col-form-label">何种疾病</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" id="diseaseName" name="diseaseName" required>
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="symptom" class="col-sm-3 col-form-label">症状描述</label>
                                                        <div class="col-sm-9">
                                                          <textarea  class="form-control" id="symptom" name="symptom" required></textarea>
                                                        </div>
                                                      </div>
                                                  <div class="form-group row">
                                                        <label for="therapeutic" class="col-sm-3 col-form-label">治疗方案</label>
                                                        <div class="col-sm-9">
                                                          <textarea  class="form-control" id="therapeutic" name="therapeutic" required></textarea>
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                            <label for="result" class="col-sm-3 col-form-label">治疗结果</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" id="result" name="result">
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="PIC" class="col-sm-3 col-form-label">责任兽医</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" id="PIC" name="PIC">
                                                                </div>
                                                              </div>
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
<!-- 更新Modal -->
<div class="modal fade" id="UpdiseaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">繁殖疾病诊疗卡</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="card rounded-0 my-3">
                        <div class="card-header">
                                <strong>繁殖疾病诊疗卡</strong> 
                        </div>
                        <div class="card-body ">
                                <form action="/admin/manage/breed/disease/update" method="post">
                                  {{csrf_field()}}
                                        <div class="form-group row">
                                          <label for="cowID" class="col-sm-3 col-form-label">牛号</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="upcowID" name="cowID" disabled>
                                            <input type="hidden" name="id" id="upfanzhiID">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="dayOfOnset" class="col-sm-3 col-form-label">发病日期</label>
                                          <div class="col-sm-9">
                                            <input type="date" class="form-control" id="updayOfOnset" name="dayOfOnset" value="<?php echo date('Y-m-d'); ?>" disabled>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="diseaseName" class="col-sm-3 col-form-label">何种疾病</label>
                                                <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="updiseaseName" name="diseaseName" disabled>
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                    <label for="symptom" class="col-sm-3 col-form-label">症状描述</label>
                                                    <div class="col-sm-9">
                                                      <textarea  class="form-control" id="upsymptom" name="symptom"></textarea>
                                                    </div>
                                                  </div>
                                              <div class="form-group row">
                                                    <label for="therapeutic" class="col-sm-3 col-form-label">治疗方案</label>
                                                    <div class="col-sm-9">
                                                      <textarea  class="form-control" id="uptherapeutic" name="therapeutic" required></textarea>
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="result" class="col-sm-3 col-form-label">治疗结果</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" id="upresult" name="result">
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                            <label for="PIC" class="col-sm-3 col-form-label">责任兽医</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" id="upPIC" name="PIC" disabled>
                                                            </div>
                                                          </div>
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
@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/autohideerror.js"></script>
<script type="text/javascript">
$('#UpdiseaseModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var cowID = button.data('cowid')
  var dayOfOnset = button.data('onsetday')
  var diseaseName = button.data('diseasename')
  var symptom = button.data('symptom')
  var therapeutic=button.data('therapeutic')
  var result = button.data('result')
  var PIC = button.data('pic')
  var modal = $(this)
  modal.find('.modal-body #upfanzhiID').val(id)
  modal.find('.modal-body #upcowID').val(cowID)
  modal.find('.modal-body #updayOfOnset').val(dayOfOnset)
  modal.find('.modal-body #updiseaseName').val(diseaseName)
  modal.find('.modal-body #upsymptom').val(symptom)
  modal.find('.modal-body #uptherapeutic').val(therapeutic)
  modal.find('.modal-body #upresult').val(result)
  modal.find('.modal-body #upPIC').val(PIC)

})
</script>

@stop
