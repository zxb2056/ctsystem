<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateNationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abbreviation')->comment('国家缩写');
            $table->string('nationName')->comment('国家名称');
            $table->timestamps();
        });
        $data=array(
            array('abbreviation'=>'CHN','nationName'=>'中国'),
            array('abbreviation'=>'ARG','nationName'=>'阿根廷'),
            array('abbreviation'=>'AUS','nationName'=>'澳大利亚'),
            array('abbreviation'=>'AUT','nationName'=>'奥地利'),
            array('abbreviation'=>'BEL','nationName'=>'比利时'),
            array('abbreviation'=>'BGR','nationName'=>'保加利亚'),
            array('abbreviation'=>'CAN','nationName'=>'加拿大'),
            array('abbreviation'=>'CHE','nationName'=>'瑞士'),
            array('abbreviation'=>'CZE','nationName'=>'捷克'),
            array('abbreviation'=>'DEU','nationName'=>'德国'),
            array('abbreviation'=>'DNK','nationName'=>'丹麦'),
            array('abbreviation'=>'ESP','nationName'=>'西班牙'),
            array('abbreviation'=>'FIN','nationName'=>'荷兰'),
            array('abbreviation'=>'FRA','nationName'=>'法国'),
            array('abbreviation'=>'GBR','nationName'=>'英国'),
            array('abbreviation'=>'GRC','nationName'=>'希腊'),
            array('abbreviation'=>'HRV','nationName'=>'克罗地亚'),
            array('abbreviation'=>'HUN','nationName'=>'匈牙利'), 
            array('abbreviation'=>'IJE','nationName'=>'泽西岛'),
            array('abbreviation'=>'IRL','nationName'=>'爱尔兰'),
            array('abbreviation'=>'ISR','nationName'=>'以色列'),
            array('abbreviation'=>'ITA','nationName'=>'意大利'),
            array('abbreviation'=>'JPN','nationName'=>'日本'),
            array('abbreviation'=>'LUX','nationName'=>'卢森堡'), 
            array('abbreviation'=>'MEX','nationName'=>'墨西哥'),
            array('abbreviation'=>'NLD','nationName'=>'荷兰'),
            array('abbreviation'=>'NOR','nationName'=>'挪威'),
            array('abbreviation'=>'NZL','nationName'=>'新西兰'),
            array('abbreviation'=>'POL','nationName'=>'波兰'),
            array('abbreviation'=>'PRT','nationName'=>'葡萄牙'), 
            array('abbreviation'=>'ROM','nationName'=>'罗马尼亚'),
            array('abbreviation'=>'SVK','nationName'=>'斯洛伐利亚'),
            array('abbreviation'=>'SVN','nationName'=>'斯洛文尼亚'),
            array('abbreviation'=>'SWE','nationName'=>'瑞典'),
            array('abbreviation'=>'USA','nationName'=>'美国'),
            array('abbreviation'=>'YUG','nationName'=>'南斯拉夫'),
            array('abbreviation'=>'ZAF','nationName'=>'南非'), 
        );
        \DB::table('nations')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nations');
    }
}
