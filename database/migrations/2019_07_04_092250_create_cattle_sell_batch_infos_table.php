<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleSellBatchInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_sell_batch_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batchSellDay')->comment('批量销售日期');
            $table->string('batchOrder')->comment('销售流水号，第一次为1，以后每次加1,不用id考虑到有删除情况，卖的牛被退回');
            $table->string('buyerAttribute')->nullable()->comment('买牛的是公司或个人');
            $table->string('buyerName')->nullable()->comment('购买者名称');
            $table->string('buyerPhone')->nullable()->comment('购买者电话');
            $table->string('PricePerKg')->nullable()->comment('每公斤价格');
            $table->string('cattleFrom')->nullable()->comment('牛只是整舍，还是临时拼凑，下拉框选择');
            $table->string('cattleID')->comment('如果是临时拼拼凑，输入牛号，ajax判断是否有该牛号');
            $table->string('totalCattleNum')->comment('牛头数');
            $table->string('totalWeight')->nullable()->comment('总体重');
            $table->string('theoryIncome')->nullable()->comment('理论收入');
            $table->string('actualIncome')->nullable()->comment('实际收入');
            // 如果是屠宰场，后期数据应该可以更新，因为价格根据屠宰率有滞后性
            $table->string('PIC')->nullable()->comment('责任人');
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
        Schema::dropIfExists('cattle_sell_batch_infos');
    }
}
