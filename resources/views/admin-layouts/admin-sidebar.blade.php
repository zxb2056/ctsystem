<div class="wrapper">
        <div id="sidebar">
          <div class="sidebar-header py-2 mt-2">
            <h3>功能菜单</h3>
          </div>
    
          <ul class="list-unstyled border-top">
         @can('post-manager')
            <li>
                <a href="#postinput" data-toggle="collapse" class="dropdown-toggle">文章管理</a>
                <ul class="collapse list-unstyled bg-ulcolor" id="postinput">
                  <li>
                    <a href="{{ asset('/admin/post/postinput') }}">发布文章</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/post/postlist') }}">管理文章</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/post/bulletin-board') }}">公告板新增</a>
                  </li>
                  <li>
                  <a href="{{ asset('/admin/post/bulletinlist') }}">公告板管理</a>
                  </li>
                  <li>
                        <a href="{{ asset('/admin/post/video')}}">视频管理</a>
                  </li>
                  <li>
                        <a href="{{ asset('/admin/post/picture')}}">企业图片</a>
                  </li>
                  
                </ul>
              </li>
            @endcan
       
        <li>
                <a href="#basicinfo" data-toggle="collapse" class="dropdown-toggle">基础数据</a>
                <ul class="collapse list-unstyled bg-ulcolor" id="basicinfo">
                  <li>
                    <a href="{{ asset('/admin/manage/basic/cattleinfo') }}">牛只信息表</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/barninfo') }}">牛舍信息表</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/barnmapindividual') }}">配置牛舍</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/sireinfos') }}">公牛信息表</a>
                  </li>
                <li>
                    <a href="{{ asset('/admin/manage/basic/cattle-pedigree') }}">牧场公牛库</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/semeninfos') }}">冻精信息表</a>
                  </li>
                  <li>
                        <a href="{{ asset('/admin/manage/basic/mateInput/outPregCattle') }}">外购现有牛配种登记</a>
                </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/cattle-eliminate') }}">牛只淘汰</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/manage/basic/cattle-sale-common') }}">牛只出栏</a>
                  </li>
                                                  
                </ul>
              </li>
              <li>
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">繁育</a>
                            <ul class="collapse list-unstyled bg-ulcolor" id="homeSubmenu">
                                <li>
                                    <a href="{{asset('/admin/manage/breed/mateInput')}}">配种数据录入</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/yunjianinput')}}">孕检数据录入</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/chandu')}}">产犊数据录入</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/aftercare')}}">产后护理录入</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/waitmate')}}">待配母牛表</a>
                                </li>
                                       
                                <li>
                                    <a href="{{asset('/admin/manage/breed/fanzhidisease')}}">繁殖疾病诊疗卡</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/expected_birth')}}">预产期明细表</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/mateplan')}}">配种计划表</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/breed/matereport/month')}}">繁殖报表</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">兽医</a>
                            <ul class="collapse list-unstyled bg-ulcolor" id="pageSubmenu">
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/disease_input')}}">诊疗数据</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/antiepidemic_batch')}}">批量新增防疫记录</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/antiepidemic_single')}}">新增单条防疫记录</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/antiepidemic_history')}}">防疫历史</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/Quarantine_input')}}">检疫记录输入</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/Quarantine_history')}}">检疫历史</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/trim_hoof_input')}}">修蹄登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/trim_hoof_history')}}">修蹄历史</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/repellent_single')}}">单个驱虫登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/repellent_batch')}}">批量驱虫登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/repellent_history')}}">驱虫历史记录</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/disinfection_input')}}">消毒登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/Veterinary/disinfection_history')}}">消毒历史查询</a>
                                </li>
        
        
                            </ul>
                        </li>
                       
                        <li>
                            <a href="#manage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">生产管理登记</a>
                            <ul class="collapse list-unstyled bg-ulcolor" id="manage">
                                <li>
                                    <a href="{{asset('/admin/manage/feed/dieOut')}}">淘汰登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/feed/sell_batch')}}">销售登记</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/feed/change_barn')}}">转舍登记</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                                <a href="#productLookOver" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">生产管理数据查阅</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="productLookOver">

                                    <li>
                                        <a href="{{asset('/admin/manage/feed/eliminate_ledger')}}">淘汰记录查询</a>
                                    </li>
                                    <li>
                                            <a href="{{asset('/admin/manage/feed/sell_ledger')}}">销售记录查询</a>
                                    </li>
                                    <li>
                                            <a href="{{asset('/admin/manage/feed/change_barn_history')}}">转舍历史查询</a>
                                    </li>

                                </ul>
                            </li>

                        <li>
                        <li>
                                <a href="#supplier_manage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">供货商管理</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="supplier_manage">

                                    <li>
                                        <a href="{{asset('/admin/manage/supplier/plus')}}">新增</a>
                                    </li>
                                    <li>
                                            <a href="{{asset('/admin/manage/supplier/contacter/plus')}}">添加联系人</a>
                                    </li>
                                    <li>
                                            <a href="{{asset('/admin/manage/supplier/info')}}">查看</a>
                                    </li>


                                </ul>
                            </li>
                        <li>
                            <a href="#wuzi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">物资管理</a>
                            <ul class="collapse list-unstyled bg-ulcolor" id="wuzi">
                                <a href="#feed" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark border-top">饲料</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="feed">
                                        <li>
                                                <a href="{{asset('/admin/manage/material/feed_input')}}">饲料入库登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/feed_output')}}">饲料出库登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/feed_ledger')}}">饲料台账</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/feed_remain')}}">饲料库存</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/feed_repository')}}">饲料名录</a>
                                            </li>
                                </ul>
                                <a href="#drug" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark border-top">药品</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="drug">
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/repository/plus')}}">新药品信息登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/input')}}">药品入库登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/output')}}">药品出库登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/ledger/store')}}">药品台账</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/remain')}}">药品库存</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/drugs/repository')}}">药品名录</a>
                                            </li>
                                </ul>
                                <a href="#instru" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark border-top">器械耗材</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="instru">
                                        <li>
                                                <a href="{{asset('/admin/manage/material/instru_consum_input')}}">器械耗材入库登记</a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{asset('/admin/manage/material/instru_consum_output')}}">器械耗材出库使用登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/instru_consum_check')}}">器械耗材盘点登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/instru_consum_ledger')}}">器械耗材台账</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/instru_consum_remain')}}">器械耗材库存</a>
                                            </li>
                                </ul>
                                <a href="#semen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark border-top">冻精</a>
                                <ul class="collapse list-unstyled bg-ulcolor" id="semen">
                                        <li>
                                                <a href="{{asset('/admin/manage/material/semen_input')}}">冻精入库登记</a>
                                        </li>
                                            <li>
                                                    <a href="{{asset('/admin/manage/material/semen_output')}}">冻精出库登记</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/semen/store_ledger')}}">冻精台账</a>
                                            </li>
                                            <li>
                                                <a href="{{asset('/admin/manage/material/semen_remain')}}">冻精库存</a>
                                            </li>
                                </ul>
                               
                            </ul>
                        </li>
                        <li>
                            <a href="#YuanGongSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">员工管理</a>
                            <ul class="collapse list-unstyled bg-ulcolor" id="YuanGongSubmenu">
                                <li>
                                    <a href="{{asset('/admin/manage/staff/staff_list')}}">员工列表</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/staff/offWork')}}">请假管理</a>
                                </li>

                                <li>
                                    <a href="{{asset('/admin/manage/staff/attendance')}}">考勤管理</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/staff/partment')}}">部门管理</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/staff/map_s_d')}}">部门VS员工</a>
                                </li>
                                <li>
                                    <a href="{{asset('/admin/manage/staff/tmpworker')}}">临时用工</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                                    <a href="{{asset('/admin/manage/car')}}">车辆管理</a>
                        </li>
                        <li>
                            <a href="{{asset('/admin/manage/performance/growth')}}">生产性能测定</a>
                        </li>
                        <li>
                            <a href="{{asset('/admin/manage/special/bodyscore')}}">体型评分</a>
                        </li>
                        <li>
                            <a href="{{asset('/admin/manage/special/selectmate')}}">选种选配</a>
                        </li>
                        <li>
                            <a href="{{asset('/admin/manage/special/FeedFormula')}}">配方软件</a>
                        </li>
          </ul>
          <ul class="list-unstyled border-top">
          @can('sys-manager')
            <li>
              <a href="#AdminUserManage" data-toggle="collapse" class="dropdown-toggle">用户管理</a>
              <ul class="collapse list-unstyled bg-ulcolor" id="AdminUserManage">
             
                  <li>
                    <a href="{{ asset('/admin/users/index') }}">用户列表</a>
                  </li>
              
                  <li>
                    <a href="{{ asset('/admin/roles/index') }}">角色列表</a>
                  </li>
                  <li>
                    <a href="{{ asset('/admin/permissions/index') }}">权限列表</a>
                  </li>
                                   
                </ul>
            </li>
        @endcan
          </ul>
</div>