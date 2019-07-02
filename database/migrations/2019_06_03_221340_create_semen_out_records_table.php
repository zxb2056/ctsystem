<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenOutRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen_out_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semen_id')->comment('冻精号id');
            $table->string('type')->default('出库');
            $table->date('outDay')->comment('出库日期');
            $table->string('amount')->comment('出库数量');
            $table->string('PIC')->comment('经手人');
            $table->string('user')->comment('领物人');
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
        Schema::dropIfExists('semen_out_records');
    }
}
