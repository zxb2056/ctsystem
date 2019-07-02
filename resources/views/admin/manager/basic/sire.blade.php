@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>牛舍信息</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <a class="nav-link  active" href="{{url('/admin/manage/basic/sireinfos')}}">公牛信息</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/admin/manage/basic/semeninfos')}}">冻精信息</a>
  </li>
  <li class="nav-item">
      <a class="nav-link dropdown-toggle" href="{{url('/admin/manage/basic/mateInput/outPregCattle')}}" >外购现有孕牛配种记录</a>  
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
</ul>
@if(!empty(session('warn')))
        　　<div class="alert alert-danger" role="alert">
        　　　　{{session('warn')}}
        　　</div>
@endif
<div class="card rounded-0 my-3">
  <div class="card-header mb-1 d-flex">
    <div class="h5 mr-auto">查询公牛库</div>
    <a href="" class="btn btn-sm btn-outline-primary mx-1"  data-toggle="modal" data-target="#importSireInfoModal" ><i class="fa fa-upload" aria-hidden="true"></i><small class="hidden-xs"> 导入育种资料</small></a> 
    <a href="" class="btn btn-sm btn-outline-primary mx-1"  data-toggle="modal" data-target="#importSirePedigreeModal" ><i class="fa fa-upload" aria-hidden="true"></i><small class="hidden-xs"> 导入系谱信息</small></a> 
  </div>
