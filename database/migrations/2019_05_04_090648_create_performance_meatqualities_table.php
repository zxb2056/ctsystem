<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceMeatqualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_meatqualities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->string('meatColor')->nullable()->comment('肌肉颜色');
            $table->string('fatColor')->nullable()->comment('脂肪颜色');
            $table->string('marbling')->nullable()->comment('大理石花纹');
            $table->string('shear_force')->nullable()->comment('剪切力');
            $table->string('fatinMuscle_preslauter')->nullable()->comment('宰前肌肉脂肪含量');
            $table->string('fatinMuscle_afterslauter')->nullable()->comment('宰后肌肉脂肪含量');
            $table->string('PH')->nullable()->comment('PH值');
            $table->string('driploss')->nullable()->comment('滴水损失');
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
        Schema::dropIfExists('performance_meatqualities');
    }
}
