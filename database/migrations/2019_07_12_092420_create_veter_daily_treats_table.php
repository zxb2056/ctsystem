<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterDailyTreatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_daily_treats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disease_id')->comment('对应的疾病表id');
            $table->string('cattle_id')->comment('对应的牛号,方便以后筛选');
            $table->string('cattleID')->comment('对应的牛耳标号');
            $table->string('treat_date')->comment('治疗日期');
            $table->string('sysptom')->nullable()->comment('症状描述');
            $table->text('therapeuticWay')->nullable()->comment('治疗方式,因为是多选，怎么插入，以逗号分隔');
            $table->string('note')->nullable()->comment('说明备注');
            $table->string('PIC')->comment('当日执行兽医');
            $table->string('status')->comment('ing或done');
            $table->string('rename_disease')->comment('重新确诊疾病名称');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veter_daily_treats');
    }
}
