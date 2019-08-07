<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleEliminateBatchInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_eliminate_batch_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('elimiOrder')->comment('淘汰序号，区分同一天不同的批次，便于排序查询');
            $table->string('elimiDay')->comment('淘汰日期');
            $table->string('totalNum')->comment('淘汰牛头数');
            $table->string('reason')->commetn('淘汰原因');
            $table->string('toWhere')->comment('淘汰去向');
            $table->string('buyerAttribute')->nullable()->comment('购买者属性，单位还是个人');
            $table->string('buyerName')->nullable()->comment('购买者名字');
            $table->string('buyerPhone')->nullable()->comment('购买者电话');
            $table->string('totalWeight')->nullable()->comment('总体重');
            $table->string('Income')->nullable()->comment('淘汰收入');
            $table->string('PIC')->nullable()->comment('负责人');
            $table->string('note')->nullable()->comment('附加说明');
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
        Schema::dropIfExists('cattle_eliminate_batch_infos');
    }
}
