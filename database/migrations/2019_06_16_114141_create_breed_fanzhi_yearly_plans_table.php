<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedFanzhiYearlyPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_fanzhi_yearly_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time')->comment('标明时间段，单位年');
            $table->string('type')->comment('标明牛只类型，成年母牛，育成母牛，头胎母牛，复配母牛');
            $table->string('January')->nullable()->comment('一月');
            $table->string('February')->nullable()->comment('二月');
            $table->string('March')->nullable()->comment('三月');
            $table->string('April')->nullable()->comment('四月');
            $table->string('May')->nullable()->comment('五月');
            $table->string('June')->nullable()->comment('六月');
            $table->string('July')->nullable()->comment('七月');
            $table->string('August')->nullable()->comment('八月');
            $table->string('September')->nullable()->comment('九月');
            $table->string('October')->nullable()->comment('十月');
            $table->string('November')->nullable()->comment('十一月');
            $table->string('December')->nullable()->comment('十二月');
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
        Schema::dropIfExists('breed_fanzhi_yearly_plans');
    }
}
