<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTherapeuticWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapeutic_ways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('治疗方法');
            });
            $data=array(
                array('name'=>'药物治疗'),
                array('name'=>'输液'),
                array('name'=>'穿刺手术'),
                array('name'=>'封闭疗法'),
                array('name'=>'瘤胃内容物疗法'),
                array('name'=>'腹膜透析疗法'),
                array('name'=>'灌肠法和破解术'),
                array('name'=>'冲洗法'),
                array('name'=>'物理疗法'),
                array('name'=>'其它'),
            );
            \DB::table('therapeutic_ways')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('therapeutic_ways');
    }
}
