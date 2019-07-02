<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedFanzhiMonthPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_fanzhi_month_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year')->comment('年份，单位201906');
            $table->string('month')->comment('月份');
            $table->string('lastMonthMated')->nullable()->comment('上月配种牛数');
            $table->string('lastMonthPregCheck')->nullable()->comment('上月定胎牛数');
            $table->string('lastMonthPregCattleNum')->comment('上月定胎怀孕牛数');
            $table->string('lastMonthPregRation')->comment('上月定胎怀孕牛比例');
            $table->string('thisMonthMating')->nullable()->comment('本月预计配种牛头数');
            $table->string('thisMonthPregCheck')->nullable()->comment('本月需要定胎数');
            $table->string('thisMonthCalv')->nullable()->comment('本月预计产犊数');
            $table->string('thisMonthSemenUse')->nullable()->comment('本月预计冻精使用量');
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
        Schema::dropIfExists('breed_fanzhi_month_plans');
    }
}
