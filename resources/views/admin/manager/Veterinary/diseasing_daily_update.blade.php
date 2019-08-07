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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/manage/Veterinary/diseasing_list">诊疗登记</a></li>
    <li class="breadcrumb-item active" aria-current="page">诊疗更新</li>
  </ol>
</nav>
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
    <div class="card-header">
        <strong>{{$disease_info->cattleID}}--添加每日诊疗记录</strong>
  </div>
  <div class="card-body table-responsive">

                  <div class="card-body ">
                  <form action="/admin/manage/Veterinary/diseasing/daily_update/{{$disease_info->id}}" method="post" onkeydown="if(event.keyCode==13)return false;" >
                            {{csrf_field()}}
                                  <div class="form-group row">
                                    <label for="cattleID" class="col-sm-3 col-form-label">牛号</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="cattleID" name="cattleID" value="{{$disease_info->cattleID}}" disabled>
                                      <div class="check-feedback text-danger" hidden> </div>
                                    </div>
                                  </div>
                                
                                  <div class="form-group row">
                                          <label for="diseasename" class="col-sm-3 col-form-label">初步确定何种疾病</label>
                                          <div class="col-sm-9">
                                          <input type="text" class="form-control" id="diseasename" name="nameOfDisease" value="{{$disease_info->nameOfDisease}}" disabled>
                                          </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="new_dname" class="col-sm-3 col-form-label">疾病名称</label>
                                      <div class="col-sm-9 pt-2">
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="new_disease_name1" name="new_disease_name1" class="custom-control-input" value="0">
                                              <label class="custom-control-label" for="new_disease_name1">无变化</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="new_disease_name2" name="new_disease_name1" class="custom-control-input" value="1">
                                              <label class="custom-control-label" for="new_disease_name2">重新确诊疾病名</label>
                                            </div>
                                      </div>
                                      <div class="col-sm-9 offset-sm-3">
                                        <input type="text" class="form-control" id="new_dname" name="new_dname" placeholder="输入确诊疾病名" style="display:none;" >
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="treate_date" class="col-sm-3 col-form-label">记录日期</label>
                                        <div class="col-sm-9">
                                          <input type="date" class="form-control" id="treate_date" name="treate_date" value="{{date('Y-m-d')}}" required>
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
                                        <label for="note" class="col-sm-3 col-form-label">治疗方案附加说明（非必填）</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="note" name="note" >
                                        </div>
                                    </div>
                                 
                                    <div class="form-group row">
                                          <label for="PIC" class="col-sm-3 col-form-label">责任兽医</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="PIC" name="PIC" required>
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
<script src="/js/disease_update.js"></script>
<script src="/js/disease_input.js"></script>
@stop
