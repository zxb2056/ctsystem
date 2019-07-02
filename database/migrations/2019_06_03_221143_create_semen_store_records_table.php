<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenStoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen_store_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semen_id')->comment('冻精号id');
            $table->date('storedDay')->comment('入库时间');
            $table->string('mount')->comment('入库数量');
            $table->string('price')->nullable()->comment('冻精单价');
            $table->string('sum')->nullable()->comment('总金额');
            $table->string('PIC')->comment('经手人');
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
        Schema::dropIfExists('semen_store_records');
    }
}
