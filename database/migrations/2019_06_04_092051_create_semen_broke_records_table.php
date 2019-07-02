<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenBrokeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen_broke_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semen_id')->comment('冻精id');
            $table->date('brokeDate')->comment('损坏日期');
            $table->string('reason')->nullable()->comment('损坏原因');
            $table->string('note')->nullable()->comment('备注说明损坏原因');
            $table->string('PIC')->comment('负责人');
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
        Schema::dropIfExists('semen_broke_records');
    }
}
