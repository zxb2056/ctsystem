<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedMateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_mate_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id')->comment('与配母牛号');
            $table->string('semen_id')->comment('冻精id');
            $table->integer('useAmount')->comment('使用冻精剂数');
            $table->date('mateDate')->comment('配种日期');
            $table->time('mateTime')->comment('配种时间');
            $table->string('PIC')->comment('配种员');
            $table->string('isLatest')->default('latest')->comment('是否最新配种记录，同一头牛，当有新记录插入时，改为0');
            $table->string('isCalv')->default('no')->comment('当有产犊记录的时候，改变这个值');
            $table->string('pregCheckDay')->nullable()->comment('孕检日期');
            $table->string('pregCheckResult')->nullable()->comment('孕检结果');
            $table->string('mateAgeOfDay')->nullable()->comment('配种日龄');
            $table->string('mateOrder')->nullable()->comment('配种次数');
            $table->string('calvDate')->nullable()->comment('产犊日期');
            $table->string('pregnancyNum')->nullable()->comment('胎次');
            $table->string('DayOpen')->nullable()->comment('空怀天数');

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
        Schema::dropIfExists('breed_mate_records');
    }
}
