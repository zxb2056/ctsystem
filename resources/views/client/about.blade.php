@extends('layouts.main')

@section('title')
关于我们
@stop

@section('actAbout')
active
@stop

@section('specss')
@parent
<link rel="stylesheet" href="../../css/about.css">
@stop
@section('head')
@include('layouts.head')
@endsection

@section('header')
@include('layouts.nav')
@stop

@section('content')
<div class="container main">
        <div class="jumbotron jumbotron-bg d-flex align-items-start">
            <div class="bg-ligther p-3">
                <h1 class="display-5">企业概况</h1>
            </div>


        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="list-group sticky-top" id="list-tab" role="tablist">
                    <a href="#jianjie" class="list-group-item list-group-item-action active" id="picture-list"
                        data-toggle="list" role="tab">企业简介</a>
                    <a href="#daipin" class="list-group-item list-group-item-action " id="video-list" data-toggle="list"
                        role="tab">带贫模式</a>
                    <a href="#constitute" class="list-group-item list-group-item-action " id="video-list" data-toggle="list"
                        role="tab">研究院</a>
                    <a href="#contactus" class="list-group-item list-group-item-action " id="video-list" data-toggle="list"
                        role="tab">联系我们</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="jianjie" role="tabpanel" aria-labelledby="picture-list">
                        <p>
                            洛阳辰涛牧业科技有限公司产业扶贫示范园，是一家大型现代化生态牧业科技有限公司。公司位于千年帝都洛阳南35公里处的伊川县鸣皋镇杨海山村。公司生态养殖扶贫产业示范园计划总投资2.8亿元，一期投资8000万，规划占地面积400亩，其中办公楼1栋，有机肥转化厂一座，污水处理池一个，智能化牛舍一栋，牛舍单体占地面积35000平方（目前为国内单体最大圆形牛圈），还有青贮储存区、干草库、精料库等，建成投入运营后年出栏肉牛将达到1万头。</p>
                        <p>
                            公司按照生态学和生态经济学原理，科学规划，因地制宜，精心实施，探索出了改善生态环境质量，维持生态平衡，保持畜禽养殖业协调、可持续发展的新兴生态养殖思路，生态养殖是按照“整体、协调、循环、再生”的原则，使农、林、牧等各业之间相互支持，相得益彰，提高综合生产能力，又最大限度地改善了生态环境，减少了秸秆焚烧污染源头，为当地政府秸秆禁烧节约了人力物力财力，实现经济效益、生态环境和社会效益多赢。
                        </p>
                        <p>
                            公司利用自动化设备，收集牛粪自建有机肥厂达到以粪养地，改善土壤结构，种植牧草饲料，自建饲料加工厂，加工转化为精饲料和粗饲料，精粗相结合肉牛育肥，整体通过粮改饲，以种养相结合的模式饲喂肉牛形成良性循环。目前，舍饲的养殖方法都是栓养，动物不能动强制性育肥，虽然肥了但是肉质口感不好，我公司采用的是生态福利养殖，不再栓养，符合动物自身习性，让它在舒适的环境下生长，能有效减少动物应激，抵御致病源，使生态牛肉肉质更好、更健康、更好吃。
                        </p>
                        <p>
                            公司场区设计以有机肥种植软籽石榴、樱桃、猕猴桃等果树增加经济效益，与合作社签订入股分红，母牛繁育，小牛回收协议，并在伊川高山镇流转土地2000余亩，用于饲草配套种植，并通过秸秆回收，技术指导服务，用工等方式带动周边群众脱贫致富。
                        </p>
                        <p>
                            洛阳辰涛牧业科技有限公司从犊牛的防疫、粪肥的转化利用、饲草的种植到肉牛的饲喂，全程科学管理，百分百达到绿色无污染，以自身有效循环产业喂养出健康生态放心牛肉。公司致力于养殖业的长远发展，与西北农林科技大学动物科技学院签订三方协议，提供全程技术服务与肉牛品牌研发，精心打造生态牛肉养殖。使企业整体达到绿色无污染，环保治理达标，致力打造豫西育肥牛养殖基地和西北农林大学肉牛养殖大数据实验基地。我们坚信在党的领导下，不断贯彻创新、协调、绿色、共享的发展理念，带动地方经济，造福当地百姓！
                        </p>

                    </div>
                    <div class="tab-pane fade" id="daipin" role="tabpanel">
                        <div class="form-row">

                            <p>1、 帮扶。
                                采用公司+合作社+贫困户模式。贫困户组建能繁母牛养殖合作社，饲养母牛生产犊牛。公司与合作社签订回收协议，高于市场价百分之五的价格收购，并向合作社提供指导，技术服务，带动贫困户脱贫致富。</p>
                            <p>2、务工。
                                贫困户到公司务工，日薪不低于50元，月薪不低于1500元。安排贫困户及边缘贫困户从事饲草收储，运输，种植，园林修剪，饲养等务工机会，截止目前总用工达3600余个工日，支20万余元。</p>
                            <p>3、代养。
                                贫困户每户贷款10万元，加入村集体合作社。合作社与公司合作，合作社将投资交于公司物化为牛，牛舍。公司按合作社投资的百分之六点六，给予分红。其中村集体合作社保存百分之0.6,用于合作社管理，其余百分之六，分配给贫困户。公司与合作社贫困户签订还款免责协议，贷款到期，有公司负责偿还。</p>



                        </div>

                    </div>
                    <div class="tab-pane fade" id="constitute" role="tabpanel">
                            <div class="form-row justify-content-center">
                            <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                                    <div class="h5">成立背景</div>
                                  </div>
        
        
                        </div>
                    <div class="row">
                        <p>为推动伊川县肉牛产业发展，助推伊川县脱贫攻坚工作，加快推动科技成果转化，2017年12月，由伊川县政府、西北农大动科学院、洛阳辰涛牧业公司三方共同签订《伊川县肉牛产业发展政校企三方合作框架协议书》，决定成立“伊川肉牛产业发展研究院”。旨在通过创新运行机制和技术研发服务模式，实现“政校企”深度整合，积极探索“政府倡导，专家指导，企业主导”的产业发展新模式，服务产前、产中、产后全过程。</p>
                    </div>
                    <div class="form-row justify-content-center">
                       
                            <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                            <div class="h5">功能定位</div>
                          </div>


                </div>
                <div class="row">
                    <p>立足全县肉牛发展实际，开展肉牛遗传改良、健康养殖、疾病防治、产品加工等方面的科技研发、技术服务及人才培训，以服务龙头企业及其带动的合作社为具体抓手，以高质量发展为目标，推动伊川肉牛产业向高端化、绿色化、智能化、融合化转型升级。</p>
                </div>
                <div class="form-row justify-content-center">
                    
                    <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                            <div class="h5">运行机制</div>
                          </div>

            </div>
            <div class="row">
                <p>伊川县政府提供土地和办公场所，对人才引进和产业发展提供政策扶持。西北农林科技大学动物科技学院提供科技支撑，制订研究院发展战略体系，指导研究院开展科技研发、人才培养和技术培训；洛阳辰涛牧业科技有限公司提供试验基地、科普基地和大数据来源。</p>
            </div>
            <div class="form-row justify-content-center">
             
                <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                        <div class="h5">科研力量</div>
                      </div>

        </div>
        <div class="row">
            <p>以西北农林科技大学、国家肉牛改良中心、河南科技大学、洛阳师范学院等科研单位和洛阳辰涛牧业科技力量为主体，吸纳国内外肉牛方面的优秀人才和优势团队，形成研究院研发力量，开展智库建设、科技服务和关键技术联合攻关与示范。</p>
        </div>
        <div class="form-row justify-content-center">
                <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                        <div class="h5">建设目标</div>
                      </div>

    </div>
    <div class="row">
        <p>围绕肉牛产业，建设科技推广、改良繁育、标准化饲喂、饲草种植、高端肉牛屠宰加工等五大服务体系，形成饲草生产、良种繁育、架子牛育肥、屠宰加工、冷链运输、产品销售的“全链条、全循环、高质量、高效益”一二三产融合发展模式，创建全省最大的高端肉牛产业集群，打造伊川肉牛品牌。</p>
    </div>
    <div class="form-row justify-content-center">
            <div class="alert alert-info alert-rounded text-center w-50" role="alert">
                    <div class="h5">主要任务</div>
                  </div>

    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-9"> 
            <p>一、为政府决策、产业发展、企业运行提供产前产中、产后战略咨询服务。</p>
            <p>二、品种改良，纯繁母牛选种选配；</p>
            <p>三、肉牛繁殖新技术的研发及推广应用；</p>
            <p>四、肉牛营养调控、健康养殖技术集成与示范；</p>
            <p>五、肉牛常见病诊疗及重大疫病防控预警；</p>
            <p>六、肉牛屠宰加工及优质高端牛肉产品开发；</p>
            <p>七、牛场粪污资源化、无害化、减量化处理技术集成瑟应用；</p>
            <p>八、培训基层技术人员和职业农民；</p>
            <p>九、定期对伊川县肉牛龙头企业、养殖合作社、贫困户进行建议指导；</p>
            <p>十、积极探索有中国特色的肉牛产业发展新模式，为脱贫攻坚提供智力支持。</p></div>
        <div class="col-md-2"></div>
           
    </div>
    <div class="row">
   <img  class="img-fluid" src="{{ asset('/image/research2.jpg')}}" alt="肉牛研究院展板" >
    </div>
   
                </div>
                <div class="tab-pane fade" id="contactus" role="tabpanel">
                    <h5 class="text-center">联系我们</h5>
                    <p>公司地址：洛阳市伊川县鸣皋镇杨海山村</p>
                    <p>公司邮箱：chentaomuye@foxmail.com</p>
                    <p>固定电话：0379-68496777</p>
                   <hr>
                   <div class="col-12"><iframe width='100%' height='440' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://f.amap.com/4jhoW_0296wfe'></iframe>'</div>

                </div>
            </div>
        </div>




    </div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop