<?php
$url="/admin/manage/basic/cattleinfo?showitem=".$datas['showitem']."&cattleID=".$datas['cattleID']."&whichBreed=".urlencode($datas['whichBreed'])."&birthday1=".$datas['birthday1']."&birthday2=".$datas['birthday2']."&pregnancyNum=".$datas['pregnancyNum']."&belongBarn=".$datas['belongBarn']."&whereComefrom=".urlencode($datas['whereComefrom'])."&status=".urlencode($datas['status'])."&enterday_start=".$datas['enterday_start']."&enterday_end=".$datas['enterday_end'];
?>
<table class="table table-hover">
                <thead >
                    <tr>
                    <td>序号</td>
                    <td href="{{$url}}&amp;sortby=cattleID&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">牛号</td>
                    <td href="{{$url}}&amp;sortby=birthday&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">出生日期</td> 
                    <td href="{{$url}}&amp;sortby=gender&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">性别</td>
                    <td href="{{$url}}&amp;sortby=birthWeight&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">初生重</td>
                    <td href="{{$url}}&amp;sortby=whichBreed&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">品种</td>     
                    <td href="{{$url}}&amp;sortby=whereComefrom&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">来源地</td>
                    <td href="{{$url}}&amp;sortby=enterDay&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">入场日期</td>
                    <td href="{{$url}}&amp;sortby=enterWeight&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">入场体重</td>
                    <td href="{{$url}}&amp;sortby=pregnancyNum&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">胎次</td>
                    <td>所在牛舍</td>
                    <td href="{{$url}}&amp;sortby=status&amp;sorttype=<?php if($datas['sorttype']=='asc'){echo 'desc';}else {echo 'asc';} ?>" onclick="location.href=this.getAttribute('href')" title="点击排序">在群状态</td>
                    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allCattles as $cattle)
                    <tr>
                      <td>{{ (($allCattles->currentPage() - 1 ) * $allCattles->perPage() ) + $loop->iteration }}</td>
                      <td style="cursor:pointer;color:darkblue;" onclick="javascript:location.href='/admin/manage/basic/single_cattle_detail/{{ $cattle->id }}'">{{ $cattle->cattleID }}</td>
                      <td>{{ $cattle->birthday }}</td>                     
                      <td>{{ $cattle->gender }}</td>
                      <td>{{ $cattle->birthWeight }}</td>
                      <td>{{ $cattle->breedVariety->name }}</td>
                      <td>{{ $cattle->whereComefrom }}</td>
                      <td>{{ $cattle->enterDay }}</td>
                      <td>{{ $cattle->enterWeight }}</td>
                      <td>{{ $cattle->pregnancyNum }}</td>
                      <td><?php 
                      try{
                        if($cattle->barns->linkbarns->barnID == '-1'){
                          echo "#";
                        }else{
                          echo $cattle->barns->linkbarns->barnID;
                        }
                        
                      }catch(\Exception $e){
                        echo "";
                      }
                      ?>
                      </td>
                      <td>{{ $cattle->status }}</td>
                     
                    </tr>
                    @endforeach
                   
                  </tbody>
            
                </table>