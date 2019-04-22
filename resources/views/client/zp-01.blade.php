@extends('layouts.main')

@section('title')
招聘详情
@stop

@section('actHire')
active
@stop

@section('specss')
@parent
<link rel="stylesheet" href="{{ asset('/css/zhaopin.css') }}">
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
                <h1 class="display-5">人才招聘</h1>
        </div>
      

    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="w-100" src="{{ asset('/image/fendou.jpg')}}" alt="奋斗">
        </div>
        <div class="col-md-8">
            <div class="d-flex align-items-center border-bottom border-warning mb-2">
                    <div >您现在的位置：</div>
                    <nav aria-label="breadcrumb">
                           <ol class="breadcrumb bg-transparent pl-1 mb-0">
                                  <li class="breadcrumb-item"><a href="../../index.html">首页</a></li>
                                  <li class="breadcrumb-item"><a href="/article/hire/zhaopin.html">人才招聘</a></li>
                                  
                            </ol>
                            </nav>
            </div>
<div>

    <p><strong>一、职位名称：牧场场长</strong></p>
    <p>工作地点：洛阳市伊川县</p>
    <p>招聘人数：1人</p>
    <p>岗位要求：</p><p>1、具有执业兽医师证；</p><p>2、五年以上行业工作经验，有场长经验者优先；</p><p>3、年龄：45周岁以下；</p><p>4、大专以上学历； </p><p>5、熟悉计算机管理系统。</p>
    <p>岗位职责：</p><p>1、负责公司牧场的管理；</p> <p>2、保证牧场的日常运营；</p> <p>3、保证牧场规范化、卫生化、现代化的管理；</p><p>  5、保证肉牛的健康生长。</p> 
    
            <p><strong>二、职位名称：牧场兽医、繁育师</strong></p>
            <p>工作地点：洛阳市伊川县</p>
            <p>招聘人数：5人</p>
            <p>岗位要求：</p><p>1、具有执业兽医师证；</p><p>2、三年以上行业工作经验，有场长经验者优先；</p><p>3、年龄：55周岁以下；</p><p>4、学历不限。</p>
            <p>岗位职责：<p>1、负责公司母牛配种，防疫，产后护理；</p><p> 2、负责公司育肥牛的防疫，疾病及日常管理实施；</p><p>3、协助场长进行牧场管理；</p><p>4、保证牧场规范化、卫生化、现代化的管理。</p>
    
    
            <p><strong>三、职位名称：财务</strong></p>
            <p>工作地点：洛阳市伊川县</p>
            <p>招聘人数：2人</p>
            <p>岗位要求：</p><p>1、具有会计从业资格证；</p><p>2、三年以上行业工作经验；</p><p>3、年龄：55周岁以下；</p><p>4、大专以上学历。</p>
            <p>岗位职责：</p>
                    <p>1.努力学习和遵守国家法律法规和公司的各项规章制度、政策文件；</p>
    
            <p>2.负责组织制定财务管理制度并督促贯彻执行，及时总结，不断完善；</p>
                    
    <p> 3.负责制订成本费用计划、消耗定额，及时报告财务状况和经营成果；</p>
                    
    <p>  4.负责审核公司的财务收支，保证报销凭证真实、合理、合法；</p>
                    
    <p>5.负责编制财务情况说明书，按时报送会计报表；</p>
                    
    <p> 6.负责定时做好有关数据备份，保证数据安全完整；</p>
                    
    <p>7.完成领导交办的其他工作。 </p>
                    
                    <p><strong>四、职位名称：饲养员，杂工</strong></p>
                    <p>工作地点：洛阳市伊川县</p>
                    <p>招聘人数：5人</p>
                    <p>岗位要求：</p><p>1、年龄：55周岁以下；</p><p>2、学历不限。</p>
                    <p>岗位职责：</p><p>1、负责公司牛只饲养；</p> <p>2、公司内部一些杂活。</p> 
                    <br/><br/><br/>
                    <p>公司邮箱：chentaomuye@foxmail.com</p>
                    <p>固定电话：0379-68496777</p>
                    <p>手机：18037682708</p>
    

</div>



        </div>
    </div>




</div>
    @stop

    @section('footer')
    @include('layouts.footer')
    @stop