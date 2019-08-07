<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterDrugRemainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_drug_remains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('drug_id')->comment('对应的药品id');
            $table->integer('drug_store_id')->comment('对应的入库id,因为不同批次价格不同');
            $table->string('price')->comment('对应的物品价格');
            $table->string('remain')->comment('剩余数量,最小等于0');
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
        Schema::dropIfExists('veter_drug_remains');
    }
}
