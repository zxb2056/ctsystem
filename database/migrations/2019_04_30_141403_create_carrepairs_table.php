<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrepairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate')->comment('车牌号');
            $table->date('send_date')->comment('送修日期');
            $table->string('reason')->comment('送修原因');
            $table->string('repair_plant')->comment('汽修厂');
            $table->string('pic')->comment('经办人');
            $table->date('back_date')->comment('取车日期')->nullable();
            $table->string('cost')->comment('修车费用')->nullable();
            $table->string('mileage')->comment('里程数')->nullable();
            $table->string('note')->comment('备注')->nullable();
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
        Schema::dropIfExists('carrepairs');
    }
}
