<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleEliminatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_eliminates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id')->comment('牛只id');
            $table->string('cattleID')->comment('牛的耳标号');
            $table->integer('cattle_eliminate_batch_info_id')->comment('对应的销售批次id');
            $table->integer('dayAgeOfSold')->nullable()->comment('淘汰时日龄');
            $table->string('gender')->nullable()->comment('牛的性别，便于统计公母牛售价差异');
            $table->string('avgIncome')->nullable()->comment('批量售卖时平均每头牛的售价，对于单头就是售价。不显示，只做统计用');
            //提交此表的时候，更改牛只状态
            $table->string('PIC')->nullable()->comment('负责人');
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
        Schema::dropIfExists('cattle_eliminates');
    }
}
