<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterTrimHoofDailyTreatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_trim_hoof_daily_treats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('veter_trim_id')->comment('对应的修蹄id');
            $table->date('trim_date')->comment('治疗蹄病日期');
            $table->string('dailycondition')->nullable()->comment('当日治疗结果');
            $table->string('which_hoof')->comment('哪只牛蹄，根据id里边有几个，每个生成一条数据，如果4个蹄子，则生成4行');
            $table->string('disease_name')->nullable()->comment('蹄病名称');
            $table->string('symptom')->nullable()->comment('症状描述');
            $table->text('therapeuticWay')->nullable()->comment('治疗方式,因为是多选，怎么插入，以逗号分隔');
            $table->string('note')->nullable()->comment('说明备注');
            $table->string('status')->comment('ing或done');
            $table->string('outcome')->nullable()->comment('最终治疗结果');
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
        Schema::dropIfExists('veter_trim_hoof_daily_treats');
    }
}
