<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedFanzhiMonthReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_fanzhi_month_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year')->comment('年份');
            $table->string('month')->comment('月份');
            $table->string('eligibleBreed')->comment('适配母牛数');
            $table->string('matedCowNum')->comment('参配母牛数');
            $table->string('totalMateNum')->comment('总配种次数');
            $table->string('semenUseAmount')->comment('冻精使用数');
            $table->string('HDR')->comment('21天配种率，发情检出率');
            $table->string('pregCheckNum')->comment('孕检牛头数');
            $table->string('confirmPregNum')->comment('确定怀孕牛头数');
            $table->string('lastMonthPregRation')->comment('本批孕检牛受胎率');
            $table->string('estrusConceptionRate')->comment('本批孕检牛21天情期受胎率');
            $table->string('calvNum')->comment('产犊数');
            $table->string('MaleCalfNum')->comment('公犊数');
            $table->string('FemaleCalfNum')->comment('母犊数');
            $table->string('abortionNum')->comment('流产头数');
            $table->string('nonNormalCalv')->comment('非正产头数');
            $table->string('retainedAfterBirthNum')->comment('胎衣不下牛头数');
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
        Schema::dropIfExists('breed_fanzhi_month_reports');
    }
}
