<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedPregnancyChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_pregnancy_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id')->comment('母牛id');
            $table->string('cowID')->comment('母牛耳号');
            $table->string('checkDate')->comment('孕检日期');
            $table->string('checkResult')->comment('孕检结果');
            $table->string('related_disease')->comment('相关子宫病变情况');
            $table->string('note')->nullable()->comment('没有包含的病变情况说明');
            $table->string('checker')->comment('孕检员');
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
        Schema::dropIfExists('breed_pregnancy_checks');
    }
}
