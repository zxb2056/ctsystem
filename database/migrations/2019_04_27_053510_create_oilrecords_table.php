<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOilrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oilrecords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate');
            $table->datetime('refueling_time')->comment('加油时间');
            $table->string('station')->comment('加油站位置名称');
            $table->string('cardId')->comment('油卡编号');
            $table->string('oiltype')->comment('油号类别');
            $table->float('amount')->comment('加油金额');
            $table->string('mileage')->comment('车辆里程数');
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
        Schema::dropIfExists('oilrecords');
    }
}
