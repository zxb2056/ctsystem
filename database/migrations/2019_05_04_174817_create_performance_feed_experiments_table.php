<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceFeedExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_feed_experiments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('experimentName');
            $table->date('startDate');
            $table->string('cattle_quantity')->nullable()->comment('开始牛头数');
            $table->string('startWeight')->nullable()->comment('开始体重');
            $table->string('concentrate')->nullable()->comment('精料配方');
            $table->date('endDate')->nullable()->comment('结束日期');
            $table->string('end_quantity')->nullable()->comment('结束时动物数量');
            $table->string('endWeight')->nullable();
            $table->integer('grouporSingle')->comment('0表示群体数据，1表示精确到每头牛');
            $table->string('convertRatio')->nullable()->comment('储存计算出来的转化率结果');
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
        Schema::dropIfExists('performance_feed_experiments');
    }
}
