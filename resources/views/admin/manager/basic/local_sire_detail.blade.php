@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>本场公牛详情</title>
<style>
.secondTdRight{
  border-right: 1px solid;
}
.secondTdBottom{
  border-bottom: 1px solid;
}
.secondTdTop{
  border-top: 1px solid;
}
.thirdLeft {
  border-left:1px solid;
}
.thirdBottom {
  border-bottom:1px solid;
}
.thirdTop {
  border-top:1px solid;
}
.forthBottom {
  border-bottom: 1px solid;
}
.forthTdLeft {
  border-Left:1px solid;
}
.forthTop {
  border-top:1px solid;
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

<div class="card rounded-0 my-3">
  <div class="card-header">
    <div class="h5 p-2">{{$sire->sireRegi}}</div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <p>注册号：{{$sire->sireRegi}}</p>
        <p>出生日期：{{$sire->birthday}}</p>
      </div>
      <div class="col-md-6">
        <p>品种：{{$sire->breedVariety->name}}</p>
        <p>国家：{{$sire->nationmap->nationName}}</p>   
        <p>所属公司：{{$sire->company->companyName}}</p>
      </div>

    </div>
  </div>

    <div class="card-header">
        <h5>公牛系谱图</h5>
      </div>
    <div class="row py-2">
      
      <div class="col-md-12">
        <table border="0"  border-collapse="collapse">
          <tbody>
            <tr>
              <td>
                <table border="0" height="100%"  valign="center" border-collapse="collapse">
                  <tbody>
                      <tr>
                      <td>
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                          </td>
                    
                    </tr>
                    <tr style="border:1px solid ">
                        <td align="right" valign="center" class="p-2">
                            <a href="/admin/manage/basic/sire/siredetail/{{$sire->id}}">{{$sire->sireRegi}} </a>
                            <br>
                          </td>
                      </tr>
                    <tr>
                        <td>
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                      <td>
                        <br>
                        <br>
                      </td>
                    </tr>
                      <tr>
                        <td>
                          <br>
                          <br>
                        </td>
                      </tr>
                      <tr>
                          <td>
                            <br>
                            <br>
                          </td>
                        </tr>
                  </tbody>
                </table>
              </td>
              <td>
                <table border="0" height="%100" bgcolor="white" valign="center">
                  <tbody>                     
                    <tr>
                      <td width="40px">
                        <br><br>
                      </td>
                      <td width="10px" class="secondTdBottom"></td>
                      <td valign="center" nowrap="" class="secondTdBottom">
                        
                          <a href="/services?action=anmfactfinder&amp;anm_key=31627330">父：@if(empty($sire_dam)) 没有结果 @else{{$sire_dam->father}} @endif</a><br>
                        <span > &nbsp;&nbsp;06/22/2010</span>
                       <br>
                      </td>
                    </tr>
                    <tr>
                      <td class="secondTdRight">
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                        <td class="secondTdRight">
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                      <td class="secondTdRight">
                       <br><br>                      
                      </td>
                     
                    
                    </tr>
                    <tr>
                        <td class="secondTdRight secondTdBottom">
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                      <td class="secondTdRight">
                       <br><br>
                      </td>
                    </tr>
                    <tr>
                      <td class="secondTdRight">
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                      <td class="secondTdRight">
                        <br>
                        <br>
                      </td>
                    </tr>
                    <tr>
                        <td class="secondTdRight">
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                        <td >
                          <br>
                          <br>
                        </td>
                        <td width="10px" class="secondTdTop"></td>
                        <td valign="center" nowrap="" class="secondTdTop">
              
                            <a href="/services?action=anmfactfinder&amp;anm_key=31178774">母：2-2 @if(empty($sire_dam)) 没有结果 @else {{$sire_dam->mother}} @endif</a><br>
                          <span>07/25/2009</span>            
                        </td>
                      </tr>
                    
                            
                  </tbody>
                </table>
              </td>
              <td>
                <table border="0" height="%100" bgcolor="white" valign="center">
                  <tbody>
                       
                    <tr>
                      <td width="40px" class=" thirdBottom">
                       <br><br>
                      </td>
                      <td valign="center" nowrap="" class="thirdBottom">
                       
                          <a href="/services?action=anmfactfinder&amp;anm_key=30164809">祖父：3-1 @if(empty($grandsire)) 没有结果 @else {{ $grandsire->father }} @endif</a><br>
                        <span face="verdana" size="-2"> 29HO14142&nbsp;&nbsp;09/17/2007</span>
                        <br>

                      </td>
                    </tr>
                      <tr>
                        <td class="thirdLeft">
                          <br>
                          <br>
                        </td>
                      </tr>
                      <tr>
                          <td class="thirdLeft">
                            <br>
                            <br>
                          </td>
                        </tr>
                    <tr>
                      <td class="thirdLeft thirdBottom">
                        <br>
                        <br>
                      </td>
                    </tr>                
                    <tr>
                      <td valign="center" nowrap="" class="thirdTop">
                        <br><br>                       
                      </td>
                      <td valign="center" nowrap="" class="thirdTop">
                        
                          <a href="/services?action=anmfactfinder&amp;anm_key=29253024">祖母：@if(empty($grandsire)) 没有结果 @else {{$grandsire->mother}}  @endif</a><br>
                        <span>04/23/2006</span>
                       <br>

                      </td>
                    </tr>
                    <tr>
                        <td >
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                        <td >
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                        <td >
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                        <td >
                          <br>
                          <br>
                        </td>
                      </tr>
                     
                    <tr>
                      <td valign="center" nowrap="" class="thirdBottom">
                       
                     <br><br>
                      </td>
                      <td valign="center" nowrap="" class="thirdBottom">
                        <a href="/services?action=anmfactfinder&amp;anm_key=27129720">外祖父：3-3 @if(empty($grandDam)) 没有结果 @else {{$grandDam->father}} @endif</a><br>
                        <span> 7HO08081&nbsp;&nbsp;03/03/2003</span>       
                      </td>
                    </tr>
                    <tr>
                        <td class="thirdLeft">
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                      <td class="thirdLeft">
                        <br>
                        <br>
                      </td>
                    </tr>
                   
                    <tr>
                        <td class="thirdLeft">
                          <br>
                          <br>
                        </td>
                      </tr>
                      <tr>
                          <td valign="center" nowrap="" class="thirdTop">
                                <br><br>
                          </td>
                          <td valign="center" nowrap="" class="thirdTop">
                            
                              <a href="/services?action=anmfactfinder&amp;anm_key=28304865">外祖母： @if(empty($grandDam)) 没有结果 @else {{$grandDam->mother}} @endif</a><br>
                            <span>01/13/2005</span>
                          </td>
                        </tr>
                    <tr>
                     
                  </tbody>
                </table>
              </td>
              <td>
                <table border="0" height="%100" bgcolor="white" valign="center">
                  <tbody>

                      <tr>
                          <td width="40px" class="forthBottom">
                           <br><br>
                          </td>
                          <td valign="center" nowrap="" >
                              <a href="/services?action=anmfactfinder&amp;anm_key=30164809">4-1  @if(empty($greatSire)) 没有结果 @else {{$greatSire->father}} @endif</a><br>
                            <span face="verdana" size="-2"> 29HO14142&nbsp;&nbsp;09/17/2007</span>
                            <br>
                          </td>
                    </tr>
                      <tr>
                          <td class="forthTdLeft">
                            <br>
                            <br>
                          </td>
                      </tr>
                      <tr>
                          <td class="forthTdLeft forthBottom">
                           <br><br>
                          </td>
                          <td valign="center" nowrap="">
                              <a href="/services?action=anmfactfinder&amp;anm_key=30164809">4-2 @if(empty($greatSire)) 没有结果 @else {{$greatSire->mother}} @endif</a><br>
                            <span face="verdana" size="-2"> 29HO14142&nbsp;&nbsp;09/17/2007</span>
                            <br>
                          </td>
                        </tr>
                      <tr>
                        <td class="forthBottom">
                          <br>
                          <br>
                        </td>
                    </tr>
                  <tr>
                      <td valign="center" nowrap="" class="forthTdLeft forthTop">
                        <br><br>                       
                      </td>
                      <td valign="center" nowrap="">
                          <a href="/services?action=anmfactfinder&amp;anm_key=29253024">USA @if(empty($greatDam)) 没有结果 @else {{$greatDam->father}}  @endif</a><br>
                        <span>04/23/2006</span>
                       <br>
                      </td>
                    </tr>
                    <tr>
                        <td  class="forthTdLeft">
                          <br>
                          <br>
                        </td>
                    </tr>
                <tr>
                    <td valign="center" nowrap="" class="forthTop">
                      <br><br>                       
                    </td>
                    <td valign="center" nowrap="">
                      
                        <a href="/services?action=anmfactfinder&amp;anm_key=29253024">USA @if(empty($greatDam)) 没有结果 @else {{$greatDam->mother}}  @endif </a><br>
                    <span>04/23/2006</span>
                     <br>
                    </td>
                  </tr>
                  <tr>
                      <td >
                        <br>
                        <br>
                      </td>
                  </tr>
                        <tr>
                            <td >
                              <br>
                              <br>
                            </td>
                          </tr>
                          
                          <tr>
                              <td valign="center" nowrap="" class="forthLeft forthBottom">
                             <br><br>
                              </td>
                              <td valign="center" nowrap="" >
                                <a href="/services?action=anmfactfinder&amp;anm_key=27129720">5 @if(empty($outgreatSire)) 没有结果 @else {{$outgreatSire->father}} @endif</a><br>
                              <span> 7HO08081&nbsp;&nbsp;03/03/2003</span>
                              </td>
                            </tr>
                    <tr>
                        <td class="forthTdLeft">
                          <br>
                          <br>
                        </td>
                      </tr>
                    
                    <tr>
                      <td valign="center" nowrap="" class="forthTdLeft forthBottom">
                     <br><br>
                      </td>
                      <td valign="center" nowrap="">
                        <a href="/services?action=anmfactfinder&amp;anm_key=27129720">6 @if(empty($outgreatSire)) 没有结果 @else {{$outgreatSire->mother}} @endif </a><br>
                      <span> 7HO08081&nbsp;&nbsp;03/03/2003</span>
                      </td>
                    </tr>
                    
                    <tr>
                        <td>
                          <br>
                          <br>
                        </td>
                      </tr>
                    <tr>
                      <td valign="center" nowrap="" class="forthTdLeft forthTop">
                            <br><br>
                      </td>
                      <td valign="center" nowrap="">
                          <a href="/services?action=anmfactfinder&amp;anm_key=28304865">7 @if(empty($outgreatDam)) 没有结果 @else {{$outgreatDam->father}} @endif </a><br>
                        <span>01/13/2005</span>
                      </td>
                    </tr>
                    <tr>
                        <td class="forthTdLeft">
                          <br>
                          <br>
                        </td>
                      </tr>
                      <tr>
                          <td valign="center" nowrap="" class="forthTop">
                                <br><br>
                          </td>
                          <td valign="center" nowrap="">
                            
                              <a href="/services?action=anmfactfinder&amp;anm_key=28304865">8 @if(empty($outgreatDam)) 没有结果 @else {{$outgreatDam->mother}}  @endif </a><br>
                            <span>01/13/2005</span>
                          </td>
                        </tr>
                   
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@stop


@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/cattleinput.js"></script>
<script type="text/javascript" src="/js/resetinput.js"></script>

@stop