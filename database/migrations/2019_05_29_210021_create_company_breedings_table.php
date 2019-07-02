<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBreedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_breedings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName')->comment('育种公司');
            $table->string('code')->comment('种公牛站编码');
            $table->timestamps();
        });
        $data=array(
            array('companyName'=>'河南省鼎元种牛育种有限公司','code'=>'411'),
            array('companyName'=>'许昌市畜牧技术推广站','code'=>'412'),
            array('companyName'=>'南阳昌盛牛业有限公司','code'=>'413'),
            array('companyName'=>'河南省洛阳市白马寺种公牛站','code'=>'414'),
            array('companyName'=>'山东奥克斯生物技术有限公司','code'=>'373'),
            array('companyName'=>'山东省种公牛站有限责任公司','code'=>'371'),
            array('companyName'=>'内蒙古赛克星繁育生物技术股份有限公司','code'=>'155'),
            array('companyName'=>'通辽京缘种牛繁育有限责任公司','code'=>'152'),
            array('companyName'=>'内蒙古天和荷斯坦牧业有限公司','code'=>'151'),
            array('companyName'=>'山西省家畜冷冻精液中心','code'=>'141'),
            array('companyName'=>'大连金弘基种畜有限公司','code'=>'005'),
            array('companyName'=>'武汉兴牧生物科技有限公司','code'=>'421'),
            array('companyName'=>'湖南省良种牛繁育中心种公牛站','code'=>'431'),
            array('companyName'=>'广州市奶牛研究所有限公司','code'=>'441'),
            array('companyName'=>'广西壮族自治区畜禽品种改良站','code'=>'451'),
            array('companyName'=>'成都汇丰动物育种有限公司','code'=>'511'),
            array('companyName'=>'贵州省畜牧技术推广站','code'=>'521'),
            array('companyName'=>'云南省家畜冷冻精液站','code'=>'531'),
            array('companyName'=>'大理白族自治州家畜繁育指导站','code'=>'532'),
            array('companyName'=>'西藏自治区当雄县牦牛冻精站','code'=>'541'),
            array('companyName'=>'重庆市种公牛站','code'=>'551'),
            array('companyName'=>'陕西秦申金牛育种有限公司','code'=>'611'),
            array('companyName'=>'西安光明荷斯坦奶牛育种有限公司','code'=>'612'),
            array('companyName'=>'甘肃省家畜繁育中心','code'=>'621'),
            array('companyName'=>'青海省家畜改良中心','code'=>'631'),
            array('companyName'=>'宁夏四正生物工程技术研究中心','code'=>'641'),
            array('companyName'=>'新疆维吾尔族自治区畜禽繁育改良总站','code'=>'651'),
            array('companyName'=>'天山畜牧昌吉生物工程有限责任公司','code'=>'652'),
            array('companyName'=>'山东盛能奶牛胚胎工程有限公司','code'=>'374'),
            array('companyName'=>'山东曹县中大种公牛站','code'=>'372'), 
            array('companyName'=>'江西省种公牛站','code'=>'361'),
            array('companyName'=>'安徽精英种畜有限公司','code'=>'343'),
            array('companyName'=>'阜阳市黄牛改良中心','code'=>'342'),
            array('companyName'=>'安徽省畜禽遗传资源保护中心','code'=>'341'),
            array('companyName'=>'江苏省奶牛育种中心','code'=>'322'),
            array('companyName'=>'徐州市家畜良种站','code'=>'321'),
            array('companyName'=>'上海金晖家畜遗传开发有限公司','code'=>'312'),
            array('companyName'=>'上海奶牛育种中心有限公司','code'=>'311'),
            array('companyName'=>'大庆市银螺乳业有限公司种公牛站','code'=>'232'),
            array('companyName'=>'黑龙江省博瑞遗传有限公司','code'=>'231'),
            array('companyName'=>'四平市种牛冷冻精液站','code'=>'224'),
            array('companyName'=>'延边家畜繁育改良工作站','code'=>'223'),
            array('companyName'=>'长春新牧科技有限公司','code'=>'221'),
            array('companyName'=>'辽宁省牧经种牛繁育中心有限公司','code'=>'211'),
            array('companyName'=>'赤峰赛奥牧业技术服务有限公司','code'=>'154'),
            array('companyName'=>'海拉尔市农牧场管理局家畜繁育指导站','code'=>'153'),
            array('companyName'=>'亚达艾格威（唐山）畜牧有限公司','code'=>'133'),
            array('companyName'=>'秦皇岛全农精牛繁育有限公司','code'=>'132'),
            array('companyName'=>'河北省畜牧良种工作站','code'=>'131'),
            array('companyName'=>'XY种畜（天津）有限公司','code'=>'122'),
            array('companyName'=>'天津市奶牛发展中心','code'=>'121'),
            array('companyName'=>'北京奶牛中心','code'=>'111'),
            array('companyName'=>'北京环球种畜有限责任公司','code'=>'001'),
            array('companyName'=>'北京向中生物技术有限公司','code'=>'002'),
            array('companyName'=>'ABS Global育种公司','code'=>'003'),
            array('companyName'=>'先马士育种公司','code'=>'004'),
            array('companyName'=>'荷兰CRV育种公司','code'=>'005'),
            array('companyName'=>'法国爱沃遗传育种公司','code'=>'006'),
        );
        \DB::table('company_breedings')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_breedings');
    }
}
