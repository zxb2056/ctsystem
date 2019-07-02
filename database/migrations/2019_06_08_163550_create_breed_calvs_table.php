<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedCalvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_calvs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id')->comment('母牛id');
            $table->string('cowID')->comment('母牛耳标号');
            $table->string('calvDate')->comment('产犊日期');
            $table->string('calvStatus')->nullable()->comment('易产性');
            $table->string('calvEarTag')->comment('犊牛耳号');
            $table->string('calvGender')->nullable()->comment('犊牛性别');
            $table->string('calvWeight')->nullable()->comment('犊牛出生重');
            $table->string('pregnancyNum')->nullable()->default('0')->comment('胎次');
            $table->string('calvInterval')->nullable()->comment('产犊间隔');
            $table->string('Deliveryer')->comment('接产员');            
            $table->string('isLatest')->default('latest')->comment('判断最近的产犊日期，之前的都变为0');
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
        Schema::dropIfExists('breed_calvs');
    }
}
