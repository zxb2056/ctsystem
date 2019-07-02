<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceFeedExperiWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_feed_experi_weights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cattleID')->comment('牛耳号');
            $table->integer('experiment_id')->comment('对应的实验组号');
            $table->string('startWeight')->nullable()->comment('牛初始重');
            $table->string('endWeight')->nullable()->comment('结束体重');
            $table->string('IndividualFeedConsumption')->nullable()->comment('个体饲料消耗量');
            $table->string('IndividualFeedConvertRatio')->nullable()->comment('个体饲料转化率');
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
        Schema::dropIfExists('performance_feed_experi_weights');
    }
}
