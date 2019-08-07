<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialDrugOutRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_drug_out_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('drug_id')->comment('对应的药品id');
            $table->string('type')->default('出库')->comment('标明是出库');
            $table->date('outDay')->comment('出库日期');
            $table->integer('drug_store_id')->comment('对应的入库id,因为不同批次价格不同');
            $table->string('amount')->comment('数量');
            $table->string('user')->comment('领物人或使用人,牧场只有兽医能领，如果大型公司还要分部门，是育种部还是生产部等');
            $table->integer('department_id')->nullable()->comment('选择使用部门，下拉框选择');
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
        Schema::dropIfExists('material_drug_out_records');
    }
}
