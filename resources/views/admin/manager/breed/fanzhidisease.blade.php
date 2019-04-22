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
<div class="card rounded-0 my-3">
                <div class="card-header d-flex">
                        <div class="mr-auto"><strong>繁殖疾病表</strong></div>
                        <div><button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#diseaseModal">增加</button></div>
                    
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
                        <tr>
                            <td>1</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>子宫炎</td>
                            <td>中度子宫炎</td>
                            <td>宫油净，冲洗</td>
                            <td>恢复正常</td>
                            <td>王五</td>
                            <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="1" data-target="#diseaseModal">编辑</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>281065</td>
                            <td>2016-5-23</td>
                            <td>胎衣不下</td>
                            <td>胎衣挂在阴门外面</td>
                            <td>10%葡萄糖酸钙注射液、25%的葡萄糖注射液各500mL，1次静脉注射，每日2次，连用2日</td>
                            <td>恢复正常</td>
                            <td>王五</td>
                            <td><button  type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-id="2" data-target="#diseaseModal">更新</button></td>
                            </tr>
                    </tbody>

          </table>
            
               
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
                                    <form>
                                            <div class="form-group row">
                                              <label for="niuhao" class="col-sm-3 col-form-label">牛号</label>
                                              <div class="col-sm-9">
                                                <input type="text" class="form-control" id="niuhao" >
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="fabingriqi" class="col-sm-3 col-form-label">发病日期</label>
                                              <div class="col-sm-9">
                                                <input type="date" class="form-control" id="fabingriqi" >
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="diseasename" class="col-sm-3 col-form-label">何种疾病</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" id="diseasename" >
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="diseaseCondition" class="col-sm-3 col-form-label">症状描述</label>
                                                        <div class="col-sm-9">
                                                                <textarea  class="form-control" id="treatMethod" >
                                                                    </textarea>
                                                        </div>
                                                      </div>
                                                  <div class="form-group row">
                                                        <label for="treatMethod" class="col-sm-3 col-form-label">治疗方案</label>
                                                        <div class="col-sm-9">
                                                          <textarea  class="form-control" id="treatMethod" >
                                                              </textarea>
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                            <label for="result" class="col-sm-3 col-form-label">治疗结果</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" id="result" >
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                                <label for="zeren" class="col-sm-3 col-form-label">责任兽医</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" id="zeren" >
                                                                </div>
                                                              </div>
        
                                          </form>
            
                        
                           
                              </div>
                           
                              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-primary">保存</button>
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
