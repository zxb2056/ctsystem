@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>修蹄登记</title>
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
@if(session('warn'))
<div class="alert alert-warning">
  {{session('warn')}}
</div>
@endif
@if(session('success'))
<div class="alert alert-success">
  {{session('success')}}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
  {{session('error')}}
</div>
@endif
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>修蹄记录</strong></div>
                </div>
                <div class="card-body table-responsive">
                        <div class="card rounded-0 my-3">
                                <div class="card-header">
                                        <strong>修蹄登记</strong>
                                </div>
                                <div class="card-body ">
                                        <form action="/admin/manage/Veterinary/trim_hoof/store" method="post" onkeydown="if(event.keyCode==13)return false;" >
                                          {{csrf_field()}}
                                                <div class="form-group row">
                                                  <label for="cattleID" class="col-sm-3 col-form-label">牛号</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="cattleID" name="cattleID">
                                                    <div class="check-feedback text-danger" hidden> </div>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label for="trim_day" class="col-sm-3 col-form-label">修蹄日期</label>
                                                  <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="trim_day" name="trim_day">
                                                  </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label for="pic" class="col-sm-3 col-form-label">责任兽医</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" id="pic" name="pic">
                                                    </div>
                                                  </div>
                                                <div class="form-group row">
                                                        <label for="trim_num" class="col-sm-3 col-form-label">修蹄数量</label>
                                                        <div class="col-sm-9">
                                                                      <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="left-front" value="1" name="hoof[]">
                                                                            <label class="form-check-label" for="left-front">左前蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="right-front" value="2" name="hoof[]">
                                                                            <label class="form-check-label" for="right-front">右前蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="left-back" value="3" name="hoof[]">
                                                                            <label class="form-check-label" for="left-back">左后蹄</label>
                                                                          </div>
                                                                          <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="checkbox" id="right-back" value="4" name="hoof[]">
                                                                                <label class="form-check-label" for="right-back">右后蹄</label>
                                                                              </div>
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                          <label for="diseaseOrCare1" class="col-sm-3 col-form-label">有无病蹄</label>
                                                        <div class="col-sm-9">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                          <input type="radio" id="diseaseOrCare1" name="diseaseOrCare" class="custom-control-input" value="0" required>
                                                          <label class="custom-control-label" for="diseaseOrCare1">普修</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                          <input type="radio" id="diseaseOrCare2" name="diseaseOrCare" class="custom-control-input" value="1" required>
                                                          <label class="custom-control-label" for="diseaseOrCare2">有病蹄</label>
                                                        </div>
                                                      </div>
                                                      </div>
                                                    <div class="container disease_show" style="display:none;">
                                                      <div class="row">
                                                          <div class="col-lg-5 border border-warning mr-1" id="left-front-div">
                                                              <div class="form-row justify-content-center">
                                                              <div class="alert alert-info alert-rounded text-center w-50" role="alert" >
                                                                  <div class="h5">左前蹄</div>
                                                                </div>
                                                              </div>
                                                              <div class="form-group row " id="ifhoof_ill">
                                                                  <label for="LF_diseaseOrCare1" class="col-sm-3 col-form-label">有无病蹄</label>
                                                                <div class="col-sm-9">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="LF_diseaseOrCare1" name="LF_diseaseOrCare" class="custom-control-input" value="0" checked>
                                                                  <label class="custom-control-label" for="LF_diseaseOrCare1">普修</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="LF_diseaseOrCare2" name="LF_diseaseOrCare" class="custom-control-input" value="1">
                                                                  <label class="custom-control-label" for="LF_diseaseOrCare2">病蹄</label>
                                                                </div>
                                                              </div>
                                                              </div>
                                                              <div style="display:none;" class="form-group row">
                                                                  <label for="LF_diseasename" class="col-sm-3 col-form-label">何种蹄病</label>
                                                                  <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="LF_diseasename" name="LF_diseasename" placeholder="病名或保健性修蹄">
                                                                  </div>
                                                                </div>
                                                                <div style="display:none;" class="form-group row">
                                                                      <label for="LF_diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                                      <div class="col-sm-9">
                                                                              <textarea  class="form-control" id="LF_diseaseCondition" name="LF_diseaseCondition" placeholder="保健修蹄可以写无"></textarea>
                                                                      </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row">
                                                                        <label for="LF_treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap1" value="药物治疗">
                                                                                <label class="form-check-label" for="therap1">药物治疗</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap2" value="输液">
                                                                                <label class="form-check-label" for="therap2">输液</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap3" value="穿刺手术" >
                                                                                <label class="form-check-label" for="therap3">穿刺手术</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                  <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap4" value="封闭疗法" >
                                                                                  <label class="form-check-label" for="therap4">封闭疗法</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap5" value="瘤胃内容物疗法" >
                                                                                    <label class="form-check-label" for="therap5">瘤胃内容物疗法</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                      <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap6" value="腹膜透析疗法" >
                                                                                      <label class="form-check-label" for="therap6">腹膜透析疗法</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap7" value="灌肠法和破解术" >
                                                                                        <label class="form-check-label" for="therap7">灌肠法和破解术</label>
                                                                                      </div>
                                                                                      <div class="form-check form-check-inline">
                                                                                          <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap8" value="冲洗法" >
                                                                                          <label class="form-check-label" for="therap8">冲洗法</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap9" value="物理疗法" >
                                                                                            <label class="form-check-label" for="therap9">物理疗法</label>
                                                                                          </div>
                                                                                          <div class="form-check form-check-inline">
                                                                                              <input class="form-check-input" name="therapeuticway[]" type="checkbox" id="therap10" value="其它" >
                                                                                              <label class="form-check-label" for="therap10">其它</label>
                                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="selectDrug" hidden>
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
                                                                        <i class="fa fa-plus-circle text-danger" aria-hidden="true" style="cursor:pointer;">添加</i>
                                                                      </div>
                                                                      <div class="col-sm-1"></div>
                                                                      </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="LF_note" class="col-sm-3 col-form-label">方案说明（选填）</label>
                                                                      <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="LF_note" name="LF_note" >
                                                                      </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="status1" class="col-sm-3 col-form-label">治疗状态</label>
                                                                    <div class="col-sm-9">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="status1" name="LF_status" class="custom-control-input" value="ing" >
                                                                      <label class="custom-control-label" for="status1">蹄病需继续治疗</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="status2" name="LF_status" class="custom-control-input" value="done">
                                                                      <label class="custom-control-label" for="status2">修蹄结束</label>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="dailyResult" hidden>
                                                                      <label for="dailycondition" class="col-sm-3 col-form-label">当日治疗后情况</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="dailycondition" id="dailycondition" class="form-control">
                                                                        <option value="好转">好转</option>
                                                                        <option value="稳定">稳定</option>
                                                                        <option value="加重">加重</option>
                                                                      </select>
                                                                        </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row" id="treatmentResult" hidden>
                                                                      <label for="result" class="col-sm-3 col-form-label">修蹄结果</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="outcome" id="result" class="form-control">
                                                                          
                                                                          <option value="康复">康复</option>
                                                                          <option value="久治不愈-建议淘汰">难以治愈-建议淘汰</option>
                    
                                                                        </select>
                                                                      </div>
                                                                  </div>
    
                                                          </div>
                                                          <div class="col-lg-5 border border-warning ml-1" id="right-front-div">
                                                              <div class="form-row justify-content-center">
                                                                  <div class="alert alert-info alert-rounded text-center w-50" role="alert" >
                                                                      <div class="h5">右前蹄</div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="form-group row" id="RF_ifhoof_ill">
                                                                      <label for="RF_diseaseOrCare1" class="col-sm-3 col-form-label">有无病蹄</label>
                                                                    <div class="col-sm-9">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="RF_diseaseOrCare1" name="RF_diseaseOrCare" class="custom-control-input" value="0" checked>
                                                                      <label class="custom-control-label" for="RF_diseaseOrCare1">普修</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="RF_diseaseOrCare2" name="RF_diseaseOrCare" class="custom-control-input" value="1" >
                                                                      <label class="custom-control-label" for="RF_diseaseOrCare2">病蹄</label>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row ">
                                                                      <label for="LF_diseasename" class="col-sm-3 col-form-label">何种蹄病</label>
                                                                      <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="RF_diseasename" name="RF_diseasename" placeholder="病名">
                                                                      </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row">
                                                                          <label for="LF_diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                                          <div class="col-sm-9">
                                                                                  <textarea  class="form-control" id="RF_diseaseCondition" name="RF_diseaseCondition" placeholder=""></textarea>
                                                                          </div>
                                                                        </div>
                                                                        <div style="display:none;" class="form-group row">
                                                                            <label for="RF_treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap1" value="药物治疗">
                                                                                    <label class="form-check-label" for="RF_therap1">药物治疗</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap2" value="输液">
                                                                                    <label class="form-check-label" for="RF_therap2">输液</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap3" value="穿刺手术" >
                                                                                    <label class="form-check-label" for="RF_therap3">穿刺手术</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                      <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap4" value="封闭疗法" >
                                                                                      <label class="form-check-label" for="RF_therap4">封闭疗法</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap5" value="瘤胃内容物疗法" >
                                                                                        <label class="form-check-label" for="RF_therap5">瘤胃内容物疗法</label>
                                                                                      </div>
                                                                                      <div class="form-check form-check-inline">
                                                                                          <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap6" value="腹膜透析疗法" >
                                                                                          <label class="form-check-label" for="RF_therap6">腹膜透析疗法</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap7" value="灌肠法和破解术" >
                                                                                            <label class="form-check-label" for="RF_therap7">灌肠法和破解术</label>
                                                                                          </div>
                                                                                          <div class="form-check form-check-inline">
                                                                                              <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap8" value="冲洗法" >
                                                                                              <label class="form-check-label" for="RF_therap8">冲洗法</label>
                                                                                            </div>
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap9" value="物理疗法" >
                                                                                                <label class="form-check-label" for="RF_therap9">物理疗法</label>
                                                                                              </div>
                                                                                              <div class="form-check form-check-inline">
                                                                                                  <input class="form-check-input" name="RF_therapeuticway[]" type="checkbox" id="RF_therap10" value="其它" >
                                                                                                  <label class="form-check-label" for="RF_therap10">其它</label>
                                                                                                </div>
                                                                            </div>
                                                                      </div>
                                                                      <div style="display:none;" class="form-group row" id="RF_selectDrug" hidden>
                                                                          <label for="drugUse" class="col-sm-3 col-form-label">选择使用的药物</label>
                                                                          <input type="hidden" class="RF_drug_id" name="RF_drug_id">
                                                                          <div class="col-sm-3 mt-1">
                                                                            <input name="RF_drugUse[]" id="RF_drugUse" class="form-control get_drug_info" autocomplete='off' >
                                                                          </div>
                                                                          
                                                                            <div class="input-group mt-1 col-sm-3 my-1">
                                                                              <input type="text" class="form-control " id="RF_dosage" placeholder="用量" name="RF_dosage[]">
                                                                              <div class="input-group-prepend">
                                                                                <div class="input-group-text RF_input_unit">ml</div>
                                                                              </div>
                                                                              </div>
                                                                            <div class="col-sm-1  RF_plusDrug">
                                                                            <i class="fa fa-plus-circle text-danger" aria-hidden="true" style="cursor:pointer;">添加</i>
                                                                          </div>
                                                                          <div class="col-sm-1"></div>
                                                                          </div>
                                                                      <div style="display:none;" class="form-group row">
                                                                          <label for="RF_note" class="col-sm-3 col-form-label">方案说明（选填）</label>
                                                                          <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="RF_note" name="RF_note" >
                                                                          </div>
                                                                      </div>
                                                                      <div style="display:none;" class="form-group row">
                                                                          <label for="RF_status1" class="col-sm-3 col-form-label">治疗状态</label>
                                                                        <div class="col-sm-9">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                          <input type="radio" id="RF_status1" name="RF_status" class="custom-control-input" value="ing" >
                                                                          <label class="custom-control-label" for="RF_status1">蹄病需继续治疗</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                          <input type="radio" id="RF_status2" name="RF_status" class="custom-control-input" value="done">
                                                                          <label class="custom-control-label" for="RF_status2">修蹄结束</label>
                                                                        </div>
                                                                      </div>
                                                                      </div>
                                                                      <div style="display:none;" class="form-group row" id="RF_dailyResult" hidden>
                                                                          <label for="RF_dailycondition" class="col-sm-3 col-form-label">治疗状态</label>
                                                                          <div class="col-sm-9">
                                                                            <select name="RF_dailycondition" id="RF_dailycondition" class="form-control">
                                                                            <option value="好转">好转</option>
                                                                            <option value="稳定">稳定</option>
                                                                            <option value="加重">加重</option>
                                                                          </select>
                                                                            </div>
                                                                        </div>
                                                                        <div style="display:none;" class="form-group row" id="RF_treatmentResult" hidden>
                                                                          <label for="RF_result" class="col-sm-3 col-form-label">修蹄结果</label>
                                                                          <div class="col-sm-9">
                                                                            <select name="RF_outcome" id="RF_result" class="form-control">
                                                                              <option value="康复">康复</option>
                                                                              <option value="久治不愈-建议淘汰">难以治愈-建议淘汰</option>
                                                                            </select>
                                                                          </div>
                                                                      </div>
                                                          </div>
                                                          <div class="col-lg-5 border border-warning mt-1 mr-1" id="left-back-div">
                                                              <div class="form-row justify-content-center">
                                                              <div class="alert alert-info alert-rounded text-center w-50" role="alert" >
                                                                  <div class="h5">左后蹄</div>
                                                                </div>
                                                              </div>
                                                              <div class="form-group row " id="LB_ifhoof_ill">
                                                                  <label for="LB_diseaseOrCare1" class="col-sm-3 col-form-label">有无病蹄</label>
                                                                <div class="col-sm-9">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="LB_diseaseOrCare1" name="LB_diseaseOrCare" class="custom-control-input" value="0" checked>
                                                                  <label class="custom-control-label" for="LB_diseaseOrCare1">普修</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="LB_diseaseOrCare2" name="LB_diseaseOrCare" class="custom-control-input" value="1">
                                                                  <label class="custom-control-label" for="LB_diseaseOrCare2">病蹄</label>
                                                                </div>
                                                              </div>
                                                              </div>
                                                              <div style="display:none;" class="form-group row">
                                                                  <label for="LB_diseasename" class="col-sm-3 col-form-label">何种蹄病</label>
                                                                  <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="LB_diseasename" name="LB_diseasename" placeholder="病名">
                                                                  </div>
                                                                </div>
                                                                <div style="display:none;" class="form-group row">
                                                                      <label for="LB_diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                                      <div class="col-sm-9">
                                                                              <textarea  class="form-control" id="LB_diseaseCondition" name="LB_diseaseCondition" placeholder=""></textarea>
                                                                      </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row">
                                                                        <label for="LB_treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap1" value="药物治疗">
                                                                                <label class="form-check-label" for="LB_therap1">药物治疗</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap2" value="输液">
                                                                                <label class="form-check-label" for="LB_therap2">输液</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap3" value="穿刺手术" >
                                                                                <label class="form-check-label" for="LB_therap3">穿刺手术</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                  <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap4" value="封闭疗法" >
                                                                                  <label class="form-check-label" for="LB_therap4">封闭疗法</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap5" value="瘤胃内容物疗法" >
                                                                                    <label class="form-check-label" for="LB_therap5">瘤胃内容物疗法</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                      <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap6" value="腹膜透析疗法" >
                                                                                      <label class="form-check-label" for="LB_therap6">腹膜透析疗法</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap7" value="灌肠法和破解术" >
                                                                                        <label class="form-check-label" for="LB_therap7">灌肠法和破解术</label>
                                                                                      </div>
                                                                                      <div class="form-check form-check-inline">
                                                                                          <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap8" value="冲洗法" >
                                                                                          <label class="form-check-label" for="LB_therap8">冲洗法</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap9" value="物理疗法" >
                                                                                            <label class="form-check-label" for="LB_therap9">物理疗法</label>
                                                                                          </div>
                                                                                          <div class="form-check form-check-inline">
                                                                                              <input class="form-check-input" name="LB_therapeuticway[]" type="checkbox" id="LB_therap10" value="其它" >
                                                                                              <label class="form-check-label" for="LB_therap10">其它</label>
                                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="LB_selectDrug" hidden>
                                                                      <label for="LB_drugUse" class="col-sm-3 col-form-label">选择使用的药物</label>
                                                                      <input type="hidden" class="LB_drug_id" id="LB_drug_id" name="LB_drug_id">
                                                                      <div class="col-sm-3 mt-1">
                                                                        <input name="LB_drugUse[]" id="LB_drugUse" class="form-control get_drug_info" autocomplete='off' >
                                                                      </div>
                                                                      
                                                                        <div class="input-group mt-1 col-sm-3 my-1">
                                                                          <input type="text" class="form-control " id="LB_dosage" placeholder="用量" name="LB_dosage[]">
                                                                          <div class="input-group-prepend">
                                                                            <div class="input-group-text " id="LB_input_unit">ml</div>
                                                                          </div>
                                                                          </div>
                                                                        <div class="col-sm-1  LB_plusDrug">
                                                                        <i class="fa fa-plus-circle text-danger" aria-hidden="true" style="cursor:pointer;">添加</i>
                                                                      </div>
                                                                      <div class="col-sm-1"></div>
                                                                      </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="LB_note" class="col-sm-3 col-form-label">方案说明（选填）</label>
                                                                      <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="LB_note" name="LB_note" >
                                                                      </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="LB_status1" class="col-sm-3 col-form-label">治疗状态</label>
                                                                    <div class="col-sm-9">
                                                                    <div class="custom-control custom-radio custom-control-inline" >
                                                                      <input type="radio" id="LB_status1" name="LB_status" class="custom-control-input" value="ing" >
                                                                      <label class="custom-control-label" for="LB_status1">蹄病需继续治疗</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="LB_status2" name="LB_status" class="custom-control-input" value="done">
                                                                      <label class="custom-control-label" for="LB_status2">修蹄结束</label>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="LB_dailyResult" hidden>
                                                                      <label for="LB_dailycondition" class="col-sm-3 col-form-label">当日治疗后情况</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="LB_dailycondition" id="LB_dailycondition" class="form-control">
                                                                        <option value="好转">好转</option>
                                                                        <option value="稳定">稳定</option>
                                                                        <option value="加重">加重</option>
                                                                      </select>
                                                                        </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row" id="LB_treatmentResult" hidden>
                                                                      <label for="LB_result" class="col-sm-3 col-form-label">修蹄结果</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="LB_outcome" id="LB_result" class="form-control">
                                                                          
                                                                          <option value="康复">康复</option>
                                                                          <option value="久治不愈-建议淘汰">难以治愈-建议淘汰</option>
                    
                                                                        </select>
                                                                      </div>
                                                                  </div>
    
                                                          </div>
                                                          <div class="col-lg-5 border border-warning mt-1 ml-1" id="right-back-div">
                                                              <div class="form-row justify-content-center">
                                                              <div class="alert alert-info alert-rounded text-center w-50" role="alert" >
                                                                  <div class="h5">右后蹄</div>
                                                                </div>
                                                              </div>
                                                              <div class="form-group row " id="RB_ifhoof_ill">
                                                                  <label for="RB_diseaseOrCare1" class="col-sm-3 col-form-label">有无病蹄</label>
                                                                <div class="col-sm-9">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="RB_diseaseOrCare1" name="RB_diseaseOrCare" class="custom-control-input" value="0" checked>
                                                                  <label class="custom-control-label" for="RB_diseaseOrCare1">普修</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                  <input type="radio" id="RB_diseaseOrCare2" name="RB_diseaseOrCare" class="custom-control-input" value="1">
                                                                  <label class="custom-control-label" for="RB_diseaseOrCare2">病蹄</label>
                                                                </div>
                                                              </div>
                                                              </div>
                                                              <div style="display:none;" class="form-group row">
                                                                  <label for="RB_diseasename" class="col-sm-3 col-form-label">何种蹄病</label>
                                                                  <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="RB_diseasename" name="RB_diseasename" placeholder="病名或保健性修蹄">
                                                                  </div>
                                                                </div>
                                                                <div style="display:none;" class="form-group row">
                                                                      <label for="RB_diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                                      <div class="col-sm-9">
                                                                              <textarea  class="form-control" id="RB_diseaseCondition" name="RB_diseaseCondition" ></textarea>
                                                                      </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row">
                                                                        <label for="RB_treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap1" value="药物治疗">
                                                                                <label class="form-check-label" for="RB_therap1">药物治疗</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap2" value="输液">
                                                                                <label class="form-check-label" for="RB_therap2">输液</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap3" value="穿刺手术" >
                                                                                <label class="form-check-label" for="RB_therap3">穿刺手术</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline">
                                                                                  <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap4" value="封闭疗法" >
                                                                                  <label class="form-check-label" for="RB_therap4">封闭疗法</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap5" value="瘤胃内容物疗法" >
                                                                                    <label class="form-check-label" for="RB_therap5">瘤胃内容物疗法</label>
                                                                                  </div>
                                                                                  <div class="form-check form-check-inline">
                                                                                      <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap6" value="腹膜透析疗法" >
                                                                                      <label class="form-check-label" for="RB_therap6">腹膜透析疗法</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap7" value="灌肠法和破解术" >
                                                                                        <label class="form-check-label" for="RB_therap7">灌肠法和破解术</label>
                                                                                      </div>
                                                                                      <div class="form-check form-check-inline">
                                                                                          <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap8" value="冲洗法" >
                                                                                          <label class="form-check-label" for="RB_therap8">冲洗法</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap9" value="物理疗法" >
                                                                                            <label class="form-check-label" for="RB_therap9">物理疗法</label>
                                                                                          </div>
                                                                                          <div class="form-check form-check-inline">
                                                                                              <input class="form-check-input" name="RB_therapeuticway[]" type="checkbox" id="RB_therap10" value="其它" >
                                                                                              <label class="form-check-label" for="RB_therap10">其它</label>
                                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="RB_selectDrug" hidden>
                                                                      <label for="drugUse" class="col-sm-3 col-form-label">选择使用的药物</label>
                                                                      <input type="hidden" class="RB_drug_id" id="RB_drug_id" name="RB_drug_id">
                                                                      <div class="col-sm-3 mt-1">
                                                                        <input name="RB_drugUse[]" id="RB_drugUse" class="form-control get_drug_info" autocomplete='off' >
                                                                      </div>
                                                                      
                                                                        <div class="input-group mt-1 col-sm-3 my-1">
                                                                          <input type="text" class="form-control " id="RB_dosage" placeholder="用量" name="RB_dosage[]">
                                                                          <div class="input-group-prepend">
                                                                            <div class="input-group-text" id="RB_input_unit">ml</div>
                                                                          </div>
                                                                          </div>
                                                                        <div class="col-sm-1  RB_plusDrug">
                                                                        <i class="fa fa-plus-circle text-danger" aria-hidden="true" style="cursor:pointer;">添加</i>
                                                                      </div>
                                                                      <div class="col-sm-1"></div>
                                                                      </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="RB_note" class="col-sm-3 col-form-label">方案说明（选填）</label>
                                                                      <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="RB_note" name="RB_note" >
                                                                      </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row">
                                                                      <label for="RB_status1" class="col-sm-3 col-form-label">治疗状态</label>
                                                                    <div class="col-sm-9">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="RB_status1" name="RB_status" class="custom-control-input" value="ing" >
                                                                      <label class="custom-control-label" for="RB_status1">蹄病需继续治疗</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                      <input type="radio" id="RB_status2" name="RB_status" class="custom-control-input" value="done">
                                                                      <label class="custom-control-label" for="RB_status2">修蹄结束</label>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                                  <div style="display:none;" class="form-group row" id="RB_dailyResult" hidden>
                                                                      <label for="RB_dailycondition" class="col-sm-3 col-form-label">当日治疗后情况</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="RB_dailycondition" id="RB_dailycondition" class="form-control">
                                                                        <option value="好转">好转</option>
                                                                        <option value="稳定">稳定</option>
                                                                        <option value="加重">加重</option>
                                                                      </select>
                                                                        </div>
                                                                    </div>
                                                                    <div style="display:none;" class="form-group row" id="RB_treatmentResult" hidden>
                                                                      <label for="RB_result" class="col-sm-3 col-form-label">修蹄结果</label>
                                                                      <div class="col-sm-9">
                                                                        <select name="RB_outcome" id="RB_result" class="form-control">  
                                                                          <option value="康复">康复</option>
                                                                          <option value="久治不愈-建议淘汰">难以治愈-建议淘汰</option>
                    
                                                                        </select>
                                                                      </div>
                                                                  </div>
    
                                                          </div>
                                                      </div>
                                                      </div>
                                  </div>
                                  <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-success justify-content-end" id="submit">提交</button>
                                      </div>
                                  </div>
                                </form>
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
<script src="/js/trim_hoof_input.js"></script>
@stop
