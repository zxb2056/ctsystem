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
                    <div class="mr-auto"><strong>冻精库存</strong></div>


                </div>
                <div class="card-body table-responsive">
                    <div class="card rounded-0 my-3">
                        <div class="card-header">
                            <div class="d-flex align-items-baseline">
                                <span>筛选：</span>
                                <span class="mx-1">冻精号：</span>
                                <input type="text" name="feedname"> 
                                <a href="#" class="btn btn-sm btn-outline-success ml-3">查询</a>
                            </div> 
                        </div>
                        <div class="card-body table-responsive">
                            
                            
          <table class="table table-hover border">
                <thead>
                        <tr>
                            <th>序号</th>
                            <th>冻精号</th>
                            <th>供货单位</th>
                            <th>剩余数量</th>
                                                                                    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>41109231</td>
                            <td>河南省鼎元种牛育种有限公司</td>
                            <td>280</td>
 
                        </tr>
                        <tr>
                                <td>2</td>
                                <td>41109231</td>
                                <td>河南省鼎元种牛育种有限公司</td>
                                <td>280</td>
                        </tr>
                        <tr>
                                <td>3</td>
                                <td>41109231</td>
                                <td>河南省鼎元种牛育种有限公司</td>
                                <td>280</td>
                        </tr>
                        <tr>
                                <td>4</td>
                                <td>41109231</td>
                                <td>河南省鼎元种牛育种有限公司</td>
                                <td>280</td>
                        </tr>
                    </tbody>

          </table>
                    </div>
<div class="card-footer">
        <nav aria-label="Page navigation example">
               
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>  
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

@stop