<form action="{{url('/admin/manage/basic/sire/queryresult')}}" method="GET">
    <div class="card-body my-1 border">
      <div class="container">
        <div class="form-row">
          <div class="col-md-3">
            <div class="form-group row ">
              <label for="breedType" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">品种</label>
              <div class="col-md-9">
                <select name="breedType" id="breedType" class="form-control form-control-sm">
                  <option value="">选择品种</option>
                  @foreach ($breeds as $breed)
                  <option value="{{$breed->breedType}}">{{$breed->breedType}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group row">
              <label for="colFormLabelSm" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">国家</label>
              <div class="col-sm-9">
                <select name="nation" id="nation" class="form-control form-control-sm my-1">
                    <option value="">选择国家</option>
                  @foreach ($nations as $nation)
                  <option value="{{$nation->abbreviation}}">{{$nation->abbreviation}}-{{$nation->nationName}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group row">
              <label for="belongToCompany" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">公司</label>
              <div class="col-sm-9">
                <select name="belongToCompany" id="belongToCompany" class="form-control form-control-sm my-1">
                    <option value="">选择公牛所属公司</option>
                  @foreach ($companys as $company)
                  <option value="{{$company->belongToCompany}}">{{$company->belongToCompany}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-3">
            <div class="form-group row ">
              <label for="semenNum" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">冻精号</label>
              <div class="col-md-9">
                <input type="text" name="semenNum" id="semenNum" class="form-control form-control-sm my-1">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group row ">
              <label for="sireRegi" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">登记号</label>
              <div class="col-md-9">
                <input type="text" name="sireRegi" id="sireRegi" class="form-control form-control-sm my-1">
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-row">
          <div class="col-md-3">
            <div class="form-group row ">
              <label for="semenNum" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">CBI</label>
              <div class="col-md-9 input-group">
                <div class="input-group-prepend-sm">
                  <select name="CBIRequire" id="CBIrequire" class="custom-select-sm">
                    <option value=">">></option>
                    <option value=">=">>=</option>
                    <option value="=">=</option>
                    <option value="<"><</option>
                     <option value="<=">
                        <=</option> 
                      </select> 
                    </div>
                     <input type="text" name="CBI" id="CBI" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group row ">
                <label for="birthDay" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">出生日期</label>
                <div class="col-md-9 input-group">
                  <div class="input-group-prepend-sm">
                    <select name="birthDayRequire" id="birthDayRequire" class="custom-select-sm">
                      <option value=">">></option>
                      <option value=">=">>=</option>
                      <option value="=">=</option>
                      <option value="<">
                        <</option> <option value="<=">
                          <=</option> </select> </div> <input type="text" name="birthDay" id="birthDay"
                            class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row ">
                  <label for="BW" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">初生重</label>
                  <div class="col-md-9 input-group">
                    <div class="input-group-prepend-sm">
                      <select name="BWRequire" id="BWRequire" class="custom-select-sm">
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="=">=</option>
                        <option value="<"><</option> 
                        <option value="<="><=</option>
                       </select>
                      </div>
                      <input type="text" name="BW" id="BW" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group row ">
                    <label for="WW" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">断奶重</label>
                    <div class="col-md-9 input-group">
                      <div class="input-group-prepend-sm">
                        <select name="WWRequire" id="WWRequire" class="custom-select-sm">
                          <option value=">">></option>
                          <option value=">=">>=</option>
                          <option value="=">=</option>
                          <option value="<"><</option>
                         <option value="<="><=</option>
                         </select>
                         </div> 
                         <input type="text" name="WW" id="WW" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                </div>
                {{-- 第二行选项 --}}
                <div class="form-row">
                    <div class="col-md-3">
                      <div class="form-group row ">
                        <label for="YW" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-left">周岁重</label>
                        <div class="col-md-9 input-group">
                          <div class="input-group-prepend-sm">
                            <select name="YWRequire" id="YWRequire" class="custom-select-sm">
                              <option value=">">></option>
                              <option value=">=">>=</option>
                              <option value="=">=</option>
                              <option value="<"><</option>
                               <option value="<="><=</option> 
                            </select> 
                          </div> 
                          <input type="text" name="YW" id="YW" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group row ">
                          <label for="W18month" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">18月龄重</label>
                          <div class="col-md-9 input-group">
                            <div class="input-group-prepend-sm">
                              <select name="W18Require" id="W18Require" class="custom-select-sm">
                                <option value=">">></option>
                                <option value=">=">>=</option>
                                <option value="=">=</option>
                                <option value="<"><</option>
                                 <option value="<="><=</option>
                                 </select>
                                 </div> 
                                 <input type="text" name="W18month" id="W18month" class="form-control form-control-sm">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group row ">
                            <label for="W24month" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">24月龄重</label>
                            <div class="col-md-9 input-group">
                              <div class="input-group-prepend-sm">
                                <select name="W24Require" id="W24Require" class="custom-select-sm">
                                  <option value=">">></option>
                                  <option value=">=">>=</option>
                                  <option value="=">=</option>
                                  <option value="<"><</option>
                                   <option value="<="><=</option>
                                   </select> 
                                  </div>
                                   <input type="text" name="W24month" id="W24month" class="form-control form-control-sm">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group row ">
                              <label for="W36month" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">36月龄重</label>
                              <div class="col-md-9 input-group">
                                <div class="input-group-prepend-sm">
                                  <select name="W36Require" id="W36Require" class="custom-select-sm">
                                    <option value=">">></option>
                                    <option value=">=">>=</option>
                                    <option value="=">=</option>
                                    <option value="<"><</option>
                                     <option value="<="><=</option>
                                    </select>
                                  </div>
                                   <input type="text" name="W36month" id="W36month" class="form-control form-control-sm">
                                </div>
                              </div>
                            </div>
                          </div>
          {{-- 第三行 --}}
          <div class="form-row">
              <div class="col-md-3">
                <div class="form-group row ">
                  <label for="bodylevel" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0 text-left">体型等级</label>
                  <div class="col-md-9 input-group">
                    <div class="input-group-prepend-sm">
                      <select name="bodylevelRequire" id="bodylevelRequire" class="custom-select-sm">
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="=">=</option>
                        <option value="<"><</option>
                         <option value="<="><=</option>
                         </select>
                         </div> 
                         <input type="text" name="level" id="bodylevel" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group row ">
                    <label for="CEM" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">产犊难易</label>
                    <div class="col-md-9 input-group">
                      <div class="input-group-prepend-sm">
                        <select name="CEMRequire" id="CEMRequire" class="custom-select-sm">
                          <option value=">">></option>
                          <option value=">=">>=</option>
                          <option value="=">=</option>
                          <option value="<">
                            <</option> <option value="<="><=</option>
                           </select>
                           </div>
                            <input type="text" name="CEM" id="CEM" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group row ">
                      <label for="milk" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">泌乳性能</label>
                      <div class="col-md-9 input-group">
                        <div class="input-group-prepend-sm">
                          <select name="milkRequire" id="milkRequire" class="custom-select-sm">
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="=">=</option>
                            <option value="<"><</option>
                             <option value="<="><=</option>
                             </select>
                             </div>
                              <input type="text" name="milk" id="milk" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row ">
                        <label for="MH" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">成年体高</label>
                        <div class="col-md-9 input-group">
                          <div class="input-group-prepend-sm">
                            <select name="MHRequire" id="MHRequire" class="custom-select-sm">
                              <option value=">">></option>
                              <option value=">=">>=</option>
                              <option value="=">=</option>
                              <option value="<"><</option>
                               <option value="<="><=</option> 
                              </select>
                             </div> 
                             <input type="text" name="MH" id="MH" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                    </div>
                  
                   {{-- 第四行 --}}
          <div class="form-row">
              <div class="col-md-3">
                <div class="form-group row ">
                  <label for="CW" class="col-md-3 custom-label my-1 py-1 pr-0">胴体重</label>
                  <div class="col-md-9 input-group">
                    <div class="input-group-prepend-sm">
                      <select name="CWRequire" id="CWRequire" class="custom-select-sm">
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="=">=</option>
                        <option value="<"><</option>
                         <option value="<="><=</option>
                         </select>
                         </div> 
                         <input type="text" name="CW" id="CW" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group row ">
                    <label for="Marbling" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">肌间脂肪</label>
                    <div class="col-md-9 input-group">
                      <div class="input-group-prepend-sm">
                        <select name="MarblingRequire" id="MarblingRequire" class="custom-select-sm">
                          <option value=">">></option>
                          <option value=">=">>=</option>
                          <option value="=">=</option>
                          <option value="<"><</option> 
                          <option value="<="><=</option>
                         </select> 
                        </div> 
                        <input type="text" name="Marbling" id="Marbling" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group row ">
                      <label for="REA" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">眼肌面积</label>
                      <div class="col-md-9 input-group">
                        <div class="input-group-prepend-sm">
                          <select name="REARequire" id="REARequire" class="custom-select-sm">
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="=">=</option>
                            <option value="<"><</option>
                             <option value="<="><=</option>
                             </select>
                             </div>
                              <input type="text" name="REA" id="REA" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row ">
                        <label for="Fat" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">背膘厚</label>
                        <div class="col-md-9 input-group">
                          <div class="input-group-prepend-sm">
                            <select name="FatRequire" id="FatRequire" class="custom-select-sm">
                              <option value=">">></option>
                              <option value=">=">>=</option>
                              <option value="=">=</option>
                              <option value="<"><</option>
                               <option value="<="><=</option> 
                              </select>
                             </div> 
                             <input type="text" name="Fat" id="Fat" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                    </div>
                      {{-- 第五行 --}}
          <div class="form-row">
              <div class="col-md-3">
                <div class="form-group row ">
                  <label for="$F" class="col-md-3 custom-label my-1 py-1 pr-0">育肥价值</label>
                  <div class="col-md-9 input-group">
                    <div class="input-group-prepend-sm">
                      <select name="$FRequire" id="$FRequire" class="custom-select-sm">
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="=">=</option>
                        <option value="<"><</option>
                         <option value="<="><=</option>
                         </select>
                         </div> 
                         <input type="text" name="$F" id="$F" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group row ">
                    <label for="$G" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">胴体价值</label>
                    <div class="col-md-9 input-group">
                      <div class="input-group-prepend-sm">
                        <select name="$GRequire" id="$GRequire" class="custom-select-sm">
                          <option value=">">></option>
                          <option value=">=">>=</option>
                          <option value="=">=</option>
                          <option value="<"><</option> 
                          <option value="<="><=</option>
                         </select>
                         </div> 
                         <input type="text" name="$G" id="$G" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group row ">
                      <label for="$QG" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">品质评分</label>
                      <div class="col-md-9 input-group">
                        <div class="input-group-prepend-sm">
                          <select name="$QGRequire" id="$QGRequire" class="custom-select-sm">
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="=">=</option>
                            <option value="<"><</option>
                             <option value="<="><=</option>
                             </select>
                             </div>
                              <input type="text" name="$QG" id="$QG" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row ">
                        <label for="$YG" class="col-md-3 custom-label my-1 py-1 pr-0">产量评分</label>
                        <div class="col-md-9 input-group">
                          <div class="input-group-prepend-sm">
                            <select name="$YGRequire" id="$YGRequire" class="custom-select-sm">
                              <option value=">">></option>
                              <option value=">=">>=</option>
                              <option value="=">=</option>
                              <option value="<"><</option>
                               <option value="<="><=</option> 
                              </select>
                             </div> 
                             <input type="text" name="$YG" id="$YG" class="form-control form-control-sm">
                          </div>
                        </div>
                    </div>
                  </div>
                   {{-- 第六行 --}}
                   <div class="form-row">
                      <div class="col-md-3">
                        <div class="form-group row ">
                          <label for="$B" class="col-md-3 custom-label my-1 py-1 pr-0">肉牛价值</label>
                          <div class="col-md-9 input-group">
                            <div class="input-group-prepend-sm">
                              <select name="$BRequire" id="$BRequire" class="custom-select-sm">
                                <option value=">">></option>
                                <option value=">=">>=</option>
                                <option value="=">=</option>
                                <option value="<"><</option>
                                 <option value="<="><=</option>
                                 </select>
                                 </div> 
                                 <input type="text" name="$B" id="$B" class="form-control form-control-sm">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group row ">
                            <label for="showitem" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">每页显示</label>
                            <div class="col-md-9 input-group">
                              
                                <select name="showitem" id="showitem" class="form-control form-control-sm">
                                  <option value="10">10条</option>
                                  <option value="20">20条</option>
                                  <option value="30">30条</option>
                                  <option value="50">50条</option>
                                   <option value="100">100条</option>
                                   </select>

                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group row ">
                              <label for="sortby" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">排序字段</label>
                              <div class="col-md-9 input-group">
                                  <select name="sortby" id="sortby" class="form-control form-control-sm">
                                    @foreach ($results as $result)
                                  <option value="{{$result->COLUMN_NAME}}">{{$result->COLUMN_COMMENT}}</option>
                                    @endforeach

                                     </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group row ">
                                <label for="orderby" class="col-md-3 custom-label my-1 py-1 pl-3 pr-0">升降序</label>
                                <div class="col-md-9 input-group">
                                    <select name="orderby" id="orderby" class="form-control form-control-sm">
                                    <option value="asc">升序</option>
                                    <option value="desc">降序</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-3 px-4">
                              <div class="d-flex justify-content-center">
                                  <button type="submit" class="btn btn-sm btn-outline-primary" >查询</button>
                            </div>
                          </div>
                        </div>
            </div>
  </form>
</div>
<!-- importSireInfoModal **导入公牛基本信息** -->
<div class="modal fade" id="importSireInfoModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
        <div class="modal-header">
                <h5><strong>导入公牛信息</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header d-flex justify-content-center">                   
                        <div class="ml-auto">
                        <a href="{{asset('/file/公牛信息导入模板.xlsx')}}" class="btn btn-sm btn-outline-primary " ><i class="fa fa-refresh"></i><span class="hidden-xs">下载公牛导入模板</span></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <form action="{{url('/admin/manage/basic/sire/import_sireInfo')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}
                            <div class="form-group form-row">
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="sireInfo_sheet" name="sireInfo" required>
                                </div>
                            </div>                 
                            <div class="modal-footer" id="breedinsert">                      
                            <button type="submit" id="add_breed_variety" class="btn btn-primary">导入</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
    </div>
     <!-- importSirePedigreeModal **导入公牛系谱信息** -->
<div class="modal fade" id="importSirePedigreeModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
        <div class="modal-header">
                <h5><strong>导入公牛系谱</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-header d-flex justify-content-center">                   
                        <div class="ml-auto">
                        <a href="{{asset('/file/公牛系谱导入模板.xlsx')}}" class="btn btn-sm btn-outline-primary " ><i class="fa fa-refresh"></i><span class="hidden-xs">下载系谱导入模板</span></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <form action="{{url('/admin/manage/basic/sire/import_sirePedigree')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field()}}
                            <div class="form-group form-row">
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="sirePedigree" name="sirePedigree" required>
                                </div>
                            </div>                 
                            <div class="modal-footer" id="breedinsert">                      
                            <button type="submit" id="add_breed_variety" class="btn btn-primary">导入</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                            </div>
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
<script type="text/javascript" src="/js/barnmap.js"></script>
@stop