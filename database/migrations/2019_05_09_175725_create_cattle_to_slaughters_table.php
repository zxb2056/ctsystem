<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleToSlaughtersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_to_slaughters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->string('cattleID')->comment('牛耳标号');
            $table->integer('cattle_sell_batch_info_id')->comment('对应的销售批次id');
            $table->string('dayAgeOfSold')->nullable()->comment('出售时日龄');
            $table->string('gender')->nullable()->comment('牛的性别，便于统计公母牛售价差异');
            $table->string('avgIncome')->nullable()->comment('批量售卖时平均每头牛的售价，对于单头就是售价。不显示，只做统计用');
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
        Schema::dropIfExists('cattle_to_slaughters');
    }
}
