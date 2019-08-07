<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialDrugStoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_drug_store_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('drug_id')->comment('药品对应的id');
            $table->date('storedDay')->comment('入库日期');
            $table->string('batch_order')->comment('药品批次，用于区分保质期，格式如20190701-001.代表2019年7月1日全年第一次进货，以后一直累计，可以统计每年进货多少次。');
            $table->string('amount')->comment('入库数量');
            $table->string('unit')->nullable()->comment('单位，毫升等');
            $table->string('price')->nullable()->comment('单价');
            $table->string('sum')->nullable()->commen('总金额');
            $table->date('date_of_manufacture')->nullable()->comment('本批产品生产日期');
            $table->string('retention_period')->nullable()->comment('保质期');
            $table->date('expire_date')->nullable()->comment('过期日期');
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
        Schema::dropIfExists('material_drug_store_records');
    }
}
