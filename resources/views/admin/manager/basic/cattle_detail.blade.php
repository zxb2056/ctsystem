@extends('admin-layouts.admin-main')
@section('head')
@include('admin-layouts.admin-head')
@stop
@section('css')
<title>牛舍信息</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="card-header d-flex">
        <h5 class="mr-auto"><span><strong>{{$cattleinfos->cattleID}}</strong></h5>
        <a href="" class="btn btn-sm btn-outline-primary mr-1" ><i class="fa fa-qrcode"></i><span class="hidden-xs"> 生成二维码</span></a> 
        <a href="" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addCattleModal" title="新增"><i class="fa fa-cog"></i><span class="hidden-xs"> 二维码设置</span></a> 
    </div>
    <div class="card-body row">
        <div class="col-md-12 basicinfo">
            <div class="card-header mb-2">
                基本信息
            </div>
        <span>品种：{{$cattleinfos->breedVariety->name}}</span>
        <span>出生日期：{{$cattleinfos->birthday}}</span>
        <span>出生地：{{$cattleinfos->whereComefrom}}</span>
        <span>性别：{{$cattleinfos->gender}}</span>
        </div>
    </div>
        <div class="col-md-12 ">
            <div class="card-header mb-2">
                系谱信息
            </div>
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
                                  <a href="/admin/manage/basic/sire/siredetail/{{$cattleinfos->id}}">{{$cattleinfos->cattleID}} </a>
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
                              
                                <a href="/services?action=anmfactfinder&amp;anm_key=31627330">父：@if(empty($sire_dam)) 没有结果 @elseif(isset($sire_dam->cattlesire->sireRegi)){{$sire_dam->cattlesire->sireRegi}} @elseif(isset($sire_dam->outsideSire->sireRegi)){{$sire_dam->outsideSire->sireRegi}} @endif</a><br>
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
                    
                                  <a href="/services?action=anmfactfinder&amp;anm_key=31178774">母：2-2 @if(empty($sire_dam)) 没有结果 @elseif(isset($sire_dam->cattledam->cattleID)) {{$sire_dam->cattledam->cattleID }} @elseif(isset($sire_dam->outsideDam->damNum)) {{$sire_dam->outsideDam->damNum}} @endif</a><br>
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
                             
                                <a href="/services?action=anmfactfinder&amp;anm_key=30164809">祖父：3-1 @if(empty($grandsire)) 没有结果 @elseif(isset($grandsire->cattlesire->cattleID)) {{$grandsire->cattlesire->cattleID }}  @else {{ $grandsire->father }} @endif</a><br>
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
                              
                                <a href="/services?action=anmfactfinder&amp;anm_key=29253024">祖母：@if(empty($grandsire)) 没有结果 @elseif(isset($grandsire->cattledam->cattleID)) {{$grandsire->cattledam->cattleID }} @else {{$grandsire->mother}}  @endif</a><br>
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
                              <a href="/services?action=anmfactfinder&amp;anm_key=27129720">外祖父：3-3 @if(empty($grandDam)) 没有结果 @elseif(isset($grandDam->cattlesire->sireRegi)) {{$grandDam->cattlesire->sireRegi }} @else {{$grandDam->father}} @endif</a><br>
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
                                  
                                    <a href="/services?action=anmfactfinder&amp;anm_key=28304865">外祖母： @if(empty($grandDam)) 没有结果 @elseif(isset($grandDam->cattledam->cattleID)) {{$grandDam->cattledam->cattleID }} @else {{$grandDam->mother}} @endif</a><br>
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
                                    <a href="/services?action=anmfactfinder&amp;anm_key=30164809">4-1  @if(empty($greatSire)) 没有结果 @elseif(isset($greatSire->cattlesire->cattleID)) {{$greatSire->cattlesire->cattleID }} @else {{$greatSire->father}} @endif</a><br>
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
                                    <a href="/services?action=anmfactfinder&amp;anm_key=30164809">4-2 @if(empty($greatSire)) 没有结果 @elseif(isset($greatSire->cattledam->cattleID)) {{$greatSire->cattledam->cattleID }} @else {{$greatSire->mother}} @endif</a><br>
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
                                <a href="/services?action=anmfactfinder&amp;anm_key=29253024">USA 4-3 @if(empty($greatDam)) 没有结果 @elseif(isset($greatDam->cattlesire->cattleID)) {{$greatDam->cattlesire->cattleID }} @else {{$greatDam->father}}  @endif</a><br>
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
                            
                              <a href="/services?action=anmfactfinder&amp;anm_key=29253024">USA 4-4 @if(empty($greatDam)) 没有结果 @elseif(isset($greatDam->cattledam->cattleID)) {{$greatDam->cattledam->cattleID }} @else {{$greatDam->mother}}  @endif </a><br>
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
                                      <a href="/services?action=anmfactfinder&amp;anm_key=27129720">4-5 @if(empty($outgreatSire)) 没有结果 @elseif(isset($outgreatSire->cattlesire->cattleID)) {{$outgreatSire->cattlesire->cattleID }} @else {{$outgreatSire->father}} @endif</a><br>
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
                              <a href="/services?action=anmfactfinder&amp;anm_key=27129720">4-6 @if(empty($outgreatSire)) 没有结果 @elseif(isset($outgreatSire->cattledam->cattleID)) {{$outgreatSire->cattledam->cattleID }} @else {{$outgreatSire->mother}} @endif </a><br>
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
                                <a href="/services?action=anmfactfinder&amp;anm_key=28304865">4-7 @if(empty($outgreatDam)) 没有结果 @elseif(isset($outgreatDam->cattlesire->sireRegi)) {{$outgreatDam->cattlesire->sireRegi}} @else {{$outgreatDam->father}} @endif </a><br>
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
                                  
                                    <a href="/services?action=anmfactfinder&amp;anm_key=28304865">4-8 @if(empty($outgreatDam)) 没有结果 @elseif(isset($outgreatDam->cattledam->cattleID)) {{$outgreatDam->cattledam->cattleID }} @else {{$outgreatDam->mother}}  @endif </a><br>
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

@stop

@section('footer')
@include('admin-layouts.admin-footer')
@stop

@section('js')
<script type="text/javascript" src="/js/barnmap.js"></script>
@stop
