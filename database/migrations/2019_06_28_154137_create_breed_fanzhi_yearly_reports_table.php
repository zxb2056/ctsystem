<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedFanzhiYearlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_fanzhi_yearly_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year')->comment('报表时间，上一年');
            $table->string('DO')->comment('空怀天数');
            $table->string('yearlyEstrusConceptionRate')->comment('年情期受胎率,为各月情期受胎率平均');
            $table->string('yearlyOnceConception')->comment('年一次受胎率，即一次配种就怀孕牛占总配种牛比例');
            $table->string('totalConceptionRate')->comment('年总受胎率');
            $table->string('totalCalvRate')->comment('年分娩率');
            $table->string('notNormalCalvRate')->comment('非正产率');
            $table->string('abortionRate')->comment('流产率');
            $table->string('AveSpace')->comment('平均胎间距,产犊间隔');
            $table->string('deathCalfRate')->comment('犊牛死亡率');
            $table->string('youngfirstMateAge')->comment('青年牛首配日龄,本年度18月龄以下,mateOrder等于1的mateAge');
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
        Schema::dropIfExists('breed_fanzhi_yearly_reports');
    }
}
