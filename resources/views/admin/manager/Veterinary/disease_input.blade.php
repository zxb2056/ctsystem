@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>诊疗登记</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.get_drug_info{
  position: relative;
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
<li class="nav-item"><a class="nav-link active" href="/admin/manage/Veterinary/diseasing_list">诊疗登记</a></li>
<li class="nav-item"><a class="nav-link" href="#">防疫登记</a></li>
<li class="nav-item"><a class="nav-link" href="#">检疫登记</a></li>
<li class="nav-item"><a class="nav-link" href="#">修蹄登记</a></li>
<li class="nav-item"><a class="nav-link" href="#">驱虫登记</a></li>
<li class="nav-item"><a class="nav-link" href="#">消毒登记</a></li>
</ul>
<ul class="nav nav-tabs bg-light my-1">
<li class="nav-item"><a class="nav-link" href="/admin/manage/Veterinary/diseasing_list">现有诊疗更新</a></li>
<li class="nav-item"><a class="nav-link  active" href="/admin/manage/Veterinary/disease_input">新增诊疗记录</a></li>
</ul>
@if(session('success'))
<div class="alert alert-success autohidereturn mt-1">
    {{session('success')}}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger autohidereturn mt-1">
    {{session('error')}}
</div>
@endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>诊疗记录表</strong></div>
                </div>
                <div class="card-body table-responsive">
                        <div class="card rounded-0 my-3">
                                <div class="card-header">
                                        <strong>增加疾病诊疗记录</strong>
                                </div>
                                <div class="card-body ">
                                        <form action="/admin/manage/Veterinary/disease_input" method="post" onkeydown="if(event.keyCode==13)return false;" >
                                          {{csrf_field()}}
                                                <div class="form-group row">
                                                  <label for="cattleID" class="col-sm-3 col-form-label">牛号</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="cattleID" name="cattleID" required>
                                                    <div class="check-feedback text-danger" hidden> </div>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="bodyWeight" class="col-sm-3 col-form-label">体重</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" id="bodyWeight" name="bodyWeight" placeholder="可以写估测体重" required>
                                                    </div>
                                                  </div>
                                                <div class="form-group row">
                                                  <label for="fabingriqi" class="col-sm-3 col-form-label">发病日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="fabingriqi" name="dateOfOnset" required>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="startTreatdate" class="col-sm-3 col-form-label">开始治疗日期</label>
                                                    <div class="col-sm-9">
                                                      <input type="date" class="form-control" id="startTreatdate" name="startTreatdate" required>
                                                    </div>
                                                  </div>
                                                <div class="form-group row">
                                                        <label for="diseasename" class="col-sm-3 col-form-label">初步确定何种疾病</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" id="diseasename" name="nameOfDisease" required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                      <label for="diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                      <div class="col-sm-9">
                                                          <textarea  class="form-control" id="treatMethod" name="symptom" placeholder="填写当日体温，精神状态，采食饮水等情况" required></textarea>
                                                      </div>
                                                </div>
                                                
                                                  <div class="form-group row">
                                                        <label for="treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                        <div class="col-sm-9">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap1" value="药物治疗">
                                                                <label class="form-check-label" for="inlineCheckbox1">药物治疗</label>
                                                              </div>
                                                              <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap2" value="输液">
                                                                <label class="form-check-label" for="inlineCheckbox2">输液</label>
                                                              </div>
                                                              <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap3" value="穿刺手术" >
                                                                <label class="form-check-label" for="inlineCheckbox3">穿刺手术</label>
                                                              </div>
                                                              <div class="form-check form-check-inline">
                                                                  <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap4" value="封闭疗法" >
                                                                  <label class="form-check-label" for="inlineCheckbox3">封闭疗法</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap5" value="瘤胃内容物疗法" >
                                                                    <label class="form-check-label" for="inlineCheckbox3">瘤胃内容物疗法</label>
                                                                  </div>
                                                                  <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap6" value="腹膜透析疗法" >
                                                                      <label class="form-check-label" for="inlineCheckbox3">腹膜透析疗法</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap7" value="灌肠法和破解术" >
                                                                        <label class="form-check-label" for="inlineCheckbox3">灌肠法和破解术</label>
                                                                      </div>
                                                                      <div class="form-check form-check-inline">
                                                                          <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap8" value="冲洗法" >
                                                                          <label class="form-check-label" for="inlineCheckbox3">冲洗法</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap9" value="物理疗法" >
                                                                            <label class="form-check-label" for="inlineCheckbox3">物理疗法</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                              <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap10" value="其它" >
                                                                              <label class="form-check-label" for="inlineCheckbox3">其它</label>
                                                                            </div>
                                                        </div>
                                                  </div>
                                                  <div class="form-group row" id="selectDrug" hidden>
                                                      <label for="drugUse" class="col-sm-3 col-form-label">选择使用的药物</label>
                                                      <input type="hidden" class="drug_id" name="drug_id">
                                                      <div class="col-sm-3 mt-1">
                                                        <input name="drugUse[]" id="drugUse" class="form-control get_drug_info" autocomplete='off' >
                                                      </div>
                                                      
                                                        <div class="input-group mt-1 col-sm-3 my-1">
                                                          <input type="text" class="form-control " id="dosage" placeholder="用量" name="dosage[]">
                                                          <div class="input-group-prepend">
                                                            <div class="input-group-text input_unit">ml</div>
                                                          </div>
                                                           </div>
                                                        <div class="col-sm-1  plusDrug">
                                                        <i class="fa fa-plus-circle text-danger" aria-hidden="true" style="cursor:pointer;">继续添加</i>
                                                      </div>
                                                      <div class="col-sm-1"></div>
                                                      </div>
                                                  <div class="form-group row">
                                                      <label for="zeren" class="col-sm-3 col-form-label">治疗方案附加说明（非必填）</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="zeren" name="PIC" >
                                                      </div>
                                                  </div>
                                               
                                                  <div class="form-group row">
                                                        <label for="zeren" class="col-sm-3 col-form-label">责任兽医</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" id="zeren" name="PIC" required>
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                    <label for="status1" class="col-sm-3 col-form-label">治疗状态</label>
                                                  <div class="col-sm-9">
                                                  <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="status1" name="status" class="custom-control-input" value="ing" required>
                                                    <label class="custom-control-label" for="status1">还需继续治疗</label>
                                                  </div>
                                                  <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="status2" name="status" class="custom-control-input" value="done" required>
                                                    <label class="custom-control-label" for="status2">治疗结束</label>
                                                  </div>
                                                </div>
                                                </div>
                                                <div class="form-group row" id="dailyResult" hidden>
                                                  <label for="dailycondition" class="col-sm-3 col-form-label">当日治疗后情况</label>
                                                  <div class="col-sm-9">
                                                    <select name="dailycondition" id="dailycondition" class="form-control">
                                                    <option value="好转">好转</option>
                                                    <option value="稳定">稳定</option>
                                                    <option value="加重">加重</option>
                                                  </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="treatmentResult" hidden>
                                                  <label for="result" class="col-sm-3 col-form-label">治疗结果</label>
                                                  <div class="col-sm-9">
                                                    <select name="outcome" id="result" class="form-control">
                                                      <option value="康复">康复</option>
                                                      <option value="恶化-建议淘汰">恶化-建议淘汰</option>
                                                      <option value="死亡">死亡</option>
                                                      <option value="久治不愈-建议淘汰">难以治愈-建议淘汰</option>

                                                    </select>
                                                  </div>
                                              </div>
                                  </div>
                                  <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success justify-content-end" type="submit" id="submit">提交</button>
                                      </div>
                                  </div>
                                </form>
            <div class="card-footer">
              说明：本表单全部必填。
            </div>
               
                  </div>
              
                  </div>
            
        </div>

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/check_cattle.js"></script>
<script src="/js/disease_input.js"></script>
@stop
