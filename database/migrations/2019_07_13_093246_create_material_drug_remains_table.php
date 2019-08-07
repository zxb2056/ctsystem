<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialDrugRemainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_drug_remains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('drug_id')->comment('药品对应的id');
            $table->integer('drug_store_id')->comment('对应的入库id,因为不同批次价格不同');
            $table->float('remain')->comment('剩余数量');
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
        Schema::dropIfExists('material_drug_remains');
    }
}
