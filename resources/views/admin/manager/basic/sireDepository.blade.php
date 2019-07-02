@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>牛只基本信息</title>
<style>
table i{
    cursor:pointer;
}
thead td:hover{
    cursor:pointer;
    color:red;
    
}
thead td{
    font-weight:bold;
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
    <a class="nav-link active" href="{{url('/admin/manage/basic/cattle-pedigree')}}">牧场公牛库</a>
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
@if($semen_no_pedigrees->isNotEmpty())
<div class="container">
  <div class="alert alert-danger">
    <p>以下冻精号还没有创建系谱信息，请务必创建。如果没有系谱信息，可以将基本信息提交</p>
    <p>
      @foreach($semen_no_pedigrees as $nopedigree)
        <span style="width:100px;">{{$nopedigree->semenNum}}</span>
      @endforeach
    </p>
  </div>
</div>

@endif
<div class="accordion mt-4" id="inputParent">
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#InputPedigreeInformation">
            录入公牛信息
          </button>
        </h2>
      </div>
  
      <div id="InputPedigreeInformation" class="collapse" data-parent="#inputParent">
        <div class="card-body">
          <form action="/admin/manage/basic/cattle_sire/sire_input" method="post" id="form1" onkeydown="if(event.keyCode==13)return false;">
            {{csrf_field()}}
                <div class="form-group form-row">
                        <label for="cattleID" class="col-md-1 col-form-label ">公牛号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="cattleID" id="cattleID" required>
                          <div class="span text-danger" hidden="hidden" id="warnExist1">此牛号公牛库中已存在</div>
                        </div>
                        <label for="semenNum" class="col-md-1 col-form-label ">冻精号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="semenNum" id="semenNum" required>
                        </div>

                        <label for="breedType" class="col-md-1 col-form-label ">品种</label>
                        <div class="col-md-2 d-flex">
                            <select name="breedType" id="breedType" class="custom-select mr-1" required>
                              <option value="">请选择品种</option>
                                @foreach ($breeds as $breed)
                                <option value="{{$breed->id}}">{{$breed->name}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-md" data-toggle="modal" data-target="#addBreedModal" ><nobr><u><small>添加品种</small></u></nobr></button>
                        </div>
                        <label for="nation" class="col-md-1 col-form-label ">国家</label>
                        <div class="col-md-2 d-flex">
                            <select name="nation" id="nation" class="custom-select mr-1" required>
                                <option value="">请选择国家</option>
                                @foreach ($nations as $nation)
                                <option value="{{$nation->id}}">{{$nation->abbreviation}}--{{$nation->nationName}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-md"  data-toggle="modal" data-target="#addNationModal"><nobr><u><small>添加国家</small></u></nobr></button>
                        </div>
                        <div class="span text-danger" hidden="hidden" id="warnExist3">当前品种、国家数据库无此牛号。</div>
                </div>
                <div class="form-group form-row">
                        <label for="belongToCompany" class="col-md-1 col-form-label ">所属公司</label>
                        <div class="col-md-2 d-flex">
                                <select name="belongToCompany" id="belongToCompany" class="custom-select mr-1">
                                  <option value="">选择公司</option>
                                        @foreach ($companys as $company)
                                        <option value="{{$company->id}}">{{$company->companyName}}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-md" data-toggle="modal" data-target="#addCompanyModal" ><nobr><u><small>添加公司</small></u></nobr></button>
                          
                        </div>
                        <label for="birthday" class="col-md-1 col-form-label ">出生日期</label>
                        <div class="col-md-2">
                          <input type="date" class="form-control" name="birthday" id="birthday">
                        </div>

                      </div>
                      <div class="form-group form-row">
                        <label for="father" class="col-md-1 col-form-label ">父亲号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="father" id="father">
                          <div class="span text-danger" hidden="hidden" id="warnExist2">数据库中有此公牛信息，自动补全</div>
                        </div>
                        <label for="grandSire" class="col-md-1 col-form-label ">爷爷号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="grandSire" id="grandSire">
                        </div>
                        <label for="grandDam" class="col-md-1 col-form-label ">奶奶号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="grandDam" id="grandDam">
                        </div>
                      </div>
                      <div class="form-group form-row">
                        <label for="dam" class="col-md-1 col-form-label ">母亲号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control " name="dam" id="dam">
                        </div>
                        <label for="outgrandSire" class="col-md-1 col-form-label ">外祖父号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="outgrandSire" id="outgrandSire">
                        </div>
                        <label for="outgrandDam" class="col-md-1 col-form-label ">外祖母号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="outgrandDam" id="outgrandDam">
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                                <button class="btn btn-md btn-outline-primary" id="saveSire"> 保存</button>
                        </div>
                      </div>
                    </form>                           
        </div>
<p class="pl-4">说明1：系统中已经预置了国家，品种，育种公司，如果出现没有包含的情况，可以先添加，再提交公牛信息。</p>
<p class="pl-4">说明2：如果提示系统数据库中无此牛号，但您确定公牛号正确，不用理会，可能是数据库中还未收集。</p>
<p class="pl-4">说明2：如果利用自己本场公牛交配，也要将其存储到公牛库中。并尽量完善其可靠的系谱信息。如果没有,空着，不用乱编。</p>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#InputOutDamInformation">
            录入外购牛系谱信息
          </button>
        </h2>
      </div>
  
      <div id="InputOutDamInformation" class="collapse" data-parent="#inputParent">
        <div class="card-body">
          <form action="/admin/manage/basic/cattle_dam/outDam/input_dam_info_pedigree" method="post" id="form2">
            {{csrf_field()}}
                <div class="form-group form-row">
                    <div class="col-md-3 input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">外购牛号</div>
                          </div>
                          <select name="cattleID" id="outBuy_cattleID" class="form-control">
                            @foreach($outBuyCattles as $outBuyCattle)
                          <option value="{{ $outBuyCattle->id }}">{{ $outBuyCattle->cattleID }}</option>
                            @endforeach
                          </select>

                    </div>
                    <div class="col-md-3 input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">父亲号</div>
                          </div>
                          <select name="out_father" id="out_father" class="form-control">
                              @foreach($sires as $sire)
                                <option value="{{ $sire->id }}">{{ $sire->sireRegi }}</option>
                              @endforeach
                            </select>
                    </div>
                        
                        <div class="col-md-3 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">母亲号</div>
                              </div>
                          <input type="text" class="form-control" name="out_dam" id="out_dam">
                          <div class="span text-danger" hidden="hidden" id="warnExist1">此牛号母牛库中已存在</div>
                        </div>
                </div>
                <hr>
                <h6 class="mb-4"><strong>母亲信息</strong></h6>
                <div class="form-group form-row">
                    <label for="out_breedType" class="col-md-1 col-form-label ">品种</label>
                    <div class="col-md-2 d-flex">
                        <select name="breedType" id="out_breedType" class="custom-select mr-1">
                          <option value="">请选择品种</option>
                            @foreach ($breeds as $breed)
                            <option value="{{$breed->id}}">{{$breed->name}}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-md" data-toggle="modal" data-target="#addBreedModal" ><nobr><u><small>添加品种</small></u></nobr></button>
                    </div>
                        <label for="out_whereComeFrom" class="col-md-1 col-form-label ">来源地区</label>
                        <div class="col-md-2 d-flex">
                          <input type="text" class="form-control" name="whereComeFrom" id="out_whereComeFrom">
                          
                        </div>
                        <label for="out_birthday" class="col-md-1 col-form-label ">出生日期</label>
                        <div class="col-md-2">
                          <input type="date" class="form-control" name="birthday" id="out_birthday">
                        </div>

                      </div>
                      <div class="form-group form-row">
                        <label for="outdam_father" class="col-md-1 col-form-label ">外祖父号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="father" id="outdam_father">
                          <div class="span text-danger" hidden="hidden" id="warnExist2">数据库中有此公牛信息，自动补全</div>
                        </div>
                        <label for="outdam_outgrandSire" class="col-md-1 col-form-label ">外祖父之父</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="grandSire" id="outdam_outgrandSire">
                        </div>
                        <label for="outdam_outgrandmother" class="col-md-1 col-form-label ">外祖父之母</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="grandmother" id="outdam_outgrandmother">
                        </div>
                      </div>
                      <div class="form-group form-row">
                        <label for="outdam_dam" class="col-md-1 col-form-label ">外祖母号</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control " name="dam" id="outdam_dam">
                        </div>
                        <label for="out_sireof_outgrandSire" class="col-md-1 col-form-label ">外祖母之父</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="outgrandSire" id="out_sireof_outgrandSire">
                        </div>
                        <label for="out_damof_outgrandDam" class="col-md-1 col-form-label ">外祖母之母</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="outgrandDam" id="out_damof_outgrandDam">
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                                <button class="btn btn-md btn-outline-primary" id="saveSire"> 保存</button>
                        </div>
                      </div>
                    </form>                           
        </div>
<p class="pl-4">说明：如果有母亲信息请完善。如果没有可以留空。直接提交。</p>

      </div>
    </div>
    <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#retriveCattlePedigree">
                  查看公牛信息
                </button>
              </h2>
            </div>
            <div id="retriveCattlePedigree" class="collapse show" data-parent="#inputParent">
              <div class="card-body">
                <table class="table table-hover"> 
                    <thead class="thead-light">
                        <tr>
                          <th scope="col">序号</th>
                          <th scope="col" >公牛注册号</th>
                          <th scope="col">国家</th>
                          <th scope="col">品种</th>
                          <th scope="col">公司</th>
                          <th scope="col">出生日期</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sires as $sire)
                        <tr>
                            <td>{{(($sires->currentPage() - 1 ) * $sires->perPage() ) + $loop->iteration }}</td>
                            <td ><a href="/admin/manage/basic/local_sire/detail/{{ $sire->id }}">{{$sire->sireRegi}}</a></td>
                            <td>{{$sire->nation}}</td>
                            <td>{{$sire->breedType}}</td>
                            <td>{{$sire->belongToCompany}}</td>
                            <td>{{$sire->birthday}}</td>
                          </tr>
                        @endforeach
                        
                      </tbody>
                </table>
              </div>
            </div>
          </div>
   
<!-- 增加国家modal -->
<div class="modal fade" id="addNationModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增国家</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-body ">
                      <form action="/admin/manage/basic/cattlesire/addnation" method="post">
                        {{csrf_field()}}
                            <div class="form-group form-row">
                                <label for="nationName" class="col-sm-4 col-form-label">国家名称</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nationName" name="nationName" required>
                                </div>
                            </div>      
                            <div class="form-group form-row">
                                <label for="abbreviation" class="col-sm-4 col-form-label">英文简写码<small style="color:red">(*可不写)</small></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="abbreviation" name="abbreviation">
                                </div>
                            </div>            
                            <div class="modal-footer" id="breedinsert">                      
                            <button type="submit" id="add_breed_variety" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
     </div>   
<!-- addBreedModal增加品种 -->
<div class="modal fade" id="addBreedModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增牛品种</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
              <form action="/admin/manage/basic/cattleinfo/plus_breed_variety" method="POST">
                {{csrf_field()}}
                <div class="card rounded-0 my-3">
                    <div class="card-body ">
                            <div class="form-group form-row">
                                <label for="breedName" class="col-sm-3 col-form-label">牛品种名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="breedName" name="name">
                                </div>
                            </div>                 
                            <div class="modal-footer" id="breedinsert">                      
                            <button type="submit" id="add_breed_variety" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
     </div>
  <!-- addCompanyModal增加公司 -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog"  data-backdrop="static">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增公司</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="card rounded-0 my-3">
                    <div class="card-body ">
                      <form action="/admin/manage/basic/cattlesire/addcompany" method="post">
                        {{csrf_field()}}
                            <div class="form-group form-row">
                                <label for="companyName" class="col-sm-3 col-form-label">公司名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="companyName" name="companyName">
                                </div>
                            </div>    
                            <div class="form-group form-row">
                                <label for="companycode" class="col-sm-3 col-form-label">公司代码</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="companycode" name="code">
                                </div>
                            </div>              
                            <div class="modal-footer" id="breedinsert">                      
                            <button type="submit" id="add_breed_variety" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">退出</button>
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
<script type="text/javascript" src="/js/sireDepository.js"></script>


@stop
